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
                                            <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    </tbody>
                                </table>

                                <!-- ------ pagination ---------- -->
                                <nav>
                                    
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
