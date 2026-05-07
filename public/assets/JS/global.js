// LoadingPage
$(document).ready(function () {
    setTimeout(function () {
        $(".loadingPage").fadeOut(1000, function () {
            $(this).addClass("d-none");
        });
    }, 1500);
});