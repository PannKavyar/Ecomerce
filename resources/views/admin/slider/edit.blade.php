@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 ">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-harder bg-light">
                    <h3>Edit Slider
                        <a href="{{ route('slider.index') }}" class="btn btn-danger btn-sm text-white float-end">Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" value="" class="form-control" rows="3">{{ $slider->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" />
                            <img src="{{ asset($slider->image) }}" style="width:50px; heigh:50px" alt="Slider">
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label><br />
                            <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked':'' }} style="width: 30px;heigh:30px">
                        </div>
                        <button type="subit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
