@extends('backend.master')
@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Update Settings</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Settings</li>
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
                            <div class="card-title">Input Settings</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{url('/admin/general-settings/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone*</label>
                                    <input type="text" class="form-control" value="{{$settings->phone}}" name="phone" id="phone" required /> 
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control" value="{{$settings->email}}" name="email" id="email" required /> 
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address(optional)</label>
                                    <textarea name="address" class="form-control" id="address">{{$settings->address}}</textarea> 
                                </div>
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook Link(optional)</label>
                                    <input type="text" class="form-control" name="facebook" value="{{$settings->facebook}}" id="facebook" required /> 
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Twitter Link(optional)</label>
                                    <input type="text" class="form-control" name="twitter" value="{{$settings->twitter}}" id="twitter" required /> 
                                </div>
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram Link(optional)</label>
                                    <input type="text" class="form-control" name="instagram" value="{{$settings->instagram}}" id="instagram" required /> 
                                </div>
                                <div class="mb-3">
                                    <label for="youtube" class="form-label">Youtube Link(optional)</label>
                                    <input type="text" class="form-control" name="youtube" value="{{$settings->youtube}}" id="youtube" required /> 
                                </div>
                                <div class="mb-3">
                                    <label for="free_shipping_amount" class="form-label">Free Shipping Amount</label>
                                    <input type="number" class="form-control" name="free_shipping_amount" value="{{$settings->free_shipping_amount}}" id="free_shipping_amount" required /> 
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="logo" id="logo"/>
                                    <label class="input-group-text" for="logo">Upload Logo</label>
                                    <img src="{{asset('backend/image/settings/'.$settings->logo)}}"  height="60" width="150">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="hero_image" id="hero_image"/>
                                    <label class="input-group-text" for="hero_image">Upload Slider</label>
                                    <img src="{{asset('backend/image/settings/'.$settings->hero_image)}}" height="400" width="1200">
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
