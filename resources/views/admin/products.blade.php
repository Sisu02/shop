@extends('admin.layout.app')

@section('title', 'Products')

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
                                <h3 class="text-muted text-center mb-3">All Products</h3>
                                <div class="all-btns">
                                    <a type="button" href="\addproducts" class="btn btn-info btn-sm mb-3">Add Products</a>
                                </div>
    
                                <table class="table table-striped bg-light text-center">
                                    <thead>
                                        <tr class="text-muted">
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forEach($allproduct as $product)
                                        <tr>
                                        <td>{{$product->id}}</td>
                                            <td><img src="{{asset('images').'/'.$product->fimage}}" class="product-img"></td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>@if($product->stock == 1)
                                                    <span class="badge bg-success text-white">In Stock</span>
                                                @else
                                                    <span class="badge bg-danger text-white">Out of Stock</span>
                                                @endif</td>
                                            <td>{{$product->category->name}}</td>
                                            <td><a href="/editproduct/{{$product->id}}" class="btn btn-info btn-sm mr-2">Edit</a>
                    <form action="/deleteproduct/{{ $product->id }}" class="d-inline" method="post" onSubmit="if(!confirm('Are you sure?')){return false;}">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- ------ pagination ---------- -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        @if ($allproduct->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $allproduct->previousPageUrl() }}" class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @endif

                                        @for ($i = 1; $i <= $allproduct->lastPage(); $i++)
                                            <li class="page-item {{ ($allproduct->currentPage() == $i) ? 'active' : '' }}">
                                                <a href="{{ $allproduct->url($i) }}" class="page-link py-2 px-3">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($allproduct->hasMorePages())
                                            <li class="page-item">
                                                <a href="{{ $allproduct->nextPageUrl() }}" class="page-link py-2 px-3">&raquo;</a>
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
