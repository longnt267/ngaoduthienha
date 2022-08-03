<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;
use Storage;

class Album extends Model
{
    use HasFactory;

    const MAX_SIZE = 10000; // 10000 Kb

    protected $fillable = [
        'tour_id',
        'image'
    ];

    protected $allowedFileExtensions;
    protected $errors;
    protected $dataResponse;

    public function __construct()
    {
        $this->allowedFileExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
        $this->errors = array();
        $this->dataResponse = array();
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function validateUpload($file)
    {
        $error = '';
        $nameFile = $file->getClientOriginalName();
        $extensionFile = $file->getClientOriginalExtension();
        $sizeFile = $file->getSize() / 1024; // convert byte to kilobytes
        // check allowedfileExtension array contains extension of file
        $checkExtension = in_array($extensionFile, $this->allowedFileExtensions);
        if(!$checkExtension) {
            $error =  $nameFile." don't supported";
        }
        //check size of file < MAX_SIZE
        if($sizeFile > self::MAX_SIZE) {
            $error =  $nameFile." exceeds the allowed limit 10mb";
        }
        return $error;
    }

    public function saveRecord($file, $id)
    {
        $model = new Album();
        $model->tour_id = $id;
        $image = $file->store('public/upload');
        $model->image = basename($image);
        $model->save();
        return [
            'path' => asset('storage/upload/'.$model->image),
            'name' => $file->getClientOriginalName(),
            'uri' => route('album.destroy', $model->id) // route('album.destroy')
        ];
    }

    public function multiUploadAjax($request, $id)
    {
        if($request->totalFiles > 0) {
            for($x = 0; $x < $request->totalFiles; $x++) {
                $image = $request->file('file'.$x);
                $error = $this->validateUpload($image);
                if(!empty($error)) {
                    array_push($this->errors, $error);
                }
                if(empty($error)) {
                    $file = $this->saveRecord($image, $id);
                    array_push($this->dataResponse, $file);
                }
            }
            $data = [
                'errors' => $this->errors,
                'response' => $this->dataResponse
            ];
            return $data;
        }
    }

    public function deleteByAjax($id)
    {
        $model = $this->findOrFail($id);
        $pathImage = 'public/upload/'.$model->image;
        if($model->delete()) {
            Storage::delete($pathImage);
            return 'Delete successfully';
        }
        return 'Delete failed';
    }
}
