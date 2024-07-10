@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 ">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-harder bg-light">
                    <h3>Add Slider
                        <a href="{{ route('slider.index') }}" class="btn btn-danger btn-sm text-white float-end">Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label><br />
                            <input type="checkbox" name="status" style="width: 30px;heigh:30px">
                        </div>
                        <button type="subit" class="btn btn-primary">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
