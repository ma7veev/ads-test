@extends('layouts.app')
@section('content')
   <form method="post" action="{{ route('create') }}">
      <div class="form-group">
         @csrf
         <label for="title">title:</label>
         <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" required autofocus/>
         @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('title') }}</strong>
            </span>
         @endif
      </div>
      <div class="form-group">
         <label for="description">Description:</label>
         <textarea  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required ></textarea>
         @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('description') }}</strong>
            </span>
         @endif
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
   </form>

@endsection