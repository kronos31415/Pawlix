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

function initialize(id, userName) {
    showHideBackButton();
    setStartTime(id, userName);
    updateProgressTimer(id, userName)
}

function updateProgressTimer(id, userName) {
    addDuration(id, userName);

    var timer = null;

    $('video').on('playing', function(ev) {
        window.clearInterval(timer);
        timer = window.setInterval(function() {
            updateProgress(id, userName, ev.target.currentTime);
        }, 3000);
    }).on('ended', function() {
        setFinished(id, userName);
        window.clearInterval(timer);
    })
}

function addDuration(videoId, userName) {
    $.ajax({
        method: "POST",
        url: "ajax/addDuration.php",
        data: {
            videoId: videoId,
            userName: userName,
        }
    }).done(function(response) {
        if (response !== null && response != '')
            alert(response);
    });
}

function updateProgress(videoId, userName, time) {
    $.ajax({
        method: "POST",
        url: "ajax/updateProgress.php",
        data: {
            videoId: videoId,
            userName: userName,
            time: time,
        }
    }).done(function(response) {
        if (response !== null && response != '')
            alert(response);
    });
}

function setFinished(videoId, userName) {
    $.ajax({
        method: "POST",
        url: "ajax/setFinished.php",
        data: {
            videoId: videoId,
            userName: userName,
        }
    }).done(function(response) {
        if (response !== null && response != '')
            alert(response);
    });
}

function setStartTime(videoId, userName) {
    $.ajax({
        method: "POST",
        url: "ajax/getProgress.php",
        data: {
            videoId: videoId,
            userName: userName,
        }
    }).done(function(response) {
        if (isNaN(response)) {
            return
        }
        console.log(response)

        // var vid = document.getElementsByTagName('video');
        // vid[0].oncanplay = function() {
        //     console.log("tutaj")
        //     this.currentTime = response;
        //     $('video').off('canplay');
        // };
        $("video").on('canplay', function(event) {
            console.log("tutaj")
            this.currentTime = response;
            $('video').off('canplay');
        });
    });
}