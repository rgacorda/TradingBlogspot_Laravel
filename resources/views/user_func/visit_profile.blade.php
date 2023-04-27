@extends('master_layout.master_layout')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">

  <form class="form" action="" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">

                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 280px;">
                    @if (empty($userdetails->profile))
                    <figure class="mb-4"><img class="img-fluid rounded" style="width: 280px; height:280px;" src="https://dummyimage.com/280x280ced4da/6c757d.jpg" alt="..."></figure>
                    @else
                    <figure class="mb-4"><img class="img-fluid rounded" style="width: 280px; height:280px;" src="{{asset('/storage/images/profile/'.$userdetails->profile)}}" ></figure>
                    @endif
                </div><hr>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$userdetails->first_name}} {{$userdetails->middle_name}} {{$userdetails->last_name}}</h4>

                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">{{$userdetails->role_desc}}</span>
                    <div class="text-muted"><small>Joined {{$userdetails->created_at}}</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Information</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>First Name</label>
                              <input class="form-control" type="text" name="first_name" value="{{$userdetails->first_name}}" readonly>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input class="form-control" type="text" name="last_name" value="{{$userdetails->last_name}}" readonly>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Middle Name</label>
                              <input class="form-control" type="text" name="middle_name" value="{{$userdetails->middle_name}}" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text" name="email" value="{{$userdetails->email}}" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>About</label>
                              <textarea class="form-control" name="bio" rows="5" readonly>{{$userdetails->bio}}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
</div>


<div class="container">
  <div class="">
    <div class="row">
      <hr>
      <h2 class="col-12">Your Posts</h2>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col" class="col-7">Title</th>
          <th scope="col" class="col-3">Upload Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userposts as $userpost)
        <tr>
          <td class="col-7"><a href="{{route('post.show',$userpost->id)}}">{{$userpost->title}}</a></td>
          <td class="col-3">{{$userpost->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $userposts->links('pagination::bootstrap-5') !!}
  </div>
</div>


@endsection
