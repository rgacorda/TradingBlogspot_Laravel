@extends('master_layout.master_layout')
@section('content')
@section('content')
@if (Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif


    <!-- here stays the featured blogs that contains a lot of ratings while rating the highest-->
    <!-- these are only samples for presentation-->

    <?php 
      $hottest = DB::table("comms")
                ->join('posts','comms.post_id', '=', 'posts.id')
                ->select('posts.id','posts.title',DB::raw('left(posts.content,150) as econtent'),'posts.image','posts.user_id', DB::raw('count(comms.post_id) as num_comments'))
                ->orderBy('num_comments','desc')
                ->groupBy('posts.id','posts.title','econtent','posts.image','posts.user_id')
                ->first();

      $rated = DB::table('comms')
          ->select(DB::raw('sum(rating), posts.id, posts.title, posts.image, posts.created_at'),DB::raw('left(posts.content,40) as econtent'))
          ->join('posts','comms.post_id','=','posts.id')
          ->groupBy('posts.id', 'posts.id', 'posts.title', 'econtent', 'posts.image', 'posts.created_at')
          ->orderBy('rating','desc')
          ->limit(1)
          ->first();

      $recent = DB::table('posts')
                ->select('posts.*',DB::raw('left(posts.content,40) as econtent'))
                ->orderBy('created_at','desc')
                ->first();
    ?>

@if (empty($hottest))
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark mb-3">
  <div class="col-md-6 px-0">
    <strong class="d-inline-block mb-2 text-danger">Hottest Post</strong>
    <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>
@else
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark mb-3">
  <div class="col-md-6 px-0">
    <strong class="d-inline-block mb-2 text-danger">Hottest Post</strong>
    <h1 class="display-4 font-italic">{{$hottest->title}}</h1>
    <p class="lead my-3">{{$hottest->econtent}}...</p>
    <p class="lead mb-0"><a href="{{route('post.show',$hottest->id)}}" class="text-white font-weight-bold">Continue reading</a></p>
  </div>
</div>
@endif
@if (empty($rated))
<div class="row mb-2">
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <strong class="d-inline-block mb-2 text-primary">Highest Rated</strong>
        <h3 class="mb-0">
          <a class="text-dark" href="#">Featured post</a>
        </h3>
        <div class="mb-1 text-muted">Nov 12</div>
        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#">Continue reading</a>
      </div>
      <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1867ce1504e%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1867ce1504e%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
    </div>
  </div>
@else
<div class="row mb-2">
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <strong class="d-inline-block mb-2 text-primary">Highest Rated</strong>
        <h3 class="mb-0">
          <a class="text-dark" href="#">{{$rated->title}}</a>
        </h3>
        <div class="mb-1 text-muted">{{$rated->created_at}}</div>
        <p class="card-text mb-auto">{{$rated->econtent}}...</p>
        <a href="{{route('post.show',$rated->id)}}">Continue reading</a>
      </div>
      @if (empty($rated->image))
      <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1867ce1504e%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1867ce1504e%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
      @else
      <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="{{asset('/storage/images/posts/'.$rated->image)}}" data-holder-rendered="true">
      @endif 
    </div>
  </div>
@endif
@if (empty($recent))
<div class="col-md-6">
  <div class="card flex-md-row mb-4 box-shadow h-md-250">
    <div class="card-body d-flex flex-column align-items-start">
      <strong class="d-inline-block mb-2 text-success">Recent</strong>
      <h3 class="mb-0">
        <a class="text-dark" href="#">Post title</a>
      </h3>
      <div class="mb-1 text-muted">Nov 11</div>
      <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
      <a href="#">Continue reading</a>
    </div>
    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1867ce1504f%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1867ce1504f%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 200px; height: 250px;">
  </div>
</div>
</div>
@else
<div class="col-md-6">
  <div class="card flex-md-row mb-4 box-shadow h-md-250">
    <div class="card-body d-flex flex-column align-items-start">
      <strong class="d-inline-block mb-2 text-success">Recent</strong>
      <h3 class="mb-0">
        <a class="text-dark" href="#">{{$recent->title}}</a>
      </h3>
      <div class="mb-1 text-muted">{{$recent->created_at}}</div>
      <p class="card-text mb-auto">{{$recent->econtent}}...</p>
      <a href="{{route('post.show',$recent->id)}}">Continue reading</a>
    </div>
    @if (empty($recent->image))
    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1867ce1504e%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1867ce1504e%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
    @else
    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="{{asset('/storage/images/posts/'.$recent->image)}}" data-holder-rendered="true">
    @endif 
  </div>
</div>
</div>
@endif
  
  
    

  <!-- Will be using for loop to display recent posted blogs (use foreach)-->

  <div class="container">
    <div class="container">
      <div class="row">
        <hr>
        <h2 class="col-10">All Posts</h2>
        <div class="col-2">
          @if (Session::has('loginID'))
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createpostModal">Create a Thread</button>
          @endif
        </div>
        <hr>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col" class="col-8">Title</th>
            <th scope="col" class="col-3">Author</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
            <td class="col-8"><a href="{{route('post.show',$post->id)}}">{{$post->title}}</a></td>
            <td class="col-3"><a href="{{route('user.show',$post->user_id)}}">{{$post->first_name}} {{$post->middle_name}} {{$post->last_name}}</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {!! $posts->links('pagination::bootstrap-5') !!}
    </div>
  </div>


@endsection
