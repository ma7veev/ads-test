@foreach($ads as $ad)
   <div class="card w-100">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h5 class="card-title">{{$ad->title}}</h5>
            <small>{{$ad->author_name}}</small>
         </div>
         <p class="card-text">{{$ad->description}}</p>
         <a href="#" class="btn btn-primary">Edit</a>
      </div>
   </div>
@endforeach