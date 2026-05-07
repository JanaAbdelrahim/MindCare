const MOCK_DATA = {
  therapistId: "th_001",
  name: "Dr. Nour Gamal",
  specialty: "Clinical Psychologist · Cognitive Behavioral Therapy",
  price: 450,
  currency: "EGP",
  avatarInitials: "NG",
  allSlots: [
    "Sun 10:00 AM", "Sun 12:00 PM", "Sun 3:00 PM",
    "Mon 9:00 AM", "Mon 11:00 AM", "Mon 2:00 PM", "Mon 5:00 PM",
    "Tue 10:00 AM", "Tue 1:00 PM",
    "Wed 9:00 AM", "Wed 11:00 AM", "Wed 4:00 PM",
    "Thu 10:00 AM", "Thu 3:00 PM",
  ],
  availableSlots: [
    "Mon 9:00 AM", "Mon 2:00 PM", "Wed 11:00 AM",
    "Wed 4:00 PM", "Thu 5:00 PM", "Sun 3:00 PM"
  ]
};

let selectedSlot = null;

function initPage(data) {
  document.getElementById('doc-avatar').textContent = data.avatarInitials;
  document.getElementById('doc-name').textContent = data.name;
  document.getElementById('doc-specialty').textContent = data.specialty;
  document.getElementById('doc-price').textContent =
    `Session price: ${data.price} ${data.currency}`;

  document.getElementById('sel-price').textContent =
    `${data.price} ${data.currency}`;

  const allGrid = document.getElementById('all-slots');
  allGrid.innerHTML = "";
  data.allSlots.forEach(s => {
    const d = document.createElement('div');
    d.className = 'slot static';
    d.textContent = s;
    allGrid.appendChild(d);
  });

  const availGrid = document.getElementById('avail-slots');
  availGrid.innerHTML = "";
  data.availableSlots.forEach(s => {
    const d = document.createElement('div');
    d.className = 'slot available';
    d.textContent = s;
    d.onclick = () => selectSlot(d, s);
    availGrid.appendChild(d);
  });
}

function selectSlot(el, slot) {
  document.querySelectorAll('#avail-slots .slot').forEach(e => {
    e.className = 'slot available';
  });

  el.className = 'slot selected';
  selectedSlot = slot;

  document.getElementById('sel-label').textContent = slot;
  document.getElementById('selected-info').style.display = 'flex';

  const btn = document.getElementById('proceed-btn');
  btn.disabled = false;
  btn.textContent = 'Proceed to payment →';
}

document.getElementById('proceed-btn').addEventListener('click', () => {
  if (!selectedSlot) return;

  window.location.href = "payment.html";
});

initPage(MOCK_DATA);



// let selectedSlot = null;

// async function fetchTherapistData() {
//   const therapistId = new URLSearchParams(window.location.search).get('id');

//   const res = await fetch(`/api/therapists/${therapistId}`);
//   const data = await res.json();

//   const availRes = await fetch(`/api/therapists/${therapistId}/availability`);
//   const availData = await availRes.json();

//   data.availableSlots = availData.availableSlots;

//   initPage(data);
// }

// function initPage(data) {
//   document.getElementById('doc-avatar').textContent = data.avatarInitials;
//   document.getElementById('doc-name').textContent = data.name;
//   document.getElementById('doc-specialty').textContent = data.specialty;
//   document.getElementById('doc-price').textContent =
//     `Session price: ${data.price} ${data.currency}`;

//   document.getElementById('sel-price').textContent =
//     `${data.price} ${data.currency}`;

//   const allGrid = document.getElementById('all-slots');
//   allGrid.innerHTML = "";
//   data.allSlots.forEach(s => {
//     const d = document.createElement('div');
//     d.className = 'slot static';
//     d.textContent = s;
//     allGrid.appendChild(d);
//   });

//   const availGrid = document.getElementById('avail-slots');
//   availGrid.innerHTML = "";
//   data.availableSlots.forEach(s => {
//     const d = document.createElement('div');
//     d.className = 'slot available';
//     d.textContent = s;
//     d.onclick = () => selectSlot(d, s);
//     availGrid.appendChild(d);
//   });
// }

// function selectSlot(el, slot) {
//   document.querySelectorAll('#avail-slots .slot').forEach(e => {
//     e.className = 'slot available';
//   });

//   el.className = 'slot selected';
//   selectedSlot = slot;

//   document.getElementById('sel-label').textContent = slot;
//   document.getElementById('selected-info').style.display = 'flex';

//   const btn = document.getElementById('proceed-btn');
//   btn.disabled = false;
//   btn.textContent = 'Proceed to payment →';
// }

// document.getElementById('proceed-btn').addEventListener('click', () => {
//   if (!selectedSlot) return;

//   window.location.href = `payment.html?slot=${encodeURIComponent(selectedSlot)}`;
// });

// fetchTherapistData();