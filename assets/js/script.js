function volumeToogle(button) {
    var muted = $('.previewVideo').prop('muted');
    $('.previewVideo').prop('muted', !muted);
    console.log("Siema");

    $(button).find("i").toggleClass('fa-volume-mute');
    $(button).find("i").toggleClass('fa-volume-up');
}

function displayImage() {
    $('.previewVideo').toggle();
    $('.previewImage').toggle();
}

function goToPreviousPage() {
    window.history.back();
}

function showHideBackButton() {
    var timeout = null;

    $(document).on('mousemove', function() {
        clearTimeout(timeout);
        $('.watchNav').fadeIn();

        timeout = setTimeout(function() {
            $('.watchNav').fadeOut();
        }, 3000)
    });
}

function initialize() {
    showHideBackButton();
}