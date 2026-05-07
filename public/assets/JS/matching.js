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
  const full = Math.floor(rating);
  const half = rating % 1 >= 0.5 ? 1 : 0;
  const empty = 5 - full - half;
  return '★'.repeat(full) + (half ? '½' : '') + '☆'.repeat(empty);
}

/**
 * Render a single therapist card HTML string
 * @param {object}  t         – therapist data object
 * @param {number}  idx       – index for colour cycling
 * @param {boolean} showMatch – whether to show the match % badge
 */
function renderCard(t, idx, showMatch) {
  const avatarStyle = AVATAR_COLORS[idx % AVATAR_COLORS.length];
  const initials = getInitials(t.name);

  const matchBadge = showMatch && t.matchPercent
    ? `<span class="match-badge">${t.matchPercent}% Match</span>`
    : '';

  const tags = (t.tags || [])
    .map(tag => `<span class="tag">${tag}</span>`)
    .join('');


  const avatar = t.avatarUrl
    ? `<img src="${t.avatarUrl}" alt="${t.name}" class="avatar-wrap"
           style="object-fit:cover;" />`
    : `<div class="avatar-wrap" 
   style="background:${avatarStyle.bg}; color:${avatarStyle.color};">
   ${initials}
 </div>`

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
            <span class="meta-value price">$${t.price}/hr</span>
          </div>
          <div class="meta-item">
            <span class="meta-label">Experience</span>
            <span class="meta-value">12 yrs</span>
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
          <a href="#" class="btn-profile" onclick="handleViewProfile(${t.id}, event)">
            Show Profile
          </a>
          <a href="#" class="btn-book" onclick="handleBooking(${t.id}, event)">
            Booking Now
          </a>
        </div>
      </div>
    </div>
  `;
}

/**
 * Populate a grid element with therapist cards
 */
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

/* ── Placeholder action handlers (wire to routing later) ── */
function handleViewProfile(id, e) {
  e.preventDefault();
  console.log('[Show Profile] therapist id:', id);
  // TODO: navigate to /therapists/:id
}

function handleBooking(id, e) {
  e.preventDefault();
  console.log('[Booking Now] therapist id:', id);
  // TODO: navigate to /book/:id
}

/* ── Tab switching ── */
function switchTab(tab) {
  document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

  document.getElementById('tab-' + tab).classList.add('active');
  document.querySelector(`[data-tab="${tab}"]`).classList.add('active');
}

/* ── Entry point called by data files ── */
function initApp(data) {
  // data.matching → Tab 1  |  data.all → Tab 2
  populateGrid('matching-grid', data.matching, true);
  populateGrid('all-grid', data.all, false);
}

(function () {
  const testData = {

    /* ── Tab 1: Matched therapists ── */
    matching: [
      {
        id: 1,
        name: 'Dr. James Wilson',
        specialty: 'Clinical Psychologist',
        bio: 'Specializing in evidence-based therapy for adults dealing with life transitions and stress.',
        price: 80,
        rating: 4.9,
        avatarUrl: null,
      },
      {
        id: 2,
        name: 'Sarah Jenkins, LCSW',
        specialty: 'Family Counselor',
        bio: 'Helping couples and families build stronger communication and emotional resilience.',
        price: 95,
        rating: 4.7,
        avatarUrl: null,
      },
      {
        id: 3,
        name: 'Dr. Elena Rodriguez',
        specialty: 'Child Psychologist',
        bio: 'Focusing on child development and supporting parents through behavioral challenges.',
        price: 110,
        rating: 4.8,
        avatarUrl: null,
      },
    ],

    /* ── Tab 2: All therapists ── */
    all: [
      {
        id: 1,
        name: 'Dr. James Wilson',
        specialty: 'Clinical Psychologist',
        bio: 'Specializing in evidence-based therapy for adults dealing with life transitions and stress.',
        price: 80,
        rating: 4.9,
        avatarUrl: null,
      },
      {
        id: 2,
        name: 'Sarah Jenkins, LCSW',
        specialty: 'Family Counselor',
        bio: 'Helping couples and families build stronger communication and emotional resilience.',
        price: 95,
        rating: 4.7,
        avatarUrl: null,
      },
      {
        id: 3,
        name: 'Dr. Elena Rodriguez',
        specialty: 'Child Psychologist',
        bio: 'Focusing on child development and supporting parents through behavioral challenges.',
        price: 110,
        rating: 4.8,
        avatarUrl: null,
      },
      {
        id: 4,
        name: 'Dr. Omar Hassan',
        specialty: 'Psychiatrist',
        bio: 'Board-certified psychiatrist with a holistic approach to mental health and medication management.',
        price: 130,
        rating: 4.6,
        avatarUrl: null,
      },
      {
        id: 5,
        name: 'Layla Mansour, LPC',
        specialty: 'Trauma Therapist',
        bio: 'Specialized in trauma recovery using EMDR and somatic approaches for lasting healing.',
        price: 90,
        rating: 4.9,
        avatarUrl: null,
      },
      {
        id: 6,
        name: 'Dr. Aisha Patel',
        specialty: 'Couples Therapist',
        bio: 'Supporting couples through life\'s hardest moments with compassion and proven techniques.',
        price: 100,
        rating: 4.5,
        avatarUrl: null,
      },
      {
        id: 7,
        name: 'Marcus Green, LMFT',
        specialty: 'Marriage & Family Therapist',
        tags: ['Addiction', 'Family Systems', 'CBT'],
        bio: 'Helping families rebuild trust and healthy dynamics through systemic therapy.',
        price: 85,
        rating: 4.7,
        avatarUrl: null,
      },
    ],

  };

  // Fire after DOM is ready
  document.addEventListener('DOMContentLoaded', () => initApp(testData));
})();