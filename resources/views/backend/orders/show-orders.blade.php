@extends('backend.master')
@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Order List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order List</li>
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
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('admin/orders/' . $status) }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="search" id="search" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('admin/orders/' . $status) }}" class="btn btn-danger">Clear</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{url('/admin/bulk-print-invoice')}}" method="post">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-tittle">Manage Orders</h3>
                             <div>
                                <button type="submit" class="btn btn-primary">Print Selected</button>
                            </div>       
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>SL</th>
                                            <th>Order Date</th>
                                            <th>Invoice</th>
                                            <th>Products</th>
                                            <th>Customer Info</th>
                                            <th>Price</th>
                                            <th>Delivery Charge</th>
                                            <th>Courier</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="order_id[]" id="orderCheckbox"
                                                        value="{{ $order->id }}">
                                                </td>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->invoice_number }}</br>
                                                    <a
                                                        href="{{ url('/admin/print-invoice/' . $order->id) }}"class="btn btn-success">Print</a>
                                                </td>

                                                <td>
                                                    @foreach ($order->orderDetails as $details)
                                                        <img src="{{ asset('backend/image/product/' . $details->product->image) }}"
                                                            height="100" width="100"></br>
                                                        {{ $details->product->name }} X{{ $details->qty }}</br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <p style ="color:brown">{{ $order->ip_address }}</p>
                                                    {{ $order->name }}
                                                    <p style="color:green"><b>Phone: {{ $order->phone }}</b></p>
                                                    <strong class="text-info">Address: {{ $order->address }}</strong>
                                                </td>
                                                <td>{{ $order->price }}</td>
                                                <td>{{ $order->charge }}</td>
                                                <td>
                                                    {{ $order->courier_name ?? 'Courier Not Selected' }}
                                                    <p class="text-success">{{ $order->consignment_id }}</p>
                                                    @if ($order->courier_name != null && $order->consignment_id == null)
                                                        <a href="{{ url('/admin/order-courier-entry/' . $order->id) }}"
                                                            class="btn btn-success">Entry Courier</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ url('/admin/orders/status/' . $order->id) }}"
                                                        method="post" id="statusUpdate{{ $order->id }}">
                                                        @csrf
                                                        <select name="status" class="form-control"
                                                            onchange="statusFormSubmission({{ $order->id }})"
                                                            style="width:auto;">
                                                            <option value="pending"
                                                                @if ($order->status == 'pending') selected @endif>Pending
                                                            </option>
                                                            <option value="confirmed"
                                                                @if ($order->status == 'confirmed') selected @endif>Confirmed
                                                            </option>
                                                            <option value="delivered"
                                                                @if ($order->status == 'delivered') selected @endif>Delivered
                                                            </option>
                                                            <option value="cancelled"
                                                                @if ($order->status == 'cancelled') selected @endif>Cancelled
                                                            </option>
                                                            <option value="returned"
                                                                @if ($order->status == 'returned') selected @endif>Returned
                                                            </option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/orders/edit/' . $order->id) }}"
                                                        class="btn mb-1 btn-primary">Details</a>
                                                    <a href="{{ url('/admin/orders/delete/' . $order->id) }}"
                                                        onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger">Delete</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection
@push('script')
    <script>
        function statusFormSubmission(id) {
            document.getElementById('statusUpdate' + id).submit();
            setTimeout(() => {
                form.reset();
            }, 100);
        }
    </script>
    <script>
        document.getElementById('selectAll').addEventListener('change',function(){
             let checkboxes = document.querySelectorAll('#orderCheckbox');
            checkboxes.forEach(checkBox => checkBox.checked = this.checked);
        });
           
    </script>
@endpush
