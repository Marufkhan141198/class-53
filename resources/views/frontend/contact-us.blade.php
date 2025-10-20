@extends('frontend.master')

@section('content')
   <section class="return-process-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 m-auto">
                        <form action="{{url('/contact-message/store')}}" method="POST" class="return-process-form form-group" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center">
                                <h3 class="return-process-form-title">Send Your Message</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{old('name')}}" placeholder="Name*" class="form-control"/>
                                        @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" value="{{old('phone')}}" placeholder="Phone*" class="form-control"/>
                                        @error('phone')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="phone">Email</label>
                                        <input type="email" name="email" value="{{old('email')}}" placeholder="Email*" class="form-control"/>
                                        @error('email')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                               
                               
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="issue">Your Message</label>
                                        <textarea name="message" cols="50" rows="5" class="form-control">{{old('message')}}</textarea>
                                        @error('message')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            <div class="return-process-btn-outer">
                                <button type="submit" id="productReturnProcess" class="return-process-btn-inner">
                                    Submit
                                </button>
                            </div>
                        </form>                
                    </div>
                </div>
            </div>
        </section>  
@endsection