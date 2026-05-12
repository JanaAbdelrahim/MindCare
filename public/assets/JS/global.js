// LoadingPage
$(document).ready(function () {
    setTimeout(function () {
        $(".loadingPage").fadeOut(1000, function () {
            $(this).addClass("d-none");
        });
    }, 1000);
});

function openPopUp(popUpName) {
    $(`.popUp.${popUpName}`).fadeIn(200).delay().css("display", "flex");
}

function closePopUp() {
    $(`.popUp`).fadeOut(200);
}

$(".popUp .box").click(function (e) {
    e.stopPropagation();
});

const MOTIVATIONAL = [
    "Every session is a step forward. ",
    "You're braver than you believe. ",
    "Taking care of your mind is an act of courage. ",
    "Progress, not perfection. ",
    "You showed up — that's what matters. ",
];

function renderNotifications(list) {
    const container = document.getElementById('notif-list');
    const badge     = document.getElementById('notif-badge');
    if (!container) return;

    let html = '';

    if (window.NOTIF_IS_PATIENT) {
        const msg = MOTIVATIONAL[Math.floor(Math.random() * MOTIVATIONAL.length)];
        html += `<div class="notif-item motivational">
                    <i class="fa-solid fa-heart"></i>
                    <span>${msg}</span>
                </div>`;
    }

    if (!list || list.length === 0) {
        html += '<div class="notif-empty">No notifications yet.</div>';
    } else {
        list.forEach(n => {
            const unread = !n.is_read ? 'unread' : '';
            const time   = n.created_at
                ? new Date(n.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })
                : '';
            html += `<div class="notif-item ${unread}">
                        <div class="notif-msg">${n.message}</div>
                        ${time ? `<div class="notif-time">${time}</div>` : ''}
                        ${!n.is_read && n.id && window.NOTIF_READ_URL
                            ? `<button class="notif-read-btn" onclick="markNotifRead(${n.id})">Mark as read</button>`
                            : ''}
                    </div>`;
        });
    }

    container.innerHTML = html;

    const unreadCount = list.filter(n => !n.is_read).length;
    if (badge) {
        badge.textContent   = unreadCount;
        badge.style.display = unreadCount > 0 ? 'inline-flex' : 'none';
    }
}

async function loadNotifications() {
    if (!window.NOTIF_URL) return;
    const container = document.getElementById('notif-list');
    if (container) container.innerHTML = '<div class="notif-loading">Loading…</div>';

    try {
        const res  = await fetch(window.NOTIF_URL, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        renderNotifications(Array.isArray(data) ? data : []);
    } catch {
        const c = document.getElementById('notif-list');
        if (c) c.innerHTML = '<div class="notif-empty">Failed to load.</div>';
    }
}

async function markNotifRead(id) {
    if (!window.NOTIF_READ_URL) return;
    const url = window.NOTIF_READ_URL.replace('__id__', id);
    await fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        }
    });
    loadNotifications();
}
const _origOpen = window.openPopUp;
window.openPopUp = function (type) {
    if (_origOpen) _origOpen(type);
    if (type === 'notifications') loadNotifications();
};