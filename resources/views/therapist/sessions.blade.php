<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MindCare</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/session.css') }}" />
</head>

<body>



    <header class="hdr">
        <div class="d-flex align-items-center gap-3">
            <div class="hdr-info">
                <h2>Session with <span id="patient-name">Sara Ahmed</span></h2>
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
                        <div class="vid-avatar av-green" id="av-self">LH</div>
                        <div class="wave-wrap">
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                        </div>
                        <div class="vid-bar">
                            <span class="vid-bar-name">Dr. Laila Hassan (You)</span>
                            <span class="mute-pill">Muted</span>
                        </div>
                    </div>
                    <span class="vid-name">You</span>
                </div>


                <div class="vid-card">
                    <div class="vid-box" id="vid-patient">
                        <div class="vid-avatar av-warm">SA</div>
                        <div class="wave-wrap">
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                            <div class="wb"></div>
                        </div>
                        <div class="vid-bar">
                            <span class="vid-bar-name">Sara Ahmed</span>
                        </div>
                    </div>
                    <span class="vid-name">Sara Ahmed</span>
                </div>
            </div>


            <div class="controls">
                <!-- Mic -->
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
                    <p style="font-size:11px;color:var(--muted);">Clinical notes — private to you</p>
                    <textarea placeholder="Write session observations, patient progress, homework assigned…">-.</textarea>
                    <button class="save-btn">Save notes</button>
                </div>
            </div>


            <div class="panel" id="panel-chat">
                <div class="chat-body" id="chat-msgs">
                    <div class="msg">
                        <span class="msg-who">Sara Ahmed</span>
                        <div class="bubble">I've been sleeping a bit better this week!</div>
                    </div>
                    <div class="msg mine">
                        <span class="msg-who">You</span>
                        <div class="bubble">That's great progress! The breathing exercises are working.</div>
                    </div>
                    <div class="msg">
                        <span class="msg-who">Sara Ahmed</span>
                        <div class="bubble">Yes, I do them every night now 😊</div>
                    </div>
                </div>
                <div class="chat-footer">
                    <input type="text" id="chat-in" placeholder="Message Sara…"
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

            btn.classList.toggle('off');
            box.classList.toggle('muted');

            isMuted = btn.classList.contains('off');
            btn.title = isMuted ? 'Unmute' : 'Mute';

            if (isMuted) {
                document.getElementById('vid-self').classList.remove('speaking');
            }
        }

        function switchTab(t) {
            ['notes', 'chat'].forEach(function(n) {
                document.getElementById('tab-' + n).classList.toggle('on', n === t);
                document.getElementById('panel-' + n).classList.toggle('on', n === t);
            });
        }

        function sendMsg() {
            var inp = document.getElementById('chat-in');
            var txt = inp.value.trim();
            if (!txt) return;
            var msgs = document.getElementById('chat-msgs');
            var d = document.createElement('div');
            d.className = 'msg mine';
            d.innerHTML = '<span class="msg-who">You</span><div class="bubble">' + txt + '</div>';
            msgs.appendChild(d);
            msgs.scrollTop = msgs.scrollHeight;
            inp.value = '';
        }

        function confirmEnd() {
            if (confirm('End session with Sara Ahmed?')) {
                window.close();
            }
        }
    </script>
</body>

</html>
