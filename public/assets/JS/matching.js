const AVATAR_COLORS = [
  { bg: '#E1F5EE', color: '#085041' },
  { bg: '#EEEDFE', color: '#3C3489' },
  { bg: '#FAEEDA', color: '#633806' },
  { bg: '#FAECE7', color: '#712B13' },
  { bg: '#E6F1FB', color: '#0C447C' },
  { bg: '#FBEAF0', color: '#72243E' }
];

function getInitials(name) {
  return name
    .replace(/^Dr\.?\s*/i, '')
    .split(' ')
    .filter(Boolean)
    .map(w => w[0].toUpperCase())
    .slice(0, 2)
    .join('');
}

function buildStars(rating) {
  const full  = Math.floor(rating);
  const half  = rating % 1 >= 0.5 ? 1 : 0;
  const empty = 5 - full - half;
  return '★'.repeat(full) + (half ? '½' : '') + '☆'.repeat(empty);
}

function renderCard(t, idx, showMatch) {
  const avatarStyle = AVATAR_COLORS[idx % AVATAR_COLORS.length];
  const initials    = getInitials(t.name);

  const matchBadge = showMatch && t.matchPercent
    ? `<span class="match-badge">${t.matchPercent}% Match</span>`
    : '';

  const tags = (t.tags || [])
    .map(tag => `<span class="tag">${tag}</span>`)
    .join('');

  const avatar = t.avatarUrl
    ? `<img src="${t.avatarUrl}" alt="${t.name}" class="avatar-wrap" style="object-fit:cover;" />`
    : `<div class="avatar-wrap" style="background:${avatarStyle.bg}; color:${avatarStyle.color};">${initials}</div>`;

  const stars = buildStars(t.rating || 4.5);

  return `
    <div class="col-12 col-md-6 col-lg-4">
      <div class="therapist-card">
        ${matchBadge}
        <div class="card-header-row">
          ${avatar}
          <div class="doctor-info">
            <div class="doctor-name">${t.name}</div>
            <div class="doctor-specialty">${t.specialty}</div>
          </div>
        </div>
        <div class="tag-list">${tags}</div>
        <p class="card-bio">${t.bio || ''}</p>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-label">Session</span>
            <span class="meta-value price">${t.price} EGP/hr</span>
          </div>
          <div class="meta-item">
            <span class="meta-label">Rating</span>
            <span class="meta-value">
              <span class="stars">${stars}</span>
              <small style="color:var(--text-muted);font-size:.75rem;"> ${t.rating || '4.5'}</small>
            </span>
          </div>
        </div>
        <div class="card-actions">
          <button class="btn-book" onclick="handleSelectTherapist(${t.id}, this)">
            Select Therapist
          </button>
        </div>
      </div>
    </div>
  `;
}

function populateGrid(gridId, therapists, showMatch) {
  const grid = document.getElementById(gridId);
  if (!grid) return;

  if (!therapists || therapists.length === 0) {
    grid.innerHTML = `
      <div class="col-12 text-center py-5">
        <p style="color:var(--text-muted);">No therapists found.</p>
      </div>`;
    return;
  }

  grid.innerHTML = therapists
    .map((t, i) => renderCard(t, i, showMatch))
    .join('');
}

// ── Select therapist — posts to backend ────────────────────────────────────
function handleSelectTherapist(therapistId, btn) {
  btn.disabled = true;
  btn.textContent = 'Selecting…';

  $.ajax({
    url: SELECT_THERAPIST_URL,
    method: 'POST',
    contentType: 'application/json',
    headers: {
      'X-CSRF-TOKEN': CSRF_TOKEN,
      'Accept': 'application/json',
    },
    data: JSON.stringify({ therapist_id: therapistId }),
    success: function (res) {
      // Backend redirects on success — follow the redirect URL if JSON, else reload
      if (res && res.redirect) {
        window.location.href = res.redirect;
      } else {
        window.location.href = '/patient/booking';
      }
    },
    error: function (xhr) {
      // If the server returned a redirect (302 followed to HTML) just navigate
      if (xhr.status === 200 || xhr.status === 302) {
        window.location.href = '/patient/booking';
        return;
      }
      const msg = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
      alert(msg);
      btn.disabled = false;
      btn.textContent = 'Select Therapist';
    },
  });
}

// ── Tab switching ──────────────────────────────────────────────────────────
function switchTab(tab) {
  document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + tab).classList.add('active');
  document.querySelector(`[data-tab="${tab}"]`).classList.add('active');
}

// ── Entry point ────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
  if (typeof MATCHING_DATA === 'undefined') {
    console.error('[matching.js] MATCHING_DATA is not defined.');
    return;
  }

  const matched = MATCHING_DATA.therapists?.matched ?? MATCHING_DATA.therapists ?? [];
  const all     = MATCHING_DATA.therapists?.all     ?? MATCHING_DATA.therapists ?? [];

  populateGrid('matching-grid', matched.length ? matched : all, true);
  populateGrid('all-grid', all, false);
});
