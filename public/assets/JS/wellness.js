let moods = document.querySelectorAll(".mood"),
    ctx = document.getElementById('myChart'),
    addGoalModal = document.getElementById('addGoalModal'),
    openAddGoal = document.getElementById('openAddGoal'),
    cancelAddGoal = document.getElementById('cancelAddGoal'),
    confirmAddGoal = document.getElementById('confirmAddGoal'),
    goalTitleInput = document.getElementById('goalTitleInput'),
    goalCurrentInput = document.getElementById('goalCurrentInput'),
    goalTotalInput = document.getElementById('goalTotalInput'),
    writeModal = document.getElementById('writeModal'),
    openWrite = document.getElementById('openWriteModal'),
    cancelWrite = document.getElementById('cancelWrite'),
    confirmWrite = document.getElementById('confirmWrite'),
    journalInput = document.getElementById('journalInput');



moods.forEach(item => {
    item.addEventListener("click", () => {
        moods.forEach(m => m.classList.remove("active"));
        item.classList.add("active");
    });
});



const verticalLinePlugin = {
    id: 'verticalLine',
    afterDraw: (chart) => {
        if (chart.tooltip?._active?.length) {
            let ctx = chart.ctx,
                activePoint = chart.tooltip._active[0],
                x = activePoint.element.x,
                topY = chart.scales.y.top,
                bottomY = chart.scales.y.bottom;

            ctx.save();
            ctx.beginPath();
            ctx.moveTo(x, topY);
            ctx.lineTo(x, bottomY);
            ctx.lineWidth = 1;
            ctx.strokeStyle = 'rgba(93, 118, 139, 0.3)';
            ctx.stroke();
            ctx.restore();
        }
    }
};



if (ctx) {
    new Chart(ctx, {
        type: 'line',
        plugins: [verticalLinePlugin],
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Mood',
                data: [3, 4, 3, 5, 4, 5, 4],
                borderColor: 'rgb(93, 118, 139)',
                backgroundColor: 'rgba(93, 118, 139, 0.08)',
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgb(93, 118, 139)',
                fill: true
            }]
        },
        options: {
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "rgb(248, 246, 243)",
                    titleColor: "rgb(35, 58, 78)",
                    bodyColor: "rgb(93, 118, 139)",
                    borderColor: "rgba(93, 118, 139, 0.2)",
                    borderWidth: 1,
                    callbacks: {
                        label: function (context) {
                            const labels = ['', 'Very Sad', 'Sad', 'Okay', 'Good', 'Great'];
                            return ' ' + (labels[context.raw] || context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    min: 1,
                    max: 5,
                    ticks: {
                        stepSize: 1,
                        color: 'rgb(122, 143, 158)',
                        callback: function (value) {
                            const labels = {
                                1: 'verySad',
                                2: 'Sad',
                                3: 'Okay',
                                4: 'Good',
                                5: 'Great'
                            };
                            return labels[value] || value;
                        }
                    },
                    grid: { color: 'rgba(93, 118, 139, 0.08)' }
                },
                x: {
                    ticks: { color: 'rgb(122, 143, 158)' },
                    grid: { display: false }
                }
            }
        }
    });
}



let goals = [
    { id: 1, title: "Morning meditation (10 min)", current: 1, total: 1 },
    { id: 2, title: "Journal 5 times this week", current: 4, total: 5 },
    { id: 3, title: "30 min walk, 3x per week", current: 2, total: 3 },
    { id: 4, title: "Read for 20 min each day", current: 2, total: 5 },
];


function renderGoals() {
    let list = document.getElementById('goalsList'),
        doneEl = document.getElementById('goalsDone'),
        doneCount = goals.filter(g => g.current >= g.total).length;
    if (!list) return;
    doneEl.textContent = doneCount + '/' + goals.length + ' done';

    list.innerHTML = goals.map(g => {
        let pct = Math.min((g.current / g.total) * 100, 100),
            done = g.current >= g.total;
        return `
            <div class="goal-item" data-id="${g.id}">
            <div class="goal-top">
            <div class="goal-check ${done ? 'checked' : ''}" data-toggle="${g.id}">
                <i class="fa-solid fa-check"></i>
            </div>

            <span class="goal-title">${g.title}</span>

            ${g.total > 1
                ? `<span class="goal-count">${g.current}/${g.total}</span>`
                : ''
            }

            <button class="goal-delete" data-delete="${g.id}" title="Remove">✕</button>
        </div>

        <div class="goal-bar-wrap">
            <div class="goal-bar-fill" style="width:${pct}%"></div>
        </div>
    </div>
    `;
    }).join('');

    list.querySelectorAll('[data-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            let id = parseInt(btn.dataset.toggle),
                goal = goals.find(g => g.id === id);
            if (!goal) return;

            goal.current = goal.current >= goal.total ? 0 : goal.current + 1;
            renderGoals();
        });
    });

    list.querySelectorAll('[data-delete]').forEach(btn => {
        btn.addEventListener('click', () => {
            goals = goals.filter(g => g.id !== parseInt(btn.dataset.delete));
            renderGoals();
        });
    });
}

renderGoals();


openAddGoal && openAddGoal.addEventListener('click', () => {
    addGoalModal.classList.add('active');
    goalTitleInput.focus();
});

cancelAddGoal && cancelAddGoal.addEventListener('click', () => {
    addGoalModal.classList.remove('active');
    goalTitleInput.value = goalCurrentInput.value = goalTotalInput.value = '';
});

confirmAddGoal && confirmAddGoal.addEventListener('click', () => {
    let title = goalTitleInput.value.trim(),
        current = parseInt(goalCurrentInput.value) || 0,
        total = parseInt(goalTotalInput.value) || 1;

    if (!title) {
        goalTitleInput.focus();
        return;
    }

    goals.push({ id: Date.now(), title, current, total });
    renderGoals();

    addGoalModal.classList.remove('active');
    goalTitleInput.value = goalCurrentInput.value = goalTotalInput.value = '';
});

addGoalModal && addGoalModal.addEventListener('click', e => {
    if (e.target === addGoalModal) addGoalModal.classList.remove('active');
});



let journalEntries = [
    { date: "Today · Wednesday, April 22", text: "Feeling much better today after the session. The breathing exercises really helped with the morning anxiety. I'm going to try the thought records worksheet Dr. Hassan shared…" },
    { date: "Tuesday, April 21", text: "Rough morning but managed to complete the meditation. Noticing patterns in when anxiety peaks — seems related to work deadlines." },
    { date: "Monday, April 20", text: "Good day overall. Took the long route home for a walk. Felt more grounded in the evening." },
];



function renderJournal() {
    const container = document.getElementById('journalEntries');
    if (!container) return;

    container.innerHTML = journalEntries.map(e => `
    <div class="journal-entry">
        <p class="entry-date">${e.date}</p>
        <p class="entry-text">${e.text}</p>
    </div>
`).join('');
}

renderJournal();



openWrite && openWrite.addEventListener('click', () => {
    writeModal.classList.add('active');
    journalInput.focus();
});

cancelWrite && cancelWrite.addEventListener('click', () => {
    writeModal.classList.remove('active');
    journalInput.value = '';
});

confirmWrite && confirmWrite.addEventListener('click', () => {
    const text = journalInput.value.trim();
    if (!text) {
        journalInput.focus();
        return;
    }

    const now = new Date();
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    const dateStr = 'Today · ' + days[now.getDay()] + ', ' + months[now.getMonth()] + ' ' + now.getDate();

    journalEntries.unshift({ date: dateStr, text });
    renderJournal();

    writeModal.classList.remove('active');
    journalInput.value = '';
});

writeModal && writeModal.addEventListener('click', e => {
    if (e.target === writeModal) {
        writeModal.classList.remove('active');
        journalInput.value = '';
    }
});