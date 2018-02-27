<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?=$title?></title>
        <meta description content="Simple Engine Framework">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1230, maximum-scale=1, user-scalable=yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="HandheldFriendly" content="true">
        <link rel="icon" href="/media/imgs/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/media/imgs/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="./media/imgs/apple-touch-icon-precomposed.png">

        <link rel="stylesheet" href="/media/css/all.css">
        <link rel="stylesheet" href="/media/css/base.css">

        <?php
            if (mediaExist("/media/css/page/$action.css")){
                echo '<link rel="stylesheet" href="/media/css/page/'.$action.'.css">';
            }
        ?>

        <script type="text/javascript" src="/media/js/jquery.js"></script>
        <script type="text/javascript" src="/media/js/datapoint.js"></script>
        <script type="text/javascript" src="/media/js/datapoint.js"></script>

    </head>
    <body>
        <div class="main-loader"></div>
        <header>
            Simple Engine
            <h1>framework</h1>
        </header>

        <main>
            <?=($action == "main" ? "" : "<a class=\"main-link\" href=\"/\"><< Title page</a>")?>
            <?=$content?>
        </main>

        <footer>
            <a href="https://www.linkedin.com/in/dmitry-shashkov-0b8274121/" target="_blank">(C)Dmitry Shashkov</a>
        </footer>

        <div class="modal error" id="error">
            <div>
                <h1>Error!</h1>
                <div></div>
            </div>
        </div>
    </body>

    <script>
        $(document).ready(function(){
            $("#error").click(function(){
                $("#error").fadeOut(500, function(){
                    $("#error").hide();
                })
            });

            datapoint.setDefaultErrorCallback(function(message){
                $("#error > div > div").html(message);
                $("#error").fadeIn(500);
            });

            datapoint.setLoaderCallback(function(state){
                if (state){
                    $(".main-loader").stop().fadeIn(500);
                } else{
                    $(".main-loader").stop().fadeOut(500);
                }
            });
        });
    </script>
</html>
























