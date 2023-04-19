<!doctype html>
<html lang="en">

<head>
  <title>Create Trade Share</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
<!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    label.rat, input.rat{
      display: block;
      width: 100%;
    }     
    ul.rat{
      padding: 0;
      margin: 0;
    }
    ul li.rat{
      list-style-type: none;
      display: inline-block;
      margin: 10px;
      color: white;
      text-shadow: 2px 2px 7px grey;
      font-size: 25px !important;
    }
    ul li:hover{
      color: yellow;
    }
    ul li.active, ul li.secondary-active{
      color: yellow;
    }

    input[type="radio"]{
      display: none
    }
 
  </style>


</head>

<body>
  

    <div class="container">
        <header class="blog-header py-3">

          <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
              <h1 class="text-muted">Create Trade Share</h1>
            </div>
            <div class="col-4 text-center">
              <a class="blog-header-logo text-dark" href="{{url('/Home')}}">Home</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">

              {{-- adjust route --}}
              @if (Session::has('loginID'))
              <div class="me-3">
                <a href="{{route('user.edit', Session::get('loginID'))}}" class="text-muted">
                  <i class="fas fa-user-alt"></i>
                </a>
              </div>
              <a class="btn btn-sm btn-outline-secondary" href="/logout">Logout</a>
              @else
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">
                  Sign in
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#registerModal">
                  Sign up
                </button>

              @endif
            </div>
          </div>
        </header>
        <div class="col-12">
          <form method="GET" action="{{ route('search') }}">
              <div class="input-group">
                  <input type="text" name="query" class="form-control" placeholder="Search...">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Search</button>
              </div>
          </form>
      </div>

        <div class="nav-scroller py-1 mb-2">
          <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="{{url('/LongTerm')}}">Long Term</a>
            <a class="p-2 text-muted" href="{{url('/ShortTerm')}}">Short Term</a>
            <a class="p-2 text-muted" href="{{url('/Intraday')}}">Intraday</a>
            <a class="p-2 text-muted" href="{{url('/LongIdeas')}}">Long Ideas</a>
            <a class="p-2 text-muted" href="{{url('/ShortIdeas')}}">Short Ideas</a>
            <a class="p-2 text-muted" href="{{url('/Risk')}}">Risk</a>
            <a class="p-2 text-muted" href="{{url('/Tips')}}">Tips</a>
            <a class="p-2 text-muted" href="{{url('/Psychology')}}">Psychology</a>
            <a class="p-2 text-muted" href="{{url('/Secrets')}}">Secrets</a>
          </nav>
        </div><hr>

        <main>
          @yield('content')
        </main>

        <br><br><br>
        <footer class="bg-light text-center text-lg-start">
          <!-- Grid container -->
          <div class="container p-4">
            <!--Grid row-->
            <div class="row">
              <!--Grid column-->
              <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer text</h5>
        
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                  molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae
                  aliquam voluptatem veniam, est atque cumque eum delectus sint!
                </p>
              </div>
              <!--Grid column-->
        
              <!--Grid column-->
              <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer text</h5>
        
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                  molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae
                  aliquam voluptatem veniam, est atque cumque eum delectus sint!
                </p>
              </div>
              <!--Grid column-->
            </div>
            <!--Grid row-->
          </div>
          <!-- Grid container -->
        
          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
          </div>
          <!-- Copyright -->
        </footer>


  <!-- convering form register and logn into modal -->
  @include('auth.authentication_modal')
  @include('user_func.create_post_modal')





<script>
  $('li').on('click', function(){
    $('li').removeClass('active');
    $('li').removeClass('secondary-active');
    $(this).addClass('active');
    $(this).prevAll().addClass('secondary-active');
  })
</script>

  

  <!-- Bootstrap JavaScript Libraries -->

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
              
</body>
</html>