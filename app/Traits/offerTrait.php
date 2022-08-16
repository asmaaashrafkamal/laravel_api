<?php

namespace App\Traits;

Trait offerTrait
{
    public function saveImage($photo,$path){
        $file_extention=$photo ->getClientOriginalExtension();
        $file_name=time().'.'.$file_extention;
        $photo ->move($path,$file_name);
        return $file_name;
     }

}
