function volumeToogle(button) {
    var muted = $('.previewVideo').prop('muted');
    $('.previewVideo').prop('muted', !muted);
    console.log("Siema");

    $(button).find("i").toggleClass('fa-volume-mute');
    $(button).find("i").toggleClass('fa-volume-up');
}

function displayImage() {
    $('.previewVideo').tooggle();
    $('.previewImage').tooggle();
}