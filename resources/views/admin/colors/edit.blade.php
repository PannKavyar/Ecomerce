@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 ">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-harder bg-light">
                    <h4>Edit Color
                        <a href="{{ route('color.index') }}" class="btn btn-danger btn-sm text-white float-end">Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('color.update', $color->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="">Color Name</label>
                            <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Color Code</label>
                            <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label><br />
                            <input type="checkbox" name="status" value="{{ $color->status ? 'Checked' : '' }}"
                                style="width: 30px;heigh:30px">
                        </div>
                        <button type="subit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
