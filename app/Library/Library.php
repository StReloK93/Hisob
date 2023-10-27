<?php

namespace App\Library;

use Image;
use File;

class Library
{
    public static function createImage($image , $id){

        $imgName = $id.time().'.jpg';

        $files = Image::make($image)->resize(770, null, function ($constraint) {$constraint->aspectRatio();});
        $files->save('img/'.$imgName);

        return $imgName;
    }

    public static function createImages($images , $id){
        $imageNames = [];

        foreach ($images as $key => $image) {
            $imgName = $id.time().$key.'.jpg';

            $files = Image::make($image)->resize(1024, null, function ($constraint) {$constraint->aspectRatio();});
            $files->save('img/'.$imgName);

            $imageNames[] = $imgName;
        }


        return $imageNames;
    }


    public static function clearImgFile($imageName){
        if(File::exists(public_path('/img/'.$imageName))){
            File::delete(public_path('/img/'.$imageName));
        }
    }

}
