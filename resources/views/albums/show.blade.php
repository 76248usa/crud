@extends('layouts.app')

@section('content')
  <h1>{{$album->name}}</h1>
  <a class="button secondary" href="/">Go back</a>
  <a class="button" href="/photos/create/{{$album->id}}">Upload Photo to Album</a>
  <hr>

  @if(count($album->photos) > 0)
    <?php
    $colcount = count($album->photos);
    $i = 1;
    ?>
    <div id="albums">
      <div class="row text-center">
        @foreach($album->photos as $photo)
          @if($i == $colcount)
            <div class = 'med-4 comlumns end'
              <a href = "/photos/{{$photo->id}}">
                <img height="240" width="300" class="thumbnail" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo_photo}}"
                alt="{{$photo->title}}">
              </a>
              <h4>{{$photo->title}}</h4>
          @else
            <div class='medium-4 columns'>
              <a href = "/photos/{{$photo->id}}">
                <img height="240" width="300" class="thumbnail" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo_photo}}"
                alt="{{$photo->title}}">
              </a>
              <br>
              <h4>{{$photo->title}}</h4>
          @endif
          @if($i % 3 == 0)
          </div></div><div class="row text-center">
          @else
          </div>
          @endif
          <?php $i++; ?>
        @endforeach
        </div>
      </div>
    @else
      <p>No Photos To Display</p>
    @endif

@endsection
