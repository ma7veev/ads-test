@extends('layouts.app')

@section('content')
   
   
   
   <div class="container">
      @if(Auth::check())
         <div class="alert alert-success " role="alert">
            <p>Hello, {{Auth::user()->username}}! You are logged in!
               <a class="btn btn-warning ml-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
               </a>
               <a href="{{ route('create') }}" class="btn btn-success ml-3">Create Ad</a>
            </p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
         </div>
      @else
         @component('auth.login')
         
         @endcomponent
      @endif
   </div>
   @if(Auth::check())
      @component('ads.catalog', compact('ads'))
   
      @endcomponent
   @endif

@endsection