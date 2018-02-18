<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index() {
      $albums = Album::with('photos')->get();
      return view('albums.index')->with('albums', $albums);
    }

    public function create() {
      return view('albums.create');
    }

    public function store(Request $request) {
      $this->validate($request, [
        'name' => 'required',
        'cover_image' => 'image|max:1999',

      ]);


      $changed = $request->photo->getClientOriginalName();
      $filenameToStore = time() . '_' . $changed;
      $path = $request->file('photo')->storeAs('public/album_covers', $filenameToStore);
      //Create album
      $album = new Album();

      $album->name = $request->input('name');
      $album->description = $request->input('description');
      //$album->name = $request->input('name');
      $album->photo = $filenameToStore;

      $album->save();

      return redirect('/albums')->with('success', 'Album Created');
    }

    public function show($id) {
      $album = Album::with('photos')->find($id);
      return view('albums.show')->with('album', $album);

    }
}
