 @extends('backend.master')
 @section('content')
     <div class="app-content-header">
         <!--begin::Container-->
         <div class="container-fluid">
             <!--begin::Row-->
             <div class="row">
                 <div class="col-sm-6">
                     <h3 class="mb-0">Add New Product</h3>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-end">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                     </ol>
                 </div>
             </div>
             <!--end::Row-->
         </div>
         <!--end::Container-->
     </div>
     <!--end::App Content Header-->
     <!--begin::App Content-->
     <div class="app-content">
         <!--begin::Container-->
         <div class="container-fluid">
             <!--begin::Row-->
             <div class="row g-4">
                 <!--begin::Col-->

                 <!--end::Col-->
                 <!--begin::Col-->
                 <div class="col-md-12">
                     <!--begin::Quick Example-->
                     <div class="card card-primary card-outline mb-4">
                         <!--begin::Header-->
                         <div class="card-header">
                             <div class="card-title">Input Product</div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Form-->
                         <form action="{{ url('/admin/product/store') }}" method="POST" enctype="multipart/form-data">
                             @csrf
                             <!--begin::Body-->
                             <div class="card-body">
                                 <div class="row">

                                     <div class="col-6 mb-3">
                                         <label for="name" class="form-label">Product Name*</label>
                                         <input type="text" class="form-control" name="name" id="name"
                                             required />
                                     </div>

                                     <div class="col-6 mb-3">
                                         <label for="sku_code" class="form-label">Product Code*</label>
                                         <input type="text" class="form-control" name="sku_code" id="sku_code"
                                             required />
                                     </div>
                                     <div class="col-6 mb-3">
                                         <label for="cat_id" class="form-label">Select Category</label>
                                         <select class="form-control" name="cat_id">
                                             <option selected disabled>Category Category*</option>

                                             @foreach ($categories as $category)
                                                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                     <div class="col-6 mb-3">
                                         <label for="sub_cat_id" class="form-label">Select SubCategory</label>
                                         <select class="form-control" name="sub_cat_id">
                                             <option selected disabled>Category SubCategory*</option>
                                             @foreach ($subCategories as $subCategory)
                                                 <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>

                                     <div class="col-6 mb-3">
                                         <div class="form-group" id="color_fields">
                                             <label for="color_name" class="form-label">Product Color(Optional)</label>
                                             <input type="text" class="form-control mb-2" name="color_name[]"
                                                 id="color_name" value="" />
                                         </div>
                                         <button type="button" class="btn btn-success float-end" id="add_color">Add
                                             more</button>
                                     </div>
                                     <div class="col-6 mb-3">
                                         <div class="form-group" id="size_fields">
                                             <label for="size_name" class="form-label">Product size(Optional)</label>
                                             <input type="text" class="form-control mb-2" name="size_name[]"
                                                 id="size_name" value="" />
                                         </div>
                                         <button type="button" class="btn btn-success float-end" id="add_size">Add
                                             more</button>
                                     </div>

                                     <div class="col-6 mb-3">
                                         <label for="qty" class="form-label">Product Quantity*</label>
                                         <input type="number" class="form-control" name="qty" id="qty"
                                             required />
                                     </div>
                                     <div class="col-6 mb-3">
                                         <label for="buying_price" class="form-label">Product Buying Price*</label>
                                         <input type="number" class="form-control" name="buying_price" id="buying_price"
                                             required />
                                     </div>
                                     <div class="col-6 mb-3">
                                         <label for="regular_price" class="form-label">Product Regular Price*</label>
                                         <input type="number" class="form-control" name="regular_price" id="regular_price"
                                             required />
                                     </div>
                                     <div class="col-6 mb-3">
                                         <label for="discount_price" class="form-label">Product Discount
                                             Price(Optional)</label>
                                         <input type="number" class="form-control" name="discount_price"
                                             id="discount_price" />
                                     </div>
                                     <div class="col-12 mb-3">
                                         <label for="product_type" class="form-label">Select Product Type</label>
                                         <select class="form-control" name="product_type">
                                             <option selected disabled>Category Product Type*</option>
                                             <option value="hot">Hot Product</option>
                                             <option value="regular">Regular product</option>
                                             <option value="new">New Arrival</option>
                                             <option value="discount">Discount Product</option>
                                         </select>
                                     </div>
                                     <div class="col-12 mb-3">
                                         <label for="product_policy" class="form-label">Product Description*</label>
                                         <textarea name="product_policy" id="summernote" class="form-control" required></textarea>
                                     </div>
                                     <div class="col-12 mb-3">
                                         <label for="description" class="form-label">Product Policy*</label>
                                         <textarea name="description" id="summernote2" class="form-control" required></textarea>
                                     </div>
                                     <div class="input-group mb-3">
                                         <input type="file" class="form-control" accept="image/*" name="image" id="image" required />
                                         <label class="input-group-text" for="inputGroupFile02">Upload Main Image</label>
                                     </div>
                                     <div class="input-group mb-3">
                                         <input type="file" class="form-control" accept="image/*" name="gallery_image[]" multiple  id="gallery_image" required />
                                         <label class="input-group-text" for="gallery_image">Upload Gallery Image</label>
                                     </div>
                                 </div>


                             </div>
                             <!--end::Body-->
                             <!--begin::Footer-->
                             <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                             </div>
                             <!--end::Footer-->
                         </form>
                         <!--end::Form-->
                     </div>
                     <!--end::Quick Example-->
                     <!--begin::Input Group-->

                     <!--end::Horizontal Form-->
                 </div>
                 <!--end::Col-->
                 <!--begin::Col-->

                 <!--end::Col-->
             </div>
             <!--end::Row-->
         </div>
         <!--end::Container-->
     </div>
 @endsection
 @push('script')
     <script>
         $(document).ready(function() {
             $('#summernote').summernote();
         });
     </script>

     <script>
         $(document).ready(function() {
             $('#summernote2').summernote();
         });
     </script>
     <script>
         $(document).ready(function() {
             $("#add_color").click(function() {
                 $("#color_fields").append(
                     '<input type="text" class="form-control mb-2" name="color_name[]" id="color_name" value=""/>'
                     )
             })
         })
     </script>

     <script>
         $(document).ready(function() {
             $("#add_size").click(function() {
                 $("#size_fields").append(
                     '<input type="text" class="form-control mb-2" name="size_name[]" id="size_name" value=""/>'
                     )
             })
         })
     </script>
 @endpush
