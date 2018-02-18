<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;
use App\Album;

class PhotosController extends Controller
{
    public function create($album_id){
      return view('photos.create')->with('album_id', $album_id);

    }

    public function store(Request $request) {
            $this->validate($request, [
              'title' => 'required',
              'photo_photo' => 'image|max:1999',

            ]);


            $changed = $request->photo_photo->getClientOriginalName();
            $filenameToStore = time() . '_' . $changed;
            $path = $request->file('photo_photo')->storeAs('public/photos/' . $request->input('album_id'), $filenameToStore);
            //Upload photo
            $photo = new Photo();
            $photo->album_id = $request->input('album_id');
            $photo->title = $request->input('title');
            $photo->description = $request->input('description');
            $photo->size = $request->file('photo_photo')->getClientSize();
            $photo->photo_photo = $filenameToStore;

            $photo->save();

            return redirect('/albums/'. $request->input('album_id'))->with('success', 'Photo Uploaded');
          }

        public function show($id) {

          $photo = Photo::find($id);
            return view('photos.show')->with('photo', $photo);
          }

       public function destroy($id){
         $photo = Photo::find($id);

         if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo_photo)){
           $photo->delete();
           return redirect('/')->with('success', 'Photo Deleted');
         }
       }
       
    }
