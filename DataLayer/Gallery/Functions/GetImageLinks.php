<?php
namespace DataLayer\Gallery\Functions;

class GetImageLinks{
    public function __construct(){
    }

    public function Run(\DataLayer\Gallery\Requests\GetImageLinks $request){
        $name = $request->getName();
        return array(
            "FullImageLink" => GALLERY_LINK.'/full/'.$name,
            "BigImageLink" => GALLERY_LINK.'/big/'.$name,
            "MediumImageLink" => GALLERY_LINK.'/medium/'.$name,
            "PreviewImageLink" => GALLERY_LINK.'/preview/'.$name,
        );
    }
}