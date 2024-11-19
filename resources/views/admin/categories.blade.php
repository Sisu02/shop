  
  @extends('admin.layout.app')
  @section('title', 'Categories');
  @section('content')
  <!-- cards -->
  <section>
    <div class="container-fluid my-5">
       <!-- tables -->
 <section>
    <div class="container-fluid">
      <div class="row mb-5">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          <div class="row align-items-center">
            <div class="col-xl-12 col-12 bm-4 mb-xl-0">
              <h3 class="text-muted text-center mb-3">All Categories</h3>
              <div class="all-btns"><a type="button" href="/addcategory" class="btn btn-info btn-sm mb-3">Add Category</a></div>
              <!-- {{$categories}} -->
              <table class="table table-striped bg-light text-center">
                <thead>
                  <tr class="text-muted">
                    <th>#</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Contact</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $item)   
                  <tr>
                    <th>{{$item->id}}</th>
                    <td>John</td>
                    <td>0</td>
                    <td><button type="button" class="btn btn-info btn-sm mr-2">Edit</button><button type="button" class="btn btn-danger btn-sm">Delete</button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

       <!-- ------ pagination ---------- -->
              <nav>
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a href="#" class="page-link py-2 px-3">
                      <span>&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a href="#" class="page-link py-2 px-3">
                      1
                    </a>
                  </li>
                  <li class="page-item">
                    <a href="#" class="page-link py-2 px-3">
                      2
                    </a>
                  </li>
                  <li class="page-item">
                    <a href="#" class="page-link py-2 px-3">
                      3
                    </a>
                  </li>
                  <li class="page-item">
                    <a href="#" class="page-link py-2 px-3">
                      <span>&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
              <!-- -- end of pagination -- -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- -- end of tables -- -->
    </div>
  </section>
  @stop