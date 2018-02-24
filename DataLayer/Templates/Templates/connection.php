<?php
$dataLayer = new \DataLayer\DataLayer();

$result = $dataLayer->processRequest("getConnectionInfo", new \Requests\Dummy())['data'];

$dbTables = $result['DBTables'];
?>

<h1>Data Base information</h1>

<?php if ($result['DBError']): ?>
    <h2 class="red">Data Base connection error. Check init.php in the root folder to fix this problem</h2>
    <p>
        <?=$result['DBError']?>
    </p>
<?php else: ?>
    <h2>Data Base tables has been found:</h2>

    <?php if(count($dbTables)): ?>
    <ul>
        <?php
        foreach ($dbTables as $value){
            echo '<li>'.$value.'</li>';
        }
        ?>
    </ul>
    <?else:?>
        <p class="red">
            No tables in Data Base
        </p>
    <?endif?>

    <h2>Necessary:</h2>
    <ul>
        <?php
        if (in_array('users', $dbTables)){
            echo '<li class="green">Users table exists</li>';
        }else{
            echo '<li>Users table does not exists <a table="users" class="add-table">Create</a></li>';
        }

        if (in_array('gallery', $dbTables)){
            echo '<li class="green">Gallery table exists</li>';
        }else{
            echo '<li>Gallery table does not exists <a table="gallery" class="add-table">Create</a></li>';
        }

        if (in_array('slides', $dbTables)){
            echo '<li class="green">Slides table exists</li>';
        }else{
            echo '<li>Slides table does not exists <a table="slides" class="add-table">Create</a></li>';
        }

        if (in_array('news', $dbTables)){
            echo '<li class="green">News table exists</li>';
        }else{
            echo '<li>News table does not exists <a table="news" class="add-table">Create</a></li>';
        }
        ?>
    </ul>
<?php endif ?>

<script>
    $(document).ready(function(){
        $(".add-table").click(function(e){
            var table = $(e.target).attr("table");

            datapoint.call("addBasicTable", {
                identifier: table
            }, function(data){
                location.reload();
            })
        });
    });
</script>





















