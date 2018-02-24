<h2>CSV Loader</h2>
<input class="csv-file" type="file" accept=".csv*" /><br>
<button class="csv-check">Check File</button>

<div class="add-csv-to-db">
    <h2>Add csv data to Data Base</h2>
    <button class="show-fields">Show Fields</button>
    <div class="fields"></div>
</div>

<h2>CSV Data</h2>

<div class="parsed-data not-loaded">
    Please, load some file
</div>

<script>
    $(document).ready(function(){
        var fileData = null;

        function uploadToDatabase(tableName, data){

            if (fileData && data){
                datapoint.call("loadCSVToDataBase", {
                    fileData: fileData,
                    tableName: tableName,
                    columns: data
                }, function(data){
                    console.log(data);
                });
            }
        }

        function updateFields(data){
            var out = '<ul>';

            out += '<li><span>Table Name*</span><input key="table-name"/></li>';

            $.each(data.Headers, function(i, o){
                out += '<li><span>'+o+'</span><input key="'+i+'"/></li>';
            });

            out += '</ul>';
            out += '<button>Upload to Data Base</button>';

            $('.add-csv-to-db .fields').html(out);
            $('.add-csv-to-db .fields button').unbind("click").click(function(){
                var out = {};
                var tableName = null;
                $.each($('.add-csv-to-db .fields input'), function(i, o){
                    if ($(o).val() && $(o).val().length > 0) {
                        if ($(o).attr("key") == "table-name"){
                            tableName = $(o).val();
                        }else {
                            out[$(o).attr("key")] = $(o).val();
                        }
                    }
                });
                uploadToDatabase(tableName, out);
            });
        };

        function showResult(data){
            var out = '<ul>';
            out += '<li><span>Columns count:</span><span>' + data.ColumnsCount + '</span></li>';
            out += '<li><span>Rows count:</span><span>' + data.RowsCount + '</span></li>';
            out += '<li><span>Errors:</span><span>' + (data.Errors ? data.Errors.join(', ') : "no errors") + '</span></li>';
            out += '</ul>';

            out += '<h2>Variants table</h2>';

            out += '<table><thead><tr class="headers">';

            $.each(data.Headers, function(i, o){
                out += '<td>' + o + '</td>'
            });

            out += '</tr></thead>';

            out += '<tbody><tr>';

            $.each(data.Variants, function(i, o){
                out += '<td>' + o + '</td>';
            });

            out += '</tr></tbody></table>';

            out += '<h2>Preview data table ('+data.PreviewCount+')</h2>';

            out += '<table><thead><tr class="headers">';

            out += '<td class="count">№</td>';

            $.each(data.Headers, function(i, o){
                out += '<td>' + o + '</td>'
            });

            out += '</tr></thead>';

            out += '<tbody>';

            $.each(data.Rows, function(i, o){
                out += '<tr><td class="count">' + (i + 1) + '</td>';

                $.each(o, function(i, o){
                    out += '<td>' + o + '</td>';
                });

                out += '</tr>';
            });

            out += '</tbody>';

            out += '</table>';

            $('.parsed-data').html(out);
            $('.parsed-data').removeClass("not-loaded");
        };


        $("button.csv-check").click(function(e){
            var file = $('.csv-file')[0].files[0];
            var reader = new FileReader();

            reader.onload = function(){
                fileData = reader.result;
                console.log(fileData);
                datapoint.call("checkCSV", {
                    fileData: fileData
                }, function(data){
                    $(".add-csv-to-db").show();
                    updateFields(data);
                    showResult(data);
                });
            };

            reader.readAsText(file);
        });

        $(".add-csv-to-db .show-fields").click(function(){
            $(".add-csv-to-db .fields").fadeIn(500);
            $(".add-csv-to-db .show-fields").hide();
        });

        $("button.csv-load").click(function(e){

        });
    });
</script>
