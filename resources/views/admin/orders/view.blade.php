@extends('layouts.admin')

@section('title', 'My Orders Details')

@section('content')
    <div class="py-mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">

                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <div class="card border mt-3">


                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i>My Order Detail
                            <a href="{{ route('adminorder.index') }}" class=" btn btn-danger float-end btn-sm mx-1">
                                <span class="fa fa-arrow-left"></span> Back</a>
                            <a href="{{ route('admin.generateinvoice', ['orderId' => $order->id]) }}"
                                class=" btn btn-primary float-end btn-sm mx-1">
                                <span class="fa fa-download"></span> Download Invoice</a>
                            <a href="{{ route('admin.invoice', ['orderId' => $order->id]) }}" target="_blank"
                                class=" btn btn-warning float-end btn-sm mx-1">
                                <span class="fa fa-eye"></span> View Invoice</a>
                            <a href="{{ url('admin/invoice/' . $order->id . '/mail') }}" 
                                class=" btn btn-info float-end btn-sm mx-1">
                                <span class="fa fa-eye"></span> Send Invoice Via Mail</a>

                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <h6>Order Id: {{ $order->id }}</h6>
                                <h6>Tracing Id/No:{{ $order->tracking_no }}</h6>
                                <h6>Order Date:{{ $order->created_at->format('d-m-Y h-i-A') }}</h6>
                                <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                                <h6 class="border p-2 text-success">
                                    Order Success Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6>Full Name: {{ $order->fullname }}</h6>
                                <h6>Email Id: {{ $order->email }}</h6>
                                <h6>Phone: {{ $order->phone }}</h6>
                                <h6>Address: {{ $order->address }}</h6>
                                <h6>Pin Code: {{ $order->pincode }}</h6>
                            </div>
                        </div>
                        <br />
                        <h5>Order Item</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalprice = 0;
                                    @endphp
                                    {{-- @dd($order->orderItems); --}}
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{ $orderItem->id }}</td>
                                            <td>
                                                @if ($orderItem->product->productImages)
                                                    <img src="{{ asset($orderItem->product->productImages[0]->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="{{ $orderItem->product->name }}">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px"
                                                        alt="{{ $orderItem->product->name }}">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $orderItem->product->name }}
                                                @if ($orderItem->productColor)
                                                    @if ($orderItem->productColor->color)
                                                        <span>
                                                            - color : {{ $orderItem->productColor->color->name }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td width="10%">{{ $orderItem->price }}</td>
                                            <td width="10%"> {{ $orderItem->quantity }}</td>
                                            <td width="10%"> {{ $orderItem->quantity * $orderItem->price }}</td>
                                            @php
                                                $totalprice += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <td colspan="5" class="fw-bold">Total Amount:</td>
                                    <td class="fw-bold">{{ $totalprice }}</td>
                                </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4>Order Process (Order Status Updates)</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <form action="{{ route('adminorder.show', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="">Update Your Order Status</label>
                                        <div class="input-group">
                                            <select name="order_status" class="form-select">
                                                <option value="">Select Order Status</option>
                                                <option value="in progress" {{ Request::get('status') == 'in progress' }}>
                                                    In Progress
                                                </option>
                                                <option value="completed" {{ Request::get('status' == 'completed') }}>
                                                    Completed
                                                </option>
                                                <option value="pending" {{ Request::get('stauts') == 'pending' }}>Pending
                                                </option>
                                                <option value="cancelled" {{ Request::get('status' == 'cancelled') }}>
                                                    Cancelled
                                                </option>
                                                <option value="out-for-delivery"
                                                    {{ Request::get('status' == 'out-for-delivery') }}>
                                                    Out For Delivery
                                                </option>
                                            </select>
                                            <button type="submit" class="btn btn-primary  text-white">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <br />
                                    <h4 class="mt-3">Current Order Status: <span
                                            class="text-uppercase">{{ $order->status_message }}</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
