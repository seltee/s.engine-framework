<?php
$dataLayer = new \DataLayer\DataLayer();

$gallery = null;
$gallerySize = null;
$pageCount = 1;
$pageLimit = 10;
$exception = null;

$cPage = isset($page) ? $page : 1;

try {
    $gallery = $dataLayer->processRequest("getImageList", new \DataLayer\Gallery\Requests\GetImageList($cPage, $pageLimit))['data'];
    $gallerySize = $dataLayer->processRequest("getImageCount", new \Requests\Dummy())['data'];
    $pageCount = intval(floor ( $gallerySize/$pageLimit))+1;
}catch(\Exception $e){
    $exception = $e->getMessage();
}

?>

<?php if (!$exception): ?>
    <h2>Image list</h2>

    <?php if (count($gallery)): ?>
        <div class="image-list">
        <?php
            foreach ($gallery as $key => $value){
                echo '<div>';
                echo '<img src="'.$value['PreviewImageLink'].'" full="'.$value['BigImageLink'].'" />';
                echo '<div remove="'.$value['Id'].'">X</div>';
                echo '</div>';
            }
        ?>
        </div>
        <div class="pages">
            <?php
            for ($i = 1; $i <= $pageCount; $i++){
                if ($i == $cPage){
                    echo '<a class="current">'.$i.'</a>';
                }else{
                    echo '<a href="/?gallery&page='.$i.'">'.$i.'</a>';
                }
            }
            ?>
        </div>
    <?else:?>
        <p>
            The gallery is empty
        </p>
    <?endif?>

    <h2>Add new image</h2>
    <p class="add-image">
        <input class="user-image" type="file" /><br>
        <button class="add-image">Add image</button>
    </p>
<?else:?>
    <p>
        <a href="/?connection">Error. Please, check connection to the database and gallery table.</a>
    </p>
    <p>
        Exception: <?=$exception?>
    </p>
<?endif?>

<div class="image-show"></div>

<script>
    $(document).ready(function(){
        $(".add-image button.add-image").click(function(e){
            var file = $('.add-image .user-image')[0].files[0];
            var fileName = file.name;
            var fileExtension = file.type.split('/')[1];

            var reader = new FileReader();

            reader.onload = function(){
                var fileData = reader.result;

                datapoint.call("addImage", {
                    imageData: btoa(fileData),
                    imageName: fileName,
                    imageType: fileExtension
                }, function(){
                    location.reload();
                });
            };

            reader.readAsBinaryString(file);
        });

        $(".image-list > div").click(function(e){
            var full = $(e.target).attr("full");
            $(".image-show").attr("style", "background-image: url('"+full+"')");
            $(".image-show").fadeIn(500);
        });

        $(".image-show").click(function(){
            $(".image-show").fadeOut(500, function(){
                $(".image-show").hide();
            });
        });

        $(".image-list > div > div").click(function(e){
            var id = $(e.target).attr("remove");

            datapoint.call("removeImage", {
                imageId: id
            }, function(){
                location.reload();
            });

            e.stopPropagation();
        });
    });
</script>
