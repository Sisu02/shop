  
  @extends('admin.layout.app')
  @section('title', 'Edit Subcategory');
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
              <h3 class="text-muted text-center mb-3">Edit Subcategory</h3>
              @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
              <!-- <div class="all-btns"><button type="button" class="btn btn-info btn-sm mb-3">Add Category</button></div> -->
              @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- {{$subcat}} -->
              <form action="/updatesubcategory/{{$subcat->id}}" method="post" enctype="multipart/form-data">
                @csrf
  <div class="form-group">
    <label for="cname">Subcategory Name:</label>
    <input type="text" name="cname" class="form-control" value="{{$subcat->name}}" id="cname">
  </div>
  <div class="form-group">
    <label for="cdes">Choose Category</label>
    <div>
   <select class="form-control" name="category" aria-label="Default select example">
  <option selected value="">Choose</option>
  @foreach($cat as $item)
  <option value="{{$item->id}}" @if($item->id==$subcat->category_id) selected @endif>{{$item->name}}</option>
  @endforeach
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="cdes">Description:</label>
    <div>
    <textarea name="description" class="form-control" rows="3">{{$subcat->description}}</textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="cimg">Subcategory Image:</label>
    <!-- <input type="file" class="form-control" id="cimg"> -->
     <div class="mt-2" >
     <input type="file" name="cimg" accept="image/*" id="cimg" onchange="loadFile(event)">
     </div>

    <div>
    <img id="output" src="{{asset('/images/'.$subcat->image)}}"/>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
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
  <script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
  @stop