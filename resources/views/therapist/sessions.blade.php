<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MindCare</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/Images/favIcon.png') }}" type="image/x-icon">


    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/session.css') }}" />
</head>

<body>
    <header class="hdr">
        <div class="d-flex align-items-center gap-3">
            <div class="hdr-info">
                <h2>Session with <span id="doc-name">Dr. {{ $session->therapist->name }}</span></h2>
            </div>
        </div>
        <div class="hdr-right">
            <span class="badge-live"><span class="dot-live"></span> Live</span>
            <span class="hdr-timer" id="dur">00:00</span>
        </div>
    </header>
    <div class="main">
        <div class="video-section">
            <div class="video-grid">
                <div class="vid-card">
                    <div class="vid-box speaking" id="vid-self">
                        <div class="vid-avatar av-green" id="av-self">
                            {{ strtoupper(substr($session->patient->name, 0, 2)) }}
                        </div>
                        <div class="wave-wrap">
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                        </div>
                        <div class="vid-bar">
                            <span class="vid-bar-name">{{ $session->patient->name }} (You)</span>
                            <span class="mute-pill" id="mute-pill" style="display:none;">Muted</span>
                        </div>
                    </div>
                    <span class="vid-name">You</span>
                </div>
                <div class="vid-card">
                    <div class="vid-box" id="vid-patient">
                        <div class="vid-avatar av-warm">
                            {{ strtoupper(substr($session->therapist->name, 0, 2)) }}
                        </div>
                        <div class="wave-wrap">
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                        </div>
                        <div class="vid-bar">
                            <span class="vid-bar-name">Dr. {{ $session->therapist->name }}</span>
                        </div>
                    </div>
                    <span class="vid-name">Dr. {{ $session->therapist->name }}</span>
                </div>
            </div>
            <div class="controls">
                <button class="ctrl" id="btn-mic" title="Mute" onclick="toggleMic()">
                    <svg viewBox="0 0 24 24">
                        <rect x="9" y="3" width="6" height="11" rx="3" />
                        <path d="M5 10a7 7 0 0 0 14 0" />
                        <line x1="12" y1="19" x2="12" y2="22" />
                        <line x1="8" y1="22" x2="16" y2="22" />
                    </svg>
                </button>
                <button class="ctrl" title="Session Notes" onclick="switchTab('notes')">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                </button>
                <button class="ctrl" title="Chat" onclick="switchTab('chat')">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                </button>
                <button class="ctrl end-call" title="End session" onclick="confirmEnd()">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M10.68 13.31a16 16 0 003.41 2.6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 18v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.42 19.42 0 013.07 8.63 2 2 0 015 6.45h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L10.68 13.31z"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <line x1="22" y1="2" x2="2" y2="22" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="side">
            <div class="tabs">
                <button class="tab-btn on" id="tab-notes" onclick="switchTab('notes')">Session Notes</button>
                <button class="tab-btn" id="tab-chat" onclick="switchTab('chat')">Chat</button>
            </div>
            <div class="panel on" id="panel-notes">
                <div class="notes-body">
                    <p style="font-size:11px; color:var(--muted);">Notes — private to you</p>
                    <textarea id="notes-area" placeholder="Write session observations, patient progress, homework assigned…">{{ $session->notes ?? '' }}</textarea>
                    <button class="save-btn" onclick="saveNotes()">Save notes</button>
                    <span id="notes-msg" style="font-size:12px; margin-left:8px;"></span>
                </div>
            </div>
            <div class="panel" id="panel-chat">
                <div class="chat-body" id="chat-msgs">
                    @foreach ($session->chatMessages as $msg)
                        @php
                            $isMine = $msg->sender_type === 'patient' && $msg->sender_id === $session->patient_id;
                        @endphp
                        <div class="msg {{ $isMine ? 'mine' : '' }}" data-msg-id="{{ $msg->id }}">
                            <span class="msg-who">
                                {{ $isMine ? 'You' : 'Dr. ' . $session->therapist->name }}
                            </span>
                            <div class="bubble">{{ $msg->message }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="chat-footer">
                    <input type="text" id="chat-in" placeholder="Message Dr. {{ $session->therapist->name }}…"
                        onkeydown="if(event.key==='Enter') sendMsg()" />
                    <button class="send-btn" onclick="sendMsg()">↑</button>
                </div>
            </div>
        </div>
    </div>
    <div class="loadingPage">
        <div class="loader"></div>
    </div>
    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>

    <script>
        const SESSION_ID = {{ $session->id }};
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
        const ROUTES = {
            chat: `/sessions/${SESSION_ID}/chat`,
            mute: `/sessions/${SESSION_ID}/mute`,
            notes: `/patient/sessions/${SESSION_ID}/notes`,
            leave: `/patient/sessions/${SESSION_ID}/leave`,
        };
        let lastMsgId = {{ $session->chatMessages->last()?->id ?? 0 }};

        function csrfFetch(url, options = {}) {
            return fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                    ...options.headers,
                },
                ...options,
            });
        }
        var start = Date.now();

        function pad(n) {
            return n < 10 ? '0' + n : n;
        }

        function tick() {
            var s = Math.floor((Date.now() - start) / 1000);
            document.getElementById('dur').textContent = pad(Math.floor(s / 60)) + ':' + pad(s % 60);
        }
        tick();
        setInterval(tick, 1000);
        var selfSpeaking = true;
        var isMuted = false;

        function toggleSpeaker() {
            var selfBox = document.getElementById('vid-self');
            var patientBox = document.getElementById('vid-patient');
            if (isMuted) {
                selfBox.classList.remove('speaking');
                patientBox.classList.toggle('speaking');
            } else {
                selfSpeaking = !selfSpeaking;
                selfBox.classList.toggle('speaking', selfSpeaking);
                patientBox.classList.toggle('speaking', !selfSpeaking);
            }
        }
        setInterval(toggleSpeaker, 4200);

        function toggleMic() {
            var btn = document.getElementById('btn-mic');
            var box = document.getElementById('vid-self');
            var mutePill = document.getElementById('mute-pill');
            btn.classList.toggle('off');
            isMuted = btn.classList.contains('off');
            btn.title = isMuted ? 'Unmute' : 'Mute';
            box.classList.toggle('muted', isMuted);
            mutePill.style.display = isMuted ? 'inline-flex' : 'none';
            if (isMuted) box.classList.remove('speaking');
            csrfFetch(ROUTES.mute, {
                    method: 'POST'
                })
                .catch(err => console.error('Mute error:', err));
        }

        function switchTab(t) {
            ['notes', 'chat'].forEach(function(n) {
                document.getElementById('tab-' + n).classList.toggle('on', n === t);
                document.getElementById('panel-' + n).classList.toggle('on', n === t);
            });
        }

        function escapeHtml(str) {
            return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        function appendMessage({
            sender_name,
            message,
            is_mine,
            id
        }) {
            var msgs = document.getElementById('chat-msgs');
            var d = document.createElement('div');
            d.className = 'msg' + (is_mine ? ' mine' : '');
            if (id) d.dataset.msgId = id;
            d.innerHTML = `<span class="msg-who">${sender_name}</span>
                        <div class="bubble">${escapeHtml(message)}</div>`;
            msgs.appendChild(d);
            msgs.scrollTop = msgs.scrollHeight;
        }

        function sendMsg() {
            var inp = document.getElementById('chat-in');
            var txt = inp.value.trim();
            if (!txt) return;
            appendMessage({
                sender_name: 'You',
                message: txt,
                is_mine: true
            });
            inp.value = '';
            csrfFetch(ROUTES.chat, {
                    method: 'POST',
                    body: JSON.stringify({
                        message: txt
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) lastMsgId = data.chat.id;
                })
                .catch(err => console.error('Chat error:', err));
        }

        function pollMessages() {
            csrfFetch(`${ROUTES.chat}?after_id=${lastMsgId}`)
                .then(r => r.json())
                .then(data => {
                    data.messages.forEach(msg => {
                        if (!msg.is_mine) {
                            appendMessage(msg);
                        }
                        if (msg.id > lastMsgId) lastMsgId = msg.id;
                    });
                })
                .catch(err => console.error('Poll error:', err));
        }
        setInterval(pollMessages, 3000);

        function saveNotes() {
            var notes = document.getElementById('notes-area').value;
            var msg = document.getElementById('notes-msg');
            msg.textContent = 'Saving…';
            msg.style.color = 'var(--muted)';
            csrfFetch(ROUTES.notes, {
                    method: 'POST',
                    body: JSON.stringify({
                        notes: notes
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    msg.textContent = data.success ? '✓ Saved' : '✗ Error';
                    msg.style.color = data.success ? 'green' : 'red';
                    setTimeout(() => msg.textContent = '', 3000);
                })
                .catch(() => {
                    msg.textContent = '✗ Failed';
                    msg.style.color = 'red';
                });
        }
        setInterval(saveNotes, 60000);

        function confirmEnd() {
            if (!confirm('End session with Dr. {{ $session->therapist->name }}?')) return;

            csrfFetch(ROUTES.leave, {
                    method: 'POST'
                })
                .then(r => r.json())
                .then(data => {
                    window.location.href = data.redirect || '/';
                })
                .catch(() => window.location.href = '/');
        }
    </script>

</body>

</html>
