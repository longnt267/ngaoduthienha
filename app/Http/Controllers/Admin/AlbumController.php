<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index($id)
    {
        $album = Album::select('*')->where('tour_id', $id)->get();
        return view('admin.tour.album', compact('id', 'album'));
    }

    // public function uploadToAlbum(AlbumRequest $request, Album $album, $id) 
    // {
    //     $errors = $album->multiUploadAjax($request, $id);
    //     if(count($errors) > 0) {
    //         return redirect()->route('album.index', $id)->with('errors', $errors);
    //     }
    //     return redirect()->route('album.index', $id)->with('message', 'Upload successfully');
    // }

    public function uploadToAlbum(Request $request, Album $album, $id) 
    {
        return $album->multiUploadAjax($request, $id);
    }

    public function destroy(Album $album, $id)
    {
        return $album->deleteByAjax($id);
    }
}
