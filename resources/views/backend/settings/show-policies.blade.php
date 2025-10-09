 @extends('backend.master')
 @section('content')
     <div class="app-content-header">
         <!--begin::Container-->
         <div class="container-fluid">
             <!--begin::Row-->
             <div class="row">
                 <div class="col-sm-6">
                     <h3 class="mb-0">Edit Policies & About Us</h3>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-end">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Edit Policies & About Us</li>
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
                             <div class="card-title">Input Contents</div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Form-->
                         <form action="{{ url('/admin/policies/update')}}" method="POST" enctype="multipart/form-data">
                             @csrf
                             <!--begin::Body-->
                             <div class="card-body">
                                 <div class="row">

                                    
                                     <div class="col-12 mb-3">
                                         <label for="privacy_policy" class="form-label">Privacy Policy*</label>
                                         <textarea name="privacy_policy" id="summernote" class="form-control" required>{{$policiesAboutus->privacy_policy}}</textarea>
                                     </div>
                                     <div class="col-12 mb-3">
                                         <label for="terms_conditions" class="form-label">Terms & conditions*</label>
                                         <textarea name="terms_conditions" id="summernote2" class="form-control" required>{{$policiesAboutus->terms_conditions}}</textarea>
                                     </div>
                                      <div class="col-12 mb-3">
                                         <label for="refund_policy" class="form-label">Refund Policy*</label>
                                         <textarea name="refund_policy" id="summernote3" class="form-control" required>{{$policiesAboutus->refund_policy}}</textarea>
                                     </div>
                                      <div class="col-12 mb-3">
                                         <label for="payment_policy" class="form-label">Payment Policy*</label>
                                         <textarea name="payment_policy" id="summernote4" class="form-control" required>{{$policiesAboutus->payment_policy}}</textarea>
                                     </div>
                                     <div class="col-12 mb-3">
                                         <label for="return_policy" class="form-label">Return Policy*</label>
                                         <textarea name="return_policy" id="summernote5" class="form-control" required>{{$policiesAboutus->return_policy}}</textarea>
                                     </div>
                                     <div class="col-12 mb-3">
                                         <label for="about_us" class="form-label">About Us*</label>
                                         <textarea name="about_us" id="summernote6" class="form-control" required>{{$policiesAboutus->about_us}}</textarea>
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
        $(document).ready(function(){
            $('#summernote3').summernote();
        })
     </script>
     <script>
        $(document).ready(function(){
            $('#summernote4').summernote();
        })
     </script>
     <script>
        $(document).ready(function(){
            $('#summernote5').summernote();
        })
     </script>
     <script>
        $(document).ready(function(){
            $('#summernote6').summernote();
        })
     </script>
 @endpush
