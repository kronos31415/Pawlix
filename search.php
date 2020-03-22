<?php
    require_once("includes/header.php");
    require_once("includes/classes/PreviewProvider.php");
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
            var search = $('.searchInput').val();
            if(search != '') {
                $.ajax({
                    method: "POST",
                    url: "ajax/getSearchResult.php",
                    data: {
                        search: search,
                        user: user
                    }
                }).done(function(response) {
                    if (response !== null && response != '')
                    $('.searchResult').html(response);
                });
            } else {
                $('.searchResult').html(ErorM);
            }
        }, 1000);
    })
</script>