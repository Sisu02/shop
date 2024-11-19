<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="title icon" href="images/title-img.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"
    integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous">
  </script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <title>Admin Dashboard</title>
</head>

<body>

  <!-- navbar -->
  <nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
      <div class="container-fluid">
        <div class="row">
          <!-- sidebar -->
          <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
            <a href="#"
              class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4 bottom-border">Admin</a>
            <div class="bottom-border pb-3 custom-profile-img">
              <img src="{{asset('admin/images/nophoto.png')}}" width="50" class="rounded-circle mr-3">
              <a href="#" class="text-white">  {{$user->name}}</a>
            </div>
            <ul class="navbar-nav flex-column mt-4">
   <!-- Dashboard Link -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link text-white p-3 mb-2 {{ request()->routeIs('dashboard') ? 'current' : '' }}">
        <i class="fas fa-home text-light fa-lg mr-3"></i> Dashboard
    </a>
</li>

<!-- Categories Link -->
<li class="nav-item">
    <a href="{{ route('categories') }}" class="nav-link text-white p-3 mb-2 sidebar-link {{ request()->routeIs('categories') ? 'current' : '' }}">
        <i class="fas fa-th-large text-light fa-lg mr-3"></i> Categories   <i class="fas fa-chevron-circle-down text-end custom-arrow"></i>
    </a>
 
    <ul class="submenu-custom">
      <li class="nav-item">
    <a href="{{ route('subcategories') }}" class="nav-link text-white p-3 mb-2 sidebar-link {{ request()->routeIs('subcategories') ? 'current' : '' }}">
        <i class="fas fa-th text-light fa-lg mr-3"></i>Sub Categories
    </a>
</li>
</ul>
</li>
              <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i
                    class="fas fa-table text-light fa-lg mr-3"></i>Tables</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i
                    class="fas fa-wrench text-light fa-lg mr-3"></i>Settings</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i
                    class="fas fa-file-alt text-light fa-lg mr-3"></i>Documentation</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i
              class="fas fa-user text-light fa-lg mr-3"></i>Profile</a></li>
            </ul>
          </div>
          <!-- end of sidebar -->

          <!-- top-nav -->
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-dark fixed-top py-2 top-navbar">
            <div class="row align-items-center">
              <div class="col-md-4">
                <h4 class="text-light text-uppercase mb-0">@yield('title')</h4>
              </div>
              <div class="col-md-5">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control search-input" placeholder="Search...">
                    <button type="button" class="btn btn-white search-button"><i
                        class="fas fa-search text-danger"></i></button>
                  </div>
                </form>
              </div>
              <div class="col-md-3">
                <ul class="navbar-nav">
                  <!-- <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i
                        class="fas fa-comments text-muted fa-lg"></i></a></li>
                  <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i
                        class="fas fa-bell text-muted fa-lg"></i></a></li> -->
                  <li class="nav-item ml-md-auto"><a href="/logout" class="nav-link"><i class="fas fa-sign-out-alt text-danger fa-lg"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- end of top-nav -->
        </div>
      </div>
    </div>
  </nav>
  <!-- end of navbar -->
  @yield('content')

  <!-- footer -->
  <footer>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          <div class="row border-top pt-3">
            <div class="col-lg-6 text-center">
              <ul class="list-inline">
                <li class="list-inline-item mr-2">
                  <a href="#" class="text-dark">About</a>
                </li>
                <li class="list-inline-item mr-2">
                  <a href="#" class="text-dark">Support</a>
                </li>
                <li class="list-inline-item mr-2">
                  <a href="#" class="text-dark">Blog</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6 text-center">
              <p>&copy; 
                {{date('Y')}} Copyright. Made With <i class="fas fa-heart text-danger"></i> by <span
                  class="text-success">Developer</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- end of footer -->


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="{{asset('admin/js/script.js')}}"></script>
</body>

</html>