
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
    ['notes', 'chat'].forEach(function (n) {
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