<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MindCare</title>
    <link rel="shortcut icon" href="{{ asset('assets/Images/favIcon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/wellness.css') }}">
</head>

<body>
    @include('shared.nav')

    <div class="container main dashboard">

        <div class="heading mt-5">
            <h2 class="fs-1">
                Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }},
                {{ $patient->first_name }}!
            </h2>
            <p>
                @if ($moodStreak > 0)
                    🔥 {{ $moodStreak }}-day streak! Keep it up!
                @else
                    How are you feeling today?
                @endif
            </p>
        </div>

        <div class="left">

            <div class="mood-card">
                <div class="card-header">
                    <h3>Daily Check-in</h3>
                </div>
                <p class="sub-text">Rate your mood today</p>
                <div class="moods">
                    <div class="mood VerySad">
                        <i class="fa-solid fa-heart-crack"></i>
                        <span>Very Sad</span>
                    </div>
                    <div class="mood Sad">
                        <i class="fa-regular fa-face-sad-cry"></i>
                        <span>Sad</span>
                    </div>
                    <div class="mood Okay">
                        <i class="fa-regular fa-face-meh"></i>
                        <span>Okay</span>
                    </div>
                    <div class="mood Good">
                        <i class="fa-regular fa-face-smile"></i>
                        <span>Good</span>
                    </div>
                    <div class="mood Great">
                        <i class="fa-regular fa-face-smile-beam"></i>
                        <span>Great</span>
                    </div>
                </div>
                <button>Save Today's Mood</button>
            </div>

            <div class="chart-card">
                <div class="card-header">
                    <h3>Mood This Week</h3>
                </div>
                <p class="sub-text">Your emotional journey over the past 7 days</p>
                <canvas id="myChart"></canvas>
            </div>

            <div class="journal-card">
                <div class="journal-header">
                    <h3>Journal</h3>
                    <button class="write-btn" id="openWriteModal">+ Write</button>
                </div>
                <div class="journal-entries" id="journalEntries">
                    @forelse ($journals as $journal)
                        <div class="journal-entry">
                            <p class="entry-date">
                                {{ $journal->created_at->isToday() ? 'Today · ' : '' }}
                                {{ $journal->created_at->format('l, F j') }}
                            </p>
                            <p class="entry-text">{{ Str::limit($journal->journal_entry, 150) }}</p>
                        </div>
                    @empty
                        <p class="text-muted" style="padding: 1rem;">No journal entries yet.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="right">

            <div class="session-card">
                <div class="header">
                    <span class="icon"><i class="fa-regular fa-calendar-days"></i></span>
                    <h3>Upcoming Sessions</h3>
                </div>
                @forelse ($upcomingSessions as $session)
                    <div class="session">
                        <div class="avatar">
                            {{ strtoupper(substr($session->therapist->first_name, 0, 1)) }}{{ strtoupper(substr($session->therapist->last_name, 0, 1)) }}
                        </div>
                        <div class="info">
                            <h4>Dr. {{ $session->therapist->first_name }} {{ $session->therapist->last_name }}</h4>
                            <p class="type">{{ $session->therapist->specialization ?? 'Therapist' }}</p>
                            <p class="time">
                                {{ \Carbon\Carbon::parse($session->session_time)->isToday() ? 'Today' : \Carbon\Carbon::parse($session->session_time)->format('D, M j') }}
                                • {{ \Carbon\Carbon::parse($session->session_time)->format('g:i A') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted" style="padding: 1rem;">No upcoming sessions.</p>
                @endforelse
            </div>

            <div class="goals-card">
                <div class="goals-card-header">
                    <h3>Weekly Goals</h3>
                    <span class="goals-done" id="goalsDone">0/4 done</span>
                </div>
                <div id="goalsList"></div>
                <button class="add-goal-btn" id="openAddGoal">+ Add Goal</button>
            </div>

            <div class="modal-overlay" id="addGoalModal">
                <div class="modal-box">
                    <h4>Add New Goal</h4>
                    <input type="text" id="goalTitleInput" placeholder="Goal title (e.g. Meditate 10 min)"
                        class="modal-input" />
                    <div class="modal-row">
                        <input type="number" id="goalCurrentInput" placeholder="Current" min="0"
                            class="modal-input-sm" />
                        <span>/</span>
                        <input type="number" id="goalTotalInput" placeholder="Total" min="1"
                            class="modal-input-sm" />
                    </div>
                    <div class="modal-actions">
                        <button class="modal-cancel" id="cancelAddGoal">Cancel</button>
                        <button class="modal-confirm" id="confirmAddGoal">Add</button>
                    </div>
                </div>
            </div>

            <div class="modal-overlay" id="writeModal">
                <div class="modal-box">
                    <h4>New Journal Entry</h4>
                    <textarea id="journalInput" placeholder="How are you feeling today…" class="modal-textarea"></textarea>
                    <div class="modal-actions">
                        <button class="modal-cancel" id="cancelWrite">Cancel</button>
                        <button class="modal-confirm" id="confirmWrite">Save</button>
                    </div>
                </div>
            </div>

            <div class="actions-card">
                <div class="header">
                    <span class="icon"><i class="fa-solid fa-bolt"></i></span>
                    <h3>Quick Actions</h3>
                </div>
                <div class="actions-grid">
                    <button class="action-btn">
                        <i class="fa-solid fa-brain"></i>
                        <span>Meditate</span>
                    </button>
                    <button class="action-btn">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Journal</span>
                    </button>
                    <button class="action-btn">
                        <i class="fa-solid fa-wind"></i>
                        <span>Breathe</span>
                    </button>
                    <button class="action-btn">
                        <i class="fa-solid fa-headphones"></i>
                        <span>Listen</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    @include('shared.footer')

    <div class="loadingPage">
        <div class="loader"></div>
    </div>

    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/chart.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
    <script src="{{ asset('assets/JS/wellness.js') }}"></script>

</body>

</html>