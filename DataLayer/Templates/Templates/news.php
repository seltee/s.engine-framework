<?php
$dataLayer = new \DataLayer\DataLayer();
$exception = null;
$fullNews = null;
$pageCount = 1;
$pageLimit = 6;

if (isset($show)){
    try {
        $fullNews = $dataLayer->processRequest("getNews", new \DataLayer\News\Requests\NewsId($news))['data'];
    } catch (\Exception $e) {
        $exception = $e->getMessage();
    }
}else {
    $cPage = $news ? intval($news) : 1;

    try {
        $news = $dataLayer->processRequest("getNewsList", new \DataLayer\News\Requests\GetNewsList($cPage, $pageLimit))['data'];
        $newsCount = $dataLayer->processRequest("getNewsCount", new \Requests\Dummy())['data'];
        $pageCount = intval(floor($newsCount / $pageLimit)) + 1;
    } catch (\Exception $e) {
        $exception = $e->getMessage();
    }
}
?>


<?php if (!$exception): ?>
    <?php if (isset($show)): ?>
        <div class="article-title"><?=$fullNews['Title']?></div>
        <button class="remove-article" article-id="<?=$fullNews['Id']?>">Remove</button>
        <img class="news-image-full" src="<?=$fullNews['BigImageLink']?>"/>
        <div class="article"><?=$fullNews['Body']?></div>
        <div class="date"><?=$fullNews['Created']?></div>
    <?else:?>
        <h2>News List</h2>
        <?php if ($news): ?>
            <?foreach($news as $key => $value):?>
                <a class="news" href="/?news=<?=$value["Id"]?>&show" target="_blank">
                    <img src="<?=$value['PreviewImageLink']?>"/>
                    <div>
                        <div><?=$value['Title']?></div>
                        <div><?=$value['ShortBody']?></div>
                        <div class="date"><?=$value['Created']?></div>
                    </div>
                </a>
            <?endforeach;?>
            <div class="pages">
                <?php
                for ($i = 1; $i <= $pageCount; $i++){
                    if ($i == $cPage){
                        echo '<a class="current">'.$i.'</a>';
                    }else{
                        echo '<a href="/?news='.$i.'">'.$i.'</a>';
                    }
                }
                ?>
            </div>
        <?else:?>
            <p>The news list is empty. Please, add news</p>
        <?endif?>

        <h2>Adding news</h2>
        <p class="add-news">
            Title<br>
            <input class="news-title"/><br>
            Image<br>
            <input type="file" class="news-image"><br>
            Body<br>
            <textarea rows="25" cols="100" class="news-body"></textarea><br>
            <button class="add-news">Add news</button>
        </p>
    <?endif?>


<?else:?>
    <p>
        <a href="/?connection">Error. Please, check connection to the database and users table.</a>
    </p>
    <p>
        Exception: <?=$exception?>
    </p>
<?endif?>

<script>
    $(document).ready(function(){
        $(".add-news button").click(function(){
            function addNews(imageId){
                var title = $(".add-news .news-title").val();
                var body = $(".add-news .news-body").val();

                datapoint.call("addNews", {
                    title: title,
                    body: body,
                    imageId: imageId
                }, function(){
                    location.reload();
                });
            }

            var file = $('.add-news .news-image')[0].files[0];
            if (file) {
                var fileName = file.name;
                var fileExtension = file.type.split('/')[1];

                var reader = new FileReader();

                reader.onload = function () {
                    var fileData = reader.result;
                    datapoint.call("addImage", {
                        imageData: btoa(fileData),
                        imageName: fileName,
                        imageType: fileExtension
                    }, function (data) {
                        addNews(data.imageId);
                    });
                };

                reader.readAsBinaryString(file);
            }else{
                addNews(null);
            }
        });

        $(".remove-article").click(function(a){
            var id = $(a.target).attr("article-id");

            datapoint.call("removeNews", {id: id}, function(){
                location.href = "/?news";
            });
        });
    });
</script>
