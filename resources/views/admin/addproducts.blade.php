@extends('admin.layout.app')

@section('title', 'Add Products')

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
                                <h3 class="text-muted text-center mb-3">Add New Product</h3>
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="/addproduct" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="custom-form">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter product name">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter product description"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" name="price"  id="price" placeholder="Enter price">
                                        </div>

                                        <div class="form-group">
                                            <!-- {{$cat}} -->
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category_id" name="category">
                                                <!-- Example categories, replace with dynamic categories from your backend -->
                                               @foreach($cat as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subcategory_id">Subcategory</label>
                                            <select class="form-control" name="subcategory" id="subcategory_id">
                                                <!-- Example categories, replace with dynamic categories from your backend -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="gallery_images">Feature Image</label>
                                            <input type="file" class="form-control-file" id="f_image" name="f_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="gallery_images">Gallery Images</label>
                                            <input type="file" class="form-control-file" id="gallery_images" name="gallery_images[]" multiple>
                                        </div>

                                        <div id="preview" class="d-flex flex-wrap"></div>

                                        <button type="submit" class="btn btn-primary">Add Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </section> 
       <!-- -- end of tables -- -->
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');
document.getElementById('gallery_images').addEventListener('change', function(event) {
    let files = Array.from(event.target.files);
    const preview = document.getElementById('preview');
    preview.innerHTML = ''; // Clear any existing previews

    function updateFiles() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        document.getElementById('gallery_images').files = dataTransfer.files;
    }

    function renderPreview() {
        preview.innerHTML = ''; // Clear previews
        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('preview-img');
                imgContainer.innerHTML = `
                    <img src="${e.target.result}" alt="Image ${index + 1}">
                    <button type="button" class="remove-btn" data-index="${index}">&times;</button>
                `;
                preview.appendChild(imgContainer);

                imgContainer.querySelector('.remove-btn').addEventListener('click', function() {
                    files.splice(index, 1); // Remove the file from the array
                    renderPreview(); // Re-render the preview
                    updateFiles(); // Update the input field with remaining files
                });
            };
            reader.readAsDataURL(file);
        });
    }

    renderPreview();
    updateFiles();
});
categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>'; // Clear subcategories

        if (categoryId) {
            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.subcategories.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.text = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching subcategories', error);
                });
        }

});
</script>
@endsection
