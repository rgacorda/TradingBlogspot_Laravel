@extends('master_layout.master_layout')
@section('content')
<div class="container">
    <!-- Post content-->
    <article>
        <!-- Post header-->
        <header class="mb-4">
            <!-- Post title-->
            <h1 class="fw-bolder mb-1">{{$showpost->title}}</h1>
            <!-- Post meta content-->
            <div class="text-muted fst-italic mb-2">Posted on {{$showpost->created_at}} by {{$author->first_name}} {{$author->middle_name}} {{$author->last_name}}</div>
            <!-- Post categories-->
            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{$category->cat_desc}}</a>
        </header>
        <!-- Preview image figure-->
        @if (empty($showpost->image)) 
        <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..."></figure>
        @else
        <figure class="mb-4"><img class="img-fluid rounded" style="width: 900px; height:400px;" src="{{asset('/storage/images/posts/'.$showpost->image)}}" ></figure>
        @endif

        
        <!-- Post content-->
        <section class="mb-5">
            <p class="fs-5 mb-4">{{$showpost->content}}</p>
        </section>
    </article>
    <!-- Comments section-->
    <section class="mb-5">
        <div class="card bg-light">
            <div class="card-body">
                <!-- Comment form-->
                @if (Session::has('loginID'))
                <form class="mb-4" method="POST" action="{{route('comment.store')}}" >
                  @csrf
                  <input hidden name="post_id" value="{{$showpost->id}}">
                  <textarea class="form-control" rows="3" name="content" placeholder="Join the discussion and leave a comment!"></textarea><br>
                  {{-- Star Rating --}}
                  <ul class="rat">
                    <li class="rat"><label class="rat" for="rating_1"><i class="fa fa-star" aria-hidden="true"></i></label><input class="rat" type="radio" name="ratings" id="rating_1" value="1"></li>
                    <li class="rat"><label class="rat" for="rating_2"><i class="fa fa-star" aria-hidden="true"></i></label><input class="rat" type="radio" name="ratings" id="rating_2" value="2"></li>
                    <li class="rat"><label class="rat" for="rating_3"><i class="fa fa-star" aria-hidden="true"></i></label><input class="rat" type="radio" name="ratings" id="rating_3" value="3"></li>
                    <li class="rat"><label class="rat" for="rating_4"><i class="fa fa-star" aria-hidden="true"></i></label><input class="rat" type="radio" name="ratings" id="rating_4" value="4"></li>
                    <li class="rat"><label class="rat" for="rating_5"><i class="fa fa-star" aria-hidden="true"></i></label><input class="rat" type="radio" name="ratings" id="rating_5" value="5"></li>
                  </ul>
                  <br>
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Post</button>
                  <span class="text-danger">@error('content') {{$message}}@enderror</span>


              </form>
                @endif
                
                <hr>

                @foreach ($comments as $comm)
                <!-- Single comment-->
                <div class="d-flex">
                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..."></div>
                    <div class="ms-3">
                        <div class="fw-bold">{{$comm->first_name}} {{$comm->middle_name}} {{$comm->last_name}}</div>
                        <div class="">
                            @for ($i = 1; $i <= $comm->rating; $i++)
                              <i class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                        </div>
                        {{$comm->content}}
                    </div>
                </div>
                @if (Session::get('loginID')==$comm->user_id)
                <div class="card text-end pe-5">
                    <a class="link-dark" name="editcomm" data-bs-toggle="modal" data-bs-target="#editcomModal" data-commid="{{$comm->id}}" data-commcontent="{{$comm->content}}">Edit</a>
                    <a class="link-dark" name="delcomm" data-bs-toggle="modal" data-bs-target="#delcomModal" data-commid="{{$comm->id}}">Delete</a>
                </div>
                @endif
                <br>
                @endforeach
            </div>
        </div>
    </section>
</div>

@include('user_func.comms_modal')

<script>
    var deleteButtons = document.querySelectorAll('a[name="editcomm"]');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var commId = this.getAttribute('data-commid');
        var commcontent = this.getAttribute('data-commcontent');
        document.querySelector('#editcomModal input[id="comm_id"]').value = commId;
        document.querySelector('#editcomModal textarea[id="comm_content"]').value = commcontent;
      });
    });
  </script>


<script>
    var deleteButtons = document.querySelectorAll('a[name="delcomm"]');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var commId = this.getAttribute('data-commid');
        document.querySelector('#delcomModal input[id="comm_id"]').value = commId;
      });
    });
  </script>

  

@endsection