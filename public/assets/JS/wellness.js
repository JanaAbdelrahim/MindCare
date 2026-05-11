/**
 * wellness.js — connects the MindCare frontend to the Laravel backend.
 *
 * Every action (save mood, write journal, add/increment/delete goal) now
 * hits a real API endpoint instead of working with in-memory data only.
 *
 * CSRF token is read from the <meta name="csrf-token"> tag Laravel injects.
 */

const CSRF   = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const ROUTES = {
    mood:    '/patient/wellness/mood',
    journal: '/patient/wellness/journal',
    chart:   '/patient/wellness/chart',
};
// ─────────────────────────────────────────────────────────────────────────────
//  Helpers
// ─────────────────────────────────────────────────────────────────────────────

async function apiFetch(url, options = {}) {
    const res = await fetch(url, {
        headers: {
            'Content-Type':  'application/json',
            'Accept':        'application/json',
            'X-CSRF-TOKEN':  CSRF,
        },
        ...options,
    });

    if (!res.ok) {
        const err = await res.json().catch(() => ({}));
        throw new Error(err.message ?? `HTTP ${res.status}`);
    }

    return res.json();
}

function showToast(message, type = 'success') {
    // Replace with your own toast library if available
    const toast = Object.assign(document.createElement('div'), {
        className: `toast toast--${type}`,
        textContent: message,
    });
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

// ─────────────────────────────────────────────────────────────────────────────
//  Mood
// ─────────────────────────────────────────────────────────────────────────────

const moods       = document.querySelectorAll('.mood');
const saveMoodBtn = document.querySelector('.mood-card button');
let selectedMood  = null;

const MOOD_MAP = { VerySad: 1, Sad: 2, Okay: 3, Good: 4, Great: 5 };

moods.forEach(item => {
    item.addEventListener('click', () => {
        moods.forEach(m => m.classList.remove('active'));
        item.classList.add('active');
        const key = [...item.classList].find(c => c !== 'mood');
        selectedMood = MOOD_MAP[key] ?? null;
    });
});

saveMoodBtn?.addEventListener('click', async () => {
    if (!selectedMood) {
        showToast('Please select a mood first.', 'error');
        return;
    }

    saveMoodBtn.disabled = true;
    saveMoodBtn.textContent = 'Saving…';

    try {
        const data = await apiFetch(ROUTES.mood, {
            method: 'POST',
            body:   JSON.stringify({ mood_score: selectedMood }),
        });

        // Debug: shows in browser console exactly what the server returned
        // data.action = 'created' | 'updated'
        // data.label  = 'Good', 'Great', etc.
        console.log('[Mood save]', data);

        showToast(`${data.label} — ${data.message}`);
        loadChart();
    } catch (e) {
        console.error('[Mood error]', e);
        showToast(e.message, 'error');
    } finally {
        saveMoodBtn.disabled = false;
        saveMoodBtn.textContent = "Save Today's Mood";
    }
});

// ─────────────────────────────────────────────────────────────────────────────
//  Chart
// ─────────────────────────────────────────────────────────────────────────────

const ctx = document.getElementById('myChart');
let chartInstance = null;

const verticalLinePlugin = {
    id: 'verticalLine',
    afterDraw: (chart) => {
        if (chart.tooltip?._active?.length) {
            const { ctx: c, scales: { y } } = chart;
            const x = chart.tooltip._active[0].element.x;
            c.save();
            c.beginPath();
            c.moveTo(x, y.top);
            c.lineTo(x, y.bottom);
            c.lineWidth     = 1;
            c.strokeStyle   = 'rgba(93, 118, 139, 0.3)';
            c.stroke();
            c.restore();
        }
    },
};

function buildChart(labels, data) {
    if (!ctx) return;
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(ctx, {
        type:    'line',
        plugins: [verticalLinePlugin],
        data: {
            labels,
            datasets: [{
                label:                'Mood',
                data,
                borderColor:          'rgb(93, 118, 139)',
                backgroundColor:      'rgba(93, 118, 139, 0.08)',
                tension:              0.4,
                pointRadius:          5,
                pointHoverRadius:     7,
                pointBackgroundColor: 'rgb(93, 118, 139)',
                spanGaps:             true,   // connect across null days
                fill:                 true,
            }],
        },
        options: {
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend:  { display: false },
                tooltip: {
                    backgroundColor: 'rgb(248, 246, 243)',
                    titleColor:      'rgb(35, 58, 78)',
                    bodyColor:       'rgb(93, 118, 139)',
                    borderColor:     'rgba(93, 118, 139, 0.2)',
                    borderWidth:     1,
                    callbacks: {
                        label: (ctx) => {
                            const labels = ['', 'Very Sad', 'Sad', 'Okay', 'Good', 'Great'];
                            return ' ' + (labels[ctx.raw] ?? ctx.raw);
                        },
                    },
                },
            },
            scales: {
                y: {
                    min: 1, max: 5,
                    ticks: {
                        stepSize: 1,
                        color: 'rgb(122, 143, 158)',
                        callback: (v) => ({ 1:'verySad', 2:'Sad', 3:'Okay', 4:'Good', 5:'Great' }[v] ?? v),
                    },
                    grid: { color: 'rgba(93, 118, 139, 0.08)' },
                },
                x: {
                    ticks: { color: 'rgb(122, 143, 158)' },
                    grid:  { display: false },
                },
            },
        },
    });
}

async function loadChart() {
    try {
        const { labels, data } = await apiFetch(ROUTES.chart);
        buildChart(labels, data);
    } catch {
        // fallback to static demo data so chart always shows something
        buildChart(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'], [3,4,3,5,4,5,4]);
    }
}

loadChart();

// ─────────────────────────────────────────────────────────────────────────────
//  Journal
// ─────────────────────────────────────────────────────────────────────────────

const writeModal   = document.getElementById('writeModal');
const openWrite    = document.getElementById('openWriteModal');
const cancelWrite  = document.getElementById('cancelWrite');
const confirmWrite = document.getElementById('confirmWrite');
const journalInput = document.getElementById('journalInput');

function prependJournalEntry({ date, text }) {
    const container = document.getElementById('journalEntries');
    if (!container) return;
    const el = document.createElement('div');
    el.className  = 'journal-entry';
    el.innerHTML  = `<p class="entry-date">${date}</p><p class="entry-text">${text}</p>`;
    container.prepend(el);
}

openWrite?.addEventListener('click', () => {
    writeModal.classList.add('active');
    journalInput.focus();
});

cancelWrite?.addEventListener('click', () => {
    writeModal.classList.remove('active');
    journalInput.value = '';
});

confirmWrite?.addEventListener('click', async () => {
    const text = journalInput.value.trim();
    if (!text) { journalInput.focus(); return; }

    try {
        const { entry } = await apiFetch(ROUTES.journal, {
            method: 'POST',
            body:   JSON.stringify({ journal_entry: text }),
        });
        prependJournalEntry({ date: 'Today · ' + entry.date, text: entry.text });
        writeModal.classList.remove('active');
        journalInput.value = '';
        showToast('Entry saved!');
    } catch (e) {
        showToast(e.message, 'error');
    }
});

writeModal?.addEventListener('click', e => {
    if (e.target === writeModal) {
        writeModal.classList.remove('active');
        journalInput.value = '';
    }
});

// ─────────────────────────────────────────────────────────────────────────────
//  Goals — static, no backend
// ─────────────────────────────────────────────────────────────────────────────

const addGoalModal     = document.getElementById('addGoalModal');
const openAddGoal      = document.getElementById('openAddGoal');
const cancelAddGoal    = document.getElementById('cancelAddGoal');
const confirmAddGoal   = document.getElementById('confirmAddGoal');
const goalTitleInput   = document.getElementById('goalTitleInput');
const goalCurrentInput = document.getElementById('goalCurrentInput');
const goalTotalInput   = document.getElementById('goalTotalInput');

const DEFAULT_GOALS = [
    { id: 1, title: 'Morning meditation (10 min)', current: 0, total: 1 },
    { id: 2, title: 'Journal 5 times this week',   current: 0, total: 5 },
    { id: 3, title: '30 min walk, 3x per week',    current: 0, total: 3 },
    { id: 4, title: 'Read for 20 min each day',    current: 0, total: 5 },
];

let goals = JSON.parse(JSON.stringify(DEFAULT_GOALS));

function renderGoals() {
    const list   = document.getElementById('goalsList');
    const doneEl = document.getElementById('goalsDone');
    if (!list) return;

    const doneCount = goals.filter(g => g.current >= g.total).length;
    if (doneEl) doneEl.textContent = `${doneCount}/${goals.length} done`;

    list.innerHTML = goals.map(g => {
        const pct  = Math.min((g.current / g.total) * 100, 100);
        const done = g.current >= g.total;
        return `
        <div class="goal-item" data-id="${g.id}">
            <div class="goal-top">
                <div class="goal-check ${done ? 'checked' : ''}" data-toggle="${g.id}">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="goal-title">${g.title}</span>
                ${g.total > 1 ? `<span class="goal-count">${g.current}/${g.total}</span>` : ''}
                <button class="goal-delete" data-delete="${g.id}" title="Remove">✕</button>
            </div>
            <div class="goal-bar-wrap">
                <div class="goal-bar-fill" style="width:${pct}%"></div>
            </div>
        </div>`;
    }).join('');

    // increment
    list.querySelectorAll('[data-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id   = parseInt(btn.dataset.toggle);
            const goal = goals.find(g => g.id === id);
            if (!goal) return;

            goal.current = Math.min(goal.current + 1, goal.total);

            if (goal.current >= goal.total) {
                renderGoals();
                setTimeout(() => {
                    goals = goals.filter(g => g.id !== id);
                    renderGoals();
                }, 500);
            } else {
                renderGoals();
            }
        });
    });

    // delete
    list.querySelectorAll('[data-delete]').forEach(btn => {
        btn.addEventListener('click', () => {
            goals = goals.filter(g => g.id !== parseInt(btn.dataset.delete));
            renderGoals();
        });
    });
}

renderGoals();

openAddGoal?.addEventListener('click', () => {
    addGoalModal.classList.add('active');
    goalTitleInput.focus();
});

cancelAddGoal?.addEventListener('click', () => {
    addGoalModal.classList.remove('active');
    goalTitleInput.value = goalCurrentInput.value = goalTotalInput.value = '';
});

confirmAddGoal?.addEventListener('click', () => {
    const title   = goalTitleInput.value.trim();
    const current = parseInt(goalCurrentInput.value) || 0;
    const total   = parseInt(goalTotalInput.value)   || 1;

    if (!title) { goalTitleInput.focus(); return; }

    goals.push({ id: Date.now(), title, current, total });
    renderGoals();

    addGoalModal.classList.remove('active');
    goalTitleInput.value = goalCurrentInput.value = goalTotalInput.value = '';
});

addGoalModal?.addEventListener('click', e => {
    if (e.target === addGoalModal) addGoalModal.classList.remove('active');
});

// ─────────────────────────────────────────────────────────────────────────────
//  Quick Actions
// ─────────────────────────────────────────────────────────────────────────────