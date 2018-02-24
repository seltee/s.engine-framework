<?php
namespace DataLayer\CSV\Functions;


class CheckCSV{
    public function __construct(){
    }

    public function Run(\DataLayer\CSV\Requests\CheckCSV $request){
        $data = $request->getFileData();

        $strings = explode("\n", $data);

        //clear the empty strings
        foreach($strings as $key => $value){
            if (strlen($value) == 0){
                unset($strings[$key]);
            }
        }

        $headers = explode(";", $strings[0]);
        $rows = array();
        $errors = array();

        $variants = array();
        $variantsCollection = array();
        foreach ($headers as $key => $value){
            $variants[$key] = 0;
            $variantsCollection[$key] = array();
        }

        $previewCount = $request->getPreviewCount();

        $table = array_slice ($strings, 1);
        foreach ($table as $key => $value){
            $divided = explode(";", $value);
            if ($key < $previewCount){
                $rows[] = $divided;
            }

            if (count($divided) == count($headers)) {
                foreach ($divided as $key => $value){
                    if (!array_key_exists($value, $variantsCollection[$key])){
                        $variantsCollection[$key][$value] = true;
                        $variants[$key] += 1;
                    }
                }
            }else{
                $errors[] = 'Count of columns mismatched on row '.($key+1);
            }
        }

        $ColumnsCount = count($headers);
        $RowsCount = count($strings) - 1;

        return array(
            'ColumnsCount' => $ColumnsCount,
            'RowsCount' => $RowsCount,
            'PreviewCount' => $previewCount,
            'Headers' => $headers,
            'Rows' => $rows,
            'Variants' => $variants,
            'Errors' => count($errors) ? $errors : null
        );
    }

}