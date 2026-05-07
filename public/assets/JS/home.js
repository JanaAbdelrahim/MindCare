let slides = document.querySelectorAll(".slide"),
  dots = document.querySelectorAll(".indicators button"),
  firstAbout = document.querySelector("#about .first"),
  secondAbout = document.querySelector("#about .second"),
  items = document.querySelectorAll(".faq-item"),
  current = 0,
  interval;
const counters = document.querySelectorAll(".counter");
const section = document.getElementById("counter");


dots.forEach(function (dot) {
  dot.addEventListener("click", function () {
    let index = +(this.dataset.index);
    showSlide(index);
    resetAuto();
  });
});

window.addEventListener("load", () => {
  showSlide(0);
});
interval = setInterval(autoSlide, 6000);

window.addEventListener("scroll", () => {
  let nav = document.querySelector(".navbar");
  if (window.scrollY > 10) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
})
const nav = document.getElementById("mainNav");
const menu = document.getElementById("navMenu");

menu.addEventListener("show.bs.collapse", () => {
  nav.classList.add("scrolled");
});

menu.addEventListener("hide.bs.collapse", () => {
  nav.classList.remove("scrolled");
});
const sections = document.querySelectorAll(".animate"),
  observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
      } else {
        entry.target.classList.remove("show");
      }

    });
  }, {
    threshold: 0.2,
    rootMargin: "0px 0px -100px 0px"
  });

sections.forEach((section) => {
  observer.observe(section);
});
AOS.init();



items.forEach(item => {
  const icon = item.querySelector(".icon");

  icon.addEventListener("click", (e) => {
    e.stopPropagation();
    const isActive = item.classList.contains("active");
    items.forEach(i => i.classList.remove("active"));
    if (!isActive) {
      item.classList.add("active");
    }

  });
});
document.addEventListener("DOMContentLoaded", () => {
  let started = false;
  function startCount() {
    counters.forEach(counter => {
      let target = Number(counter.dataset.target);
      let count = 0;

      let increment = target / 100;

      function update() {
        count += increment;

        if (count < target) {
          counter.innerText = Math.ceil(count);
          requestAnimationFrame(update);
        } else {
          counter.innerText = `${target}+`;
        }
      }

      update();
    });
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {

      if (entry.isIntersecting && !started) {
        startCount();
        started = true;
      }
    });
  }, {
    threshold: 0.2
  });

  observer.observe(section);

});