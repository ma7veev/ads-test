@foreach($ads as $ad)
   <div class="card w-100 mt-3">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h5 class="card-title">{{$ad->title}}</h5>
            <small>{{$ad->author_name}}</small>
         </div>
         <p class="card-text">{{$ad->description}}</p>
         @if(Auth::user()->id ===$ad->user_id)
            <a href="{{route('delete', ['id' => $ad->id])}}" class="btn btn-primary">Delete</a>
         @endif
      </div>
   </div>
@endforeach
<div class="">{{ $ads->links() }}</div>