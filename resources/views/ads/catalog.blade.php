@foreach($ads as $ad)
   <div class="card w-100 mt-3">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <div class="card-title">
               <a href="{{route('view', ['id' => $ad->id])}}"
                  class="font-weight-bold">{{$ad->title}}</a>
            </div>
            <small class="font-weight-bold">{{$ad->author_name}}</small>
         </div>
         <p class="card-text">{{$ad->description}}</p>
         @if(Auth::check())
            @if(Auth::user()->id ===$ad->user_id)
               <a href="{{route('delete', ['id' => $ad->id])}}"
                  class="btn btn-primary">Delete
               </a>
               <a href="{{route('edit', ['id' => $ad->id])}}"
                  class="btn btn-secondary ml-3">Edit
               </a>
            @endif
         @endif
      </div>
   </div>
@endforeach
<div class="">{{ $ads->links() }}</div>