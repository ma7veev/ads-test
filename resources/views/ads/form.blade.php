@extends('layouts.app')
@section('content')
   <form method="post" action="{{ route($data['handler']) }}">
      <div class="form-group">
         @csrf
         @if(isset($ad))
            <input type="hidden" value="{{$ad->id}}" name="id">
         @endif
         <label for="title">Title:</label>
         <input type="text"
                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                name="title"
                required
                autofocus
                value="{{(isset($ad))?$ad->title:''}}"/>
         @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('title') }}</strong>
            </span>
         @endif
      </div>
      <div class="form-group">
         <label for="description">Description:</label>
         <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                   name="description"
                   required>{{(isset($ad))?$ad->description:''}}</textarea>
         @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('description') }}</strong>
            </span>
         @endif
      </div>
      <button type="submit" class="btn btn-primary">{{$data['button']}}</button>
   </form>

@endsection