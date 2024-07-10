@extends('layouts.admin')

@section('title', 'My Orders')

@section('content')
    <div class="py-mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">

                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        {{-- @if ($errors->any())
                            <div class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif --}}

                        <div class="card-harder">
                            <h3>My Orders</h3>
                        </div>

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Filter by Date</label>
                                    <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}"
                                        class="form-cntrol">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Filter by Status</label>
                                    <select name="status" id="" class="form-select">
                                        <option value="">Select All Status</option>
                                        <option value="in progress" {{ Request::get('status') == 'in progress' }}>
                                            In Progress
                                        </option>
                                        <option value="completed" {{ Request::get('status' == 'completed') }}>Completed
                                        </option>
                                        <option value="pending" {{ Request::get('stauts') == 'pending' }}>Pending</option>
                                        <option value="cancelled" {{ Request::get('status' == 'cancelled') }}>Cancelled
                                        </option>
                                        <option value="out-for-delivery" {{ Request::get('status' == 'out-for-delivery') }}>
                                            Out For Delivery
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br />
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Tracking No</th>
                                            <th>User Name</th>
                                            <th>Payment Mode</th>
                                            <th>Ordered Date</th>
                                            <th>Status Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->tracking_no }}</td>
                                                <td>{{ $item->fullname }}</td>
                                                <td>{{ $item->payment_mode }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $item->status_message }}</td>
                                                <td><a href="{{ route('adminorder.show', $item->id) }} "
                                                        class="btn btn-primary btn-sm"> View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>No Order Item</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                                <div>
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
