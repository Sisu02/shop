@extends('admin.layout.app')

@section('title', 'Coupons')

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
                                <h3 class="text-muted text-center mb-3">All Coupons</h3>
                                <div class="all-btns">
                                    <a type="button" href="\addcoupons" class="btn btn-info btn-sm mb-3">Add Coupons</a>
                                </div>
  
                                <table class="table table-striped bg-light text-center">
                                    <thead>
                                        <tr class="text-muted">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coupon as $item)
                                    <tr class="text-muted">
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->start_date}}</td>
                                            <td>{{$item->end_date}}</td>
                                            <td><a href="/editcoupon/{{$item->id}}" type="button" class="btn btn-info btn-sm mr-2 text-white">Edit</a>
                                                <form action="/deletecoupon/{{$item->id}}" class="d-inline" method="post" onSubmit="if(!confirm('Are you sure?')){return false;}">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- ------ pagination ---------- -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        @if ($coupon->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $coupon->previousPageUrl() }}" class="page-link py-2 px-3">&laquo;</a>
                                            </li>
                                        @endif

                                        @for ($i = 1; $i <= $coupon->lastPage(); $i++)
                                            <li class="page-item {{ ($coupon->currentPage() == $i) ? 'active' : '' }}">
                                                <a href="{{ $coupon->url($i) }}" class="page-link py-2 px-3">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($coupon->hasMorePages())
                                            <li class="page-item">
                                                <a href="{{ $coupon->nextPageUrl() }}" class="page-link py-2 px-3">&raquo;</a>
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
