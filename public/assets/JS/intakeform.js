// ─── Swiper init ─────────────────────────────────────────────────────────────
let swiper = new Swiper(".swiper", {
    spaceBetween: 30,
    speed: 1000,
    allowTouchMove: false,
    autoHeight: true,
});

// ─── Collect answers in memory ────────────────────────────────────────────────
// { questionId: optionId }
let answers = {};

// ─── Helpers ─────────────────────────────────────────────────────────────────
let totalQuestions = $(".swiper-slide").length;

function activeSlide() {
    return $(swiper.slides[swiper.activeIndex]);
}

function isLastSlide() {
    return swiper.activeIndex === totalQuestions - 1;
}

function isAnswered(slide) {
    let qId = slide.data("question-id");
    return answers[qId] !== undefined;
}

function updateUI() {
    let slide = activeSlide(),
        current = swiper.activeIndex + 1,
        category = slide.data("category"),
        catIndex = slide.data("category-index"),
        catTotal = slide.data("category-total"),
        progress = (current / totalQuestions) * 100;

    $(".questionCount").text(`Question (${current}/${totalQuestions})`);
    $(".categoryCount").text(`${category} (${catIndex}/${catTotal})`);
    $(".progress").css("width", progress + "%");

    // Restore selected state visually for this slide
    let qId = slide.data("question-id");
    slide.find(".choice").removeClass("selected");
    if (answers[qId]) {
        slide.find(`.choice[data-option-id="${answers[qId]}"]`).addClass("selected");
    }

    // Prev button
    $(".prev").prop("disabled", swiper.activeIndex === 0);

    // Next / Submit button
    let answered = isAnswered(slide);
    $(".next")
        .prop("disabled", !answered)
        .html(
            isLastSlide()
                ? 'Submit <i class="fa-solid fa-check"></i>'
                : 'Next <i class="fa-solid fa-angle-right"></i>'
        );
}

// ─── Choice click ─────────────────────────────────────────────────────────────
$(document).on("click", ".choice", function () {
    let slide = activeSlide(),
        qId = slide.data("question-id"),
        optionId = $(this).data("option-id");

    answers[qId] = optionId;

    slide.find(".choice").removeClass("selected");
    $(this).addClass("selected");

    updateUI();
});

// ─── Navigation ──────────────────────────────────────────────────────────────
$(".prev").on("click", function () {
    swiper.slidePrev();
});

$(".next").on("click", function () {
    if (!isAnswered(activeSlide())) return;

    if (isLastSlide()) {
        submitForm();
    } else {
        swiper.slideNext();
    }
});

swiper.on("slideChange", updateUI);

// ─── Submit ───────────────────────────────────────────────────────────────────
function submitForm() {
    // Build answers array: [{question_id, option_id}, ...]
    let payload = Object.entries(answers).map(([qId, optId]) => ({
        question_id: parseInt(qId),
        option_id: parseInt(optId),
    }));

    $(".next").prop("disabled", true).html(
        '<span class="spinner-border spinner-border-sm me-1"></span> Submitting...'
    );

    $.ajax({
        url: INTAKE_SUBMIT_URL,
        method: "POST",
        contentType: "application/json",
    
        xhrFields: {
            withCredentials: true
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Accept": "application/json",
        },
        data: JSON.stringify({ answers: payload }),
        success: function (res) {
            if (res.success && res.redirect) {
                window.location.href = res.redirect;
            }
        },
        error: function (xhr) {
            let msg = xhr.responseJSON?.message || "Something went wrong. Please try again.";
            alert(msg);
            $(".next").prop("disabled", false).html('Submit <i class="fa-solid fa-check"></i>');
        },
    });
}

// ─── Init ────────────────────────────────────────────────────────────────────
updateUI();
