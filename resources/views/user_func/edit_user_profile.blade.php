@extends('master_layout.master_layout')
@section('content')
@if (Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">

  <form class="form" action="{{route('user.update',Session::get('loginID'))}}" method="POST" enctype="multipart/form-data">
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
                    </div>
                      <div class="mb-3">
                        <input class="form-control" name='profile' type="file" id="formFile">
                      </div>
                  </div>
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
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>First Name</label>
                              <input class="form-control" type="text" name="first_name" value="{{$userdetails->first_name}}">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input class="form-control" type="text" name="last_name" value="{{$userdetails->last_name}}">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Middle Name</label>
                              <input class="form-control" type="text" name="middle_name" value="{{$userdetails->middle_name}}">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text" name="email" value="{{$userdetails->email}}">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>About</label>
                              <textarea class="form-control" name="bio" rows="5">{{$userdetails->bio}}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" name="password" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-outline-secondary" type="submit">Save Changes</button>
                        <button type="button" name="del-user" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deluserModal" data-userId="{{$userdetails->id}}">Delete</button>
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

@if (Session::get('roleID')==1)
    {{-- Admin: User Panel --}}
    <div class="">
      <div class="container">
        <div class="row">
          <hr>
          <h2 class="col-10">All Accounts</h2>
          <div class="col-2">
              <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createuserModal">Create Account</button>
          </div>
          <hr>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col" class="">Name</th>
              <th scope="col" class="">Email</th>
              <th scope="col" class="">Password</th>
              <th scope="col" class="">Role</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td class="">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</td>
              <td class="">{{$user->email}}</td>
              <td class="">{{$user->password}}</td>
              <td class="">{{$user->role_desc}}</td>
              <td class="">{{$user->id}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <br>
        <div class="">
            <div class="container">
                <div class="row">
                    <hr>
                    <h2 class="col-9">Generate Reports</h2>
                    <form method="GET" action="{{ route('generatePDF') }}" target="_blank" class="col-3">
                        <div class="form-group d-flex">
                            <select class="form-control mr-2" name="month">
                              @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}">{{ date("F", mktime(0, 0, 0, $i, 1)) }}</option>
                              @endfor
                            </select>
                            <button type="submit" class="btn btn-outline-secondary">Generate PDF</button>
                          </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
      </div>
    </div>
<br>

    {{-- Pending Posts --}}
    {{-- Need FIXING --}}
    <div class="container">
      <div class="">
        <div class="row">
          <hr>
          <h2 class="col-10">Pending Approval Posts</h2>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col" class="col-7">Title</th>
              <th scope="col" class="col-3">Upload Date</th>
              <th scope="col" class="col-2">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($approve as $appr)
            <tr>
              <td class="col-7"><a href="{{route('post.show',$appr->id)}}">{{$appr->title}}</a></td>
              <td class="col-3">{{$appr->created_at}}</td>
              <td class="col-2">
                  <button type="button" name="approve" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#approveModal" data-postid="{{$appr->id}}">Accept</button>
                  <button type="button" name="reject" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal" data-postid="{{$appr->id}}">Reject</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>


    <br><br>

    <div class="container">
      <div class="">
        <div class="row">
          <hr>
          <h2 class="col-10">Pending Delete Posts</h2>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col" class="col-7">Title</th>
              <th scope="col" class="col-3">Reason of Delete</th>
              <th scope="col" class="col-3">Upload Date</th>
              <th scope="col" class="col-2">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($deleteP as $delp)
            <tr>
              <td class="col-7"><a href="{{route('post.show',$delp->id)}}">{{$delp->title}}</a></td>
              <th scope="col" class="col-3">{{$delp->DeleteReason}}</th>
              <td class="col-3">{{$delp->created_at}}</td>
              <td class="col-2">
                  <button type="button" name="approvedelete" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#approvedeleteModal" data-postid="{{$delp->id}}">Accept</button>
                  <button type="button" name="rejectdelete" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectdeleteModal" data-postid="{{$delp->id}}">Reject</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>


    <br><br>

@endif
<div class="container">
  <div class="">
    <div class="row">
      <hr>
      <h2 class="col-10">{{$userdetails->first_name}}'s Posts</h2>
      <div class="col-2">
        @if (Session::has('loginID'))
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createpostModal">Create a Thread</button>
        @endif
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col" class="col-7">Title</th>
          <th scope="col" class="col-3">Reason</th>
          <th scope="col" class="col-3">Approve Status</th>
          <th scope="col" class="col-3">Delete Status</th>
          <th scope="col" class="col-2">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userposts as $userpost)
        <tr>
          <td class="col-2"><a href="{{route('post.show',$userpost->id)}}">{{$userpost->title}}</a></td>
          <td class="col-2">{{$userpost->reason}}</td>
          <td class="col-2">{{$userpost->isApproved}}</td>
          <td class="col-2">{{$userpost->isDelete}}</td>
          <td class="col-2">
            @if ($userpost->isApproved !="To be Approved" && $userpost->isDelete !="To be Approved")
            <button type="button" name="edit" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editpostModal" data-postid="{{$userpost->id}}"data-posttitle="{{$userpost->title}}" data-postcontent="{{$userpost->content}}" data-postcat="{{$userpost->cat_id}}">Edit</button>
            <button type="button" name="del" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delpostModal" data-postid="{{$userpost->id}}">Delete</button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $userposts->links('pagination::bootstrap-5') !!}
  </div>
</div>






@include('user_func.action_post_modal')
@include('admin_func.users_modal')
@include('admin_func.approval_modal')
@include('admin_func.delete_modal')

{{-- pass value to modal delete --}}
  <script>
    var deleteButtons = document.querySelectorAll('button[name="del"]');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var postId = this.getAttribute('data-postid');
        document.querySelector('#delpostModal input[name="post_id"]').value = postId;
      });
    });
  </script>

{{-- pass value to modal update --}}
  <script>
    //need fixing category
    var deleteButtons = document.querySelectorAll('button[name="edit"]');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var postId = this.getAttribute('data-postid');
        var postTitle = this.getAttribute('data-posttitle');
        var postContent = this.getAttribute('data-postcontent');
        var postCat = this.getAttribute('data-postcat');
        document.querySelector('#editpostModal input[id="post_id"]').value = postId;
        document.querySelector('#editpostModal input[id="post_title"]').value = postTitle;
        document.querySelector('#editpostModal textarea[id="content"]').value = postContent;
        document.querySelector('#editpostModal input[id="post_cat"]').value = postCat;
      });
    });
  </script>

<script>
  var deleteButtons = document.querySelectorAll('button[name="del-user"]');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var userId = this.getAttribute('data-userId');
      document.querySelector('#deluserModal input[id="user_id"]').value = userId;
    });
  });
</script>

<script>
  var deleteButtons = document.querySelectorAll('button[name="approve"]');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var postId = this.getAttribute('data-postid');
      document.querySelector('#approveModal input[name="post_id"]').value = postId;
    });
  });
</script>

<script>
  var deleteButtons = document.querySelectorAll('button[name="reject"]');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var postId = this.getAttribute('data-postid');
      document.querySelector('#rejectModal input[name="post_id"]').value = postId;
    });
  });
</script>

<script>
  var deleteButtons = document.querySelectorAll('button[name="approvedelete"]');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var postId = this.getAttribute('data-postid');
      document.querySelector('#approvedeleteModal input[name="post_id"]').value = postId;
    });
  });
</script>

<script>
  var deleteButtons = document.querySelectorAll('button[name="rejectdelete"]');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var postId = this.getAttribute('data-postid');
      document.querySelector('#rejectdeleteModal input[name="post_id"]').value = postId;
    });
  });
</script>




@endsection
