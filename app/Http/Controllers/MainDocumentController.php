<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainDocument;
use App\Models\MainDocumentFiles;
use App\Models\PositionType;
use File;
class MainDocumentController extends Controller
{
    public function index(){
        return MainDocument::all();
    }


    public function show($id){
        return MainDocument::find($id);
    }

    
    public function store(Request $request){
        
        $document = MainDocument::create([
            'name' => $request->name,
            'confirm_date' => $request->confirm_date,
            'description' => $request->description,
        ]);

        $this->createFiles($request->file('files'), $document);
        $this->createPositionTypes($request->positionTypes, $document);
        


        return $document->fresh();
    }


    public function update($id, Request $request){
        $document = MainDocument::find($id);

        $document->name = $request->name;
        $document->confirm_date = $request->confirm_date;
        $document->description = $request->description;
        $document->save();

        $this->updateFiles($request->file('files'), $document);

        $this->updatePositionTypes($request->positionTypes, $document);
        return $document->fresh();
    }









    function createFiles($files, $document){
        foreach ($files as $key => $file) {
            $this->createFile($document,$file, $key);
        }
    }



    function updatePositionTypes($PositionTypes, $document){
        if($PositionTypes == null) { return; }
        $idList = [];
        $news = [];
        foreach ($PositionTypes as $key => $type) {
            $posType = json_decode($type);
            if(isset($posType->id)) {
                $idList[] = $posType->id;
                $positionType = PositionType::find($posType->id);
                $positionType->code = $posType->code;
                $positionType->name = $posType->name;
                $positionType->save();
            }
            else{
                $news[] = $posType;
            }
        }
        
        PositionType::whereNotIn('id', $idList)->delete();

        foreach ($news as $key => $posType) {
            PositionType::create([
                'main_document_id' => $document->id,
                'name' => $posType->name,
                'code' => $posType->code,
            ]);
        }

    }


    function createPositionTypes($PositionTypes, $document){
        if($PositionTypes == null) { return; }

        foreach ($PositionTypes as $key => $types) {
            
            $params = json_decode($types);

            return PositionType::create([
                'main_document_id' => $document->id,
                'name' => $params->name,
                'code' => $params->code,
            ]);

        }
    }


    function updateFiles($files, $document){
        if($files){
            $documentFilesModel = MainDocumentFiles::where('main_document_id', $document->id);
            $documentFiles = $documentFilesModel->get();
            foreach ($documentFiles as $key => $file) {
                $this->deleteFile($file);
            }

            $documentFilesModel->delete();
            $this->createFiles($files, $document);

        }
    }




    function createFile($document, $file, $key){
        $fileName = $document->id.time().$key.'.'.$file->extension();
        $file->move('files', $fileName);
        MainDocumentFiles::create([
            'main_document_id' => $document->id,
            'src' => $fileName,
        ]);
    }

    function deleteFile($file){
        if(File::exists(public_path('/files/'.$file->src))){
            File::delete(public_path('/files/'.$file->src));
        }
    }

}
