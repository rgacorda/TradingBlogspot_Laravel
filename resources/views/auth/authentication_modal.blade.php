<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form class="mx-1 mx-md-4" action="{{route('login-user')}}" method="POST">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body mx-3">
  
          
            @if (Session::has('success'))
                          <div class="alert alert-success">{{Session::get('success')}}</div>
                      @endif
                      @if (Session::has('fail'))
                          <div class="alert alert-danger">{{Session::get('fail')}}</div>
                      @endif
                      @csrf
  
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="email" name="email" class="form-control" value="{{old('email')}}">
            <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
            <span class="text-danger">@error('email') {{$message}}@enderror</span>
          </div>
  
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" name="password" class="form-control" />
            <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
            <span class="text-danger">@error('password') {{$message}}@enderror</span>
          </div>
  
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-default">Login</button>
        </div>
  
      </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form class="mx-1 mx-md-4" action="{{route('register-user')}}" method="POST">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body mx-3">
  
          
            @if (Session::has('success'))
                          <div class="alert alert-success">{{Session::get('success')}}</div>
                      @endif
                      @if (Session::has('fail'))
                          <div class="alert alert-danger">{{Session::get('fail')}}</div>
                      @endif
                      @csrf
  
          <div class="md-form mb-5">
            <i class="fas fa-bookmark prefix grey-text"></i>
            <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}"/>
              <label class="form-label" for="form3Example1c">First Name</label>
              <span class="text-danger">@error('first_name') {{$message}}@enderror</span>
          </div>
  
          <div class="md-form mb-5">
            <i class="fas fa-bookmark prefix grey-text"></i>
            <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}"/>
              <label class="form-label" for="form3Example1c">Last Name</label>
              <span class="text-danger">@error('last_name') {{$message}}@enderror</span>
          </div>
  
          <div class="md-form mb-5">
            <i class="fas fa-bookmark prefix grey-text"></i>
            <input type="text" name="middle_name" class="form-control" value="{{old('middle_name')}}"/>
              <label class="form-label" for="form3Example1c">Middle Name</label>
              <span class="text-danger">@error('middle_name') {{$message}}@enderror</span>
          </div>
  
          <div class="md-form mb-4">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="email" name="email" class="form-control" value="{{old('email')}}" />
            <label class="form-label" for="form3Example3c">Your Email</label>
            <span class="text-danger">@error('email') {{$message}}@enderror</span>
          </div>
  
          <div class="md-form mb-4">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" name="password" class="form-control" />
            <label class="form-label" for="form3Example4c">Password</label>
            <span class="text-danger">@error('password') {{$message}}@enderror</span>
          </div>
  
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-default">Register</button>
        </div>
  
      </form>
      </div>
    </div>
  </div>