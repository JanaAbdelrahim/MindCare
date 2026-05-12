// ─────────────────────────────────────────────────────────────────────────────
// booking.js — uses BOOKING_DATA injected by booking.blade.php
// ─────────────────────────────────────────────────────────────────────────────

let selectedSlot = null; // { id, label, datetime }

// ── Helpers ───────────────────────────────────────────────────────────────────
function showError(msg) {
    const el = document.getElementById('booking-error');
    if (!el) return;
    el.textContent = msg;
    el.style.display = 'block';
    setTimeout(() => { el.style.display = 'none'; }, 5000);
}

function showSuccess(msg) {
    const el = document.getElementById('booking-success');
    if (!el) return;
    el.textContent = msg;
    el.style.display = 'block';
}

// ── Render doctor card ────────────────────────────────────────────────────────
function renderDoctor(t) {
    document.getElementById('doc-avatar').textContent    = t.initials;
    document.getElementById('doc-name').textContent      = t.name;
    document.getElementById('doc-specialty').textContent = t.specialty +
        (t.language ? ' · ' + t.language : '');
    document.getElementById('doc-price').textContent     =
        'Session price: ' + t.price + ' ' + t.currency;
    document.getElementById('sel-price').textContent     =
        t.price + ' ' + t.currency;
}

// ── Render slots ──────────────────────────────────────────────────────────────
function renderSlots(slots) {
    const allGrid   = document.getElementById('all-slots');
    const availGrid = document.getElementById('avail-slots');

    allGrid.innerHTML   = '';
    availGrid.innerHTML = '';

    if (!slots || slots.length === 0) {
        allGrid.innerHTML   = '<p class="no-slots">No slots added yet.</p>';
        availGrid.innerHTML = '<p class="no-slots">No available slots.</p>';
        return;
    }

    slots.forEach(s => {
        const staticEl       = document.createElement('div');
        staticEl.className   = 'slot static';
        staticEl.textContent = s.label;
        allGrid.appendChild(staticEl);

        const availEl       = document.createElement('div');
        availEl.className   = 'slot available';
        availEl.textContent = s.label;
        availEl.onclick     = () => selectSlot(availEl, s);
        availGrid.appendChild(availEl);
    });
}

// ── Select a slot ─────────────────────────────────────────────────────────────
function selectSlot(el, slot) {
    document.querySelectorAll('#avail-slots .slot').forEach(e => {
        e.className = 'slot available';
    });
    el.className = 'slot selected';
    selectedSlot = slot;

    document.getElementById('sel-label').textContent       = slot.label;
    document.getElementById('selected-info').style.display = 'flex';

    const btn         = document.getElementById('proceed-btn');
    btn.disabled      = false;
    btn.textContent   = 'Confirm Booking →';
}

// ── Submit booking ────────────────────────────────────────────────────────────
async function submitBooking() {
    if (!selectedSlot) return;

    const btn       = document.getElementById('proceed-btn');
    btn.disabled    = true;
    btn.textContent = 'Booking…';

    try {
        const res = await fetch(BOOKING_STORE_URL, {
            method:  'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept':       'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify({
                therapist_id: BOOKING_DATA.therapist.id,
                slot_id:      selectedSlot.id,
                session_time: selectedSlot.datetime,
            }),
        });

        const data = await res.json();

        if (!res.ok) {
            showError(data.message || 'Booking failed. Please try again.');
            btn.disabled    = false;
            btn.textContent = 'Confirm Booking →';
            return;
        }

        // ── success: redirect to payment ──────────────────────────────────────
        showSuccess('Session booked! Redirecting to payment… 💳');
        btn.textContent = '✓ Booked';

        setTimeout(() => {
            window.location.href = '/patient/payment/' + data.session.id;
        }, 1200);

    } catch (err) {
        showError('Network error. Please check your connection and try again.');
        btn.disabled    = false;
        btn.textContent = 'Confirm Booking →';
    }
}

// ── Entry point ───────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    if (typeof BOOKING_DATA === 'undefined') {
        console.error('[booking.js] BOOKING_DATA is not defined.');
        return;
    }

    renderDoctor(BOOKING_DATA.therapist);
    renderSlots(BOOKING_DATA.slots);

    document.getElementById('proceed-btn')
        .addEventListener('click', submitBooking);
});