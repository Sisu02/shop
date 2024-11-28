    
    @extends('admin.layout.app')
    @section('title', 'Add Coupon');
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
                <h3 class="text-muted text-center mb-3">Add Coupon</h3>
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
                <form action="/addcoupon" method="post" enctype="multipart/form-data">
                  @csrf
    <div class="form-group">
      <label for="cname">Coupon name:</label>
      <input type="text" name="cname" class="form-control" value="{{old('cname')}}" id="cname">
    </div>
    <div class="form-group">
      <label for="cdes">Description:</label>
      <div>
      <textarea name="description" class="form-control" rows="3">{{old('description')}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="coupon_type">Type</label>
      <!-- <input type="file" class="form-control" id="cimg"> -->

    </div>
    <div>
    <label for="coupon_type">Coupon Type:</label>
    <select id="coupon_type" name="coupon_type" class="form-control">
        <option value="">--Select--</option>
        <option value="flat" @if(old('coupon_type')=="flat") selected @endif>Flat</option>
        <option value="percentage" @if(old('coupon_type')=="percentage") selected @endif>Percentage</option>
    </select>
  </div>
    <div id="famount" class="hide form-group">
      <label for="amount">Amount:</label>
      <input type="text" name="famount" class="form-control" value="{{old('famount')}}" id="amount">
    </div>
    <div id="pamount" class="hide form-group">
    <label for="amount">Amount:</label>
    <input type="text" name="pamount" class="form-control" value="{{old('pamount')}}" id="amount" min="0" max="100" >
    </div>
    <div class="form-group">
      <label for="sdate">Start Date:</label>
      <input type="date" name="sdate" class="form-control" value="{{old('sdate')}}" id="sdate">
    </div>
    <div class="form-group">
      <label for="edate">End Date:</label>
      <input type="date" name="edate" class="form-control" value="{{old('edate')}}" id="edate">
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
  // Get the current date in YYYY-MM-DD format
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('edate').setAttribute('min', today);
  document.getElementById('sdate').setAttribute('min', today);
  $(document).ready(function() {
    // Initial value check
    var val = $("#coupon_type").val();
    toggleAmountFields(val);

    // Event listener for dropdown change
    $("#coupon_type").on("change", function() {
        val = $(this).val(); // Update value on change
        toggleAmountFields(val);
    });

    // Function to toggle visibility based on value
    function toggleAmountFields(value) {
        if (value === "flat") {
            $("#famount").removeClass("hide"); // Show flat amount
            $("#pamount").addClass("hide");   // Hide percentage amount
        } else if (value === "percentage") {
            $("#pamount").removeClass("hide"); // Show percentage amount
            $("#famount").addClass("hide");    // Hide flat amount
        } else {
            // Optional: Hide both if the value doesn't match any case
            $("#famount, #pamount").addClass("hide");
        }
    }
});


</script>

    @stop