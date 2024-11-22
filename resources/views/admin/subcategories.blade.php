  
  @extends('admin.layout.app')
  @section('title', 'Sub subcat');
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
              <h3 class="text-muted text-center mb-3">All Subcategory</h3>
              <div class="all-btns"><a href="/addsubcategory" class="btn btn-info btn-sm mb-3">Add Subcategory</a></div>
              <table class="table table-striped bg-light text-center">
                <thead>
                  <tr class="text-muted">
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Contact</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($subcat as $item)
                  <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td><a href="/editsubcategory/{{$item->id}}" class="btn btn-info btn-sm mr-2">Edit</a>
                    <form action="/deletesubcategory/{{ $item->id }}" class="d-inline" method="post" onSubmit="if(!confirm('Are you sure?')){return false;}">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                  </tr>
                  @endforeach
                </tbody>
              </table>

       <!-- ------ pagination ---------- -->
    
                                    <ul class="pagination justify-content-center">
                                        @if ($subcat->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $subcat->previousPageUrl() }}" class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @endif

                                        @for ($i = 1; $i <= $subcat->lastPage(); $i++)
                                            <li class="page-item {{ ($subcat->currentPage() == $i) ? 'active' : '' }}">
                                                <a href="{{ $subcat->url($i) }}" class="page-link py-2 px-3">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($subcat->hasMorePages())
                                            <li class="page-item">
                                                <a href="{{ $subcat->nextPageUrl() }}" class="page-link py-2 px-3">&raquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link py-2 px-3">&raquo;</a>
                                            </li>
                                        @endif
                                    </ul>
                              
  
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