<?php
$dataLayer = \DataLayer\DataLayer::getInstance();

$gallery = null;
$gallerySize = null;
$pageCount = null;

$exception = null;

try {
    //get first 5 slides without tag
    //$slides = $dataLayer->processRequest("getSlides", new \DataLayer\Slider\Requests\GetSlides(1, 5))['data'];

    $slides = $dataLayer->processRequest("getSlidesByTag", new \DataLayer\Slider\Requests\GetSlidesByTag("main"))['data'];
}catch(\Exception $e){
    $exception = $e->getMessage();
}

?>

<?php if (!$exception): ?>
    <h2>Slider</h2>

    <?php if (count($slides)): ?>
        <div class="slider">
            <div class="arrow-left go-left">&#8592;</div>
            <div class="arrow-right go-right">&#8594;</div>
            <div class="slides-body">
            <?php
                foreach ($slides as $key => $value){
                    echo '<a style="background-image: url(\''.$value['BigImageLink'].'\')">';
                    echo '<div class="header">'.$value['Header'].'</div>';
                    echo '<div class="body">'.$value['Body'].'</div>';
                    echo '<div class="remove"><button class="remove-slide" slide="'.$value["Id"].'">Remove slide</button></div>';
                    echo '</a>';
                }
            ?>
            </div>
        </div>
    <?else:?>
        <p>
            No slides for slider
        </p>
    <?endif?>

    <h2>Add new slide</h2>
    <p class="add-slide">
        <input class="user-slide" type="file" /><br>
        <button class="add-slide">Add slide</button>
    </p>
<?else:?>
    <p>
        <a href="/?connection">Error. Please, check connection to the database, slides and gallery table.</a>
    </p>
    <p>
        Exception: <?=$exception?>
    </p>
<?endif?>

<div class="image-show"></div>

<script>
    $(document).ready(function(){
        var container = $(".slider");
        var slides = container.find(".slides-body a");
        var count = slides.length;
        var current = 0;
        var block = false;

        container.find('.remove-slide').click(function (a) {
            var id = $(a.target).attr("slide");
            datapoint.call("removeSlide", {Id: id}, function(){
                location.reload();
            });

            a.stopPropagation();
        });

        container.mouseenter(function(){
            block = true;
        });

        container.mouseleave(function(){
            block = false;
        });

        function go(cnt){
            $(slides[current]).stop();
            $(slides[current]).fadeOut(1500);
            current+=cnt;
            if (current >= count) {
                current = 0;
            }
            if (current < 0) {
                current = count - 1;
            }
            $(slides[current]).fadeIn(1500);
        }

        container.find(".go-left").click(function(){
            go(-1);
        });

        container.find(".go-right").click(function(){
            go(1);
        });

        $(slides[0]).show();
        setInterval(function(){
            if (!block) {
                go(1);
            }
        }, 3000);


        $(".add-slide button.add-slide").click(function(e){
            var file = $('.add-slide .user-slide')[0].files[0];
            var fileName = file.name;
            var fileExtension = file.type.split('/')[1];

            var reader = new FileReader();

            reader.onload = function(){
                var fileData = reader.result;

                datapoint.call("addImage", {
                    imageData: btoa(fileData),
                    imageName: fileName,
                    imageType: fileExtension
                }, function(data){
                    datapoint.call("addSlide", {
                        imageId: data.imageId,
                        tag: "main",
                        header: "This Is Your Slide",
                        body: fileName,
                        link: "https://www.google.ru"
                    }, function(data){
                        location.reload();
                    });
                });
            };

            reader.readAsBinaryString(file);
        });

    });
</script>
