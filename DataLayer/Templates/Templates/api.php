<?php
$dataLayer = new \DataLayer\DataLayer();

$reference = $dataLayer->getApiReference();
?>

<h1>Api reference</h1>

<div class="description">
    <p>Packages, their methods and request arguments.</p>
    <p>Note, that some arguments like UserInfo will be rewrote by SecurityLayer and specific functions, you have no need to send them in the request</p>
</div>

<?php
if ($reference && count($reference)) {
    foreach ($reference as $key => $value){
        echo '<h2>'.$value['Name'].'</h2>';
        echo '<ul>';

        foreach ($value['Functions'] as $key => $value) {
            echo '<li>';
            echo '<span class="header">'.$value['Name'].'</span>';
            echo '<span class="description">'.$value['Description'].'</span>';
            echo '<ul>';

            foreach ($value['Arguments'] as $argument) {
                echo '<li><span class="method">'.$argument['Name'].'</span> - <span class="type">'.$argument['Type'].'</span></li>';
            }

            echo '</ul>';
            echo '</li>';
        }

        echo '</ul>';
    }
}else{
    echo '<h2 class="red">No functions in the DataLayer. You need to add some to see the reference sheet.</h2>';
}
?>

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





















