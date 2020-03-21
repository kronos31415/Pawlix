<?php
    require_once("includes/header.php");
?>

<div class='textContainer'>
    <input type = 'text' class='searchInput' placeholder="Search">
</div>

<div class='searchResult'>

</div>

<script>
    var user = "<?php echo $userLoggedIn; ?>";

    var timer;

    $('.searchInput').keyup(function(event) {
        clearTimeout(timer);

        timer = setTimeout(function() {
            var imie = $('.searchInput').val();
            console.log(imie);
        }, 1000);
    })
</script>