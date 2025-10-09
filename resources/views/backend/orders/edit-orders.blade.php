@extends('backend.master')
@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Order Details</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
               <form action="{{url('/admin/orders/update/'.$orders->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Customer Info</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->                      
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                    <label for="exampleInputEmail1" class="form-label">Invoice Number*</label>
                                    <input type="text" class="form-control" value="{{$orders->invoice_number}}" name="invoice_number" id="invoice_number" readonly />                       
                                </div> 
                                 <div class="mb-3 col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Customer name*</label>
                                    <input type="text" class="form-control" value="{{$orders->name}}" name="name" id="name" required />                       
                                </div>
                                 <div class="mb-3 col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Customer Phone*</label>
                                    <input type="text" class="form-control" value="{{$orders->phone}}" name="phone" id="phone" required />                       
                                </div> 
                                <div class="mb-3 col-md-12">
                                    <label for="exampleInputEmail1" class="form-label">Delivery Charge*</label>
                                    <input type="number" class="form-control" value="{{$orders->charge}}" name="charge" id="charge" required/>                       
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="exampleInputEmail1" class="form-label">Address*</label>
                                    <textarea class="form-control" name="address" id="address">{{$orders->address}}</textarea>                                    
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="exampleInputEmail1" class="form-label">Courier Name*</label>
                                     <select name="courier_name" class="form-control" id="courier_name">
                                        <option value="" disabled>Select Courier</option>
                                        <option value="steadfast" @if ($orders->courier_name == "steadfast")
                                            selected
                                        @endif>Steadfast</>
                                        <option value="pathao" @if ($orders->courier_name == "pathao")
                                            selected
                                        @endif>Pathao</>
                                    </select>                  
                                </div>  
                                </div>
                                                                             
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->                   
                            <!--end::Footer-->                        
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                    <!--begin::Input Group-->
                   
                    <!--end::Horizontal Form-->
                </div>
                <div class="col-md-6">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Product Info</div>
                        </div>
                        
                            <div class="card-body">
                                  @foreach ($orders->orderDetails as $details)
                                      <form action="{{url('/admin/orders/details/update'.$details->id)}}" method="post">
                                        @csrf
                                         <div class="mb-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('backend/image/product/' . $details->product->image) }}" height="100" width="100"></br> 
                                             {{$details->product->name}}</br>                   
                                        </div>
                                        <div class="col-md-8">
                                      <label>Unit Price</label>
                                     <input type="number" name="price" class="form-control" value="{{$details->price}}">      
                                     <label>Quantity</label>
                                     <input type="number" name="qty" class="form-control" value="{{$details->qty}}">
                                     <label>Delivery Charge</label>
                                     <input type="number" name="charge" class="form-control" value="{{$orders->charge}}">
                                     <label>Color</label>
                                     <input type="text" name="color" class="form-control" value="{{$details->color}}">
                                     <label>Size</label>
                                     <input type="text" name="size" class="form-control" value="{{$details->size}}">
                                     <input type="submit" value="update" class="form-control mt-3 btn btn-success">
                                        </div>
                                    </div>                   
                                      </form>
                                </div>  
                                
                                  @endforeach 
                                  <div>
                                    <label for="exampleInputEmail1" class="form-label">Total Price</label>
                                    <input type="number" class="form-control" value="{{$orders->price}}" name="price" id="price" required/>      
                                </div>        

                              
                                
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Order</button>
                            </div>
                            <!--end::Footer-->                     
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                    <!--begin::Input Group-->
                   
                    <!--end::Horizontal Form-->
                </div>
               </form>
                <!--end::Col-->
                <!--begin::Col-->
                
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection
