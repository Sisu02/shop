@extends('admin.layout.app')

@section('title', 'Categories')

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
                                <div class="all-btns">
                                    <a type="button" href="/addcategory" class="btn btn-info btn-sm mb-3">Add Category</a>
                                </div>
                                <!-- {{$categories}} -->
                                <table class="table table-striped bg-light text-center">
                                    <thead>
                                        <tr class="text-muted">
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><img src="{{ asset('images/' . $item->image) }}" class="cat-img" alt="category-image"/></td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="/editcategory/{{ $item->id }}" type="button" class="btn btn-info btn-sm mr-2 text-white">Edit</a>
                                                <form action="/deletecategory/{{ $item->id }}" class="d-inline" method="post" onSubmit="if(!confirm('Are you sure?')){return false;}">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <!-- ------ pagination ---------- -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        @if ($categories->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $categories->previousPageUrl() }}" class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @endif

                                        @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                            <li class="page-item {{ ($categories->currentPage() == $i) ? 'active' : '' }}">
                                                <a href="{{ $categories->url($i) }}" class="page-link py-2 px-3">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($categories->hasMorePages())
                                            <li class="page-item">
                                                <a href="{{ $categories->nextPageUrl() }}" class="page-link py-2 px-3">&raquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link py-2 px-3">&raquo;</a>
                                            </li>
                                        @endif
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
