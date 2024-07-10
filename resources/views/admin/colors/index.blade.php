@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 ">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-harder bg-light">
                    <h3>Color Lists
                        <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                            Color</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Color Name</td>
                                <td>Color Code</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->code }}</td>
                                    <td>{{ $color->status ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('color.edit', $color->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('color.delete', $color->id) }}" sure
                                            onclick="return confirm('Are you sure you want to delete this data?')"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
