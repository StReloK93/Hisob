<?php

namespace App\Http\Controllers;

use App\Models\EmployeImages;
use Illuminate\Http\Request;
use App\Library\Library;


class EmployeImagesController extends Controller
{

    public function index()
    {
        
    }


    public function store(Request $request, $id)
    {

        if($request->images){
            $images = EmployeImages::where('employe_id', $id)->whereNotIn('id', $request->images)->get();

            foreach ($images as $key => $image) {
                Library::clearImgFile($image->src);
            }

            EmployeImages::where('employe_id', $id)->whereNotIn('id', $request->images)->delete();
        }
        else{
            $images = EmployeImages::where('employe_id', $id)->get();
            foreach ($images as $key => $image) {
                Library::clearImgFile($image->src);
            }
            EmployeImages::where('employe_id', $id)->delete();
        }


        if($request->imgs){
            $images = Library::createImages($request->imgs, $request->user()->id);
            foreach ($images as $key => $image) {
                EmployeImages::create([
                    'employe_id' => $id,
                    'src' => $image,
                ]);
            }
        }
        // Images


        return EmployeImages::where('employe_id', $id)->get();
    }

    public function show($id)
    {
        return EmployeImages::where('employe_id', $id)->get();
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
