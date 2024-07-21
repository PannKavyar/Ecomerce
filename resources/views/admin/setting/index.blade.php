@extends('layouts.admin')

@section('title', 'Admin Setting')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <form action="{{ url('/admin/settings') }}" method="POST">
                @csrf

                @if (session('message'))
                    <div class=" alert alert-success"> {{ session('message') }}</div>
                @endif
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Website Name</label>
                                <input type="text" name="website_name" value="{{ $setting->website_name ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Website URL</label>
                                <input type="text" name="website_url" value="{{ $setting->website_url ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Page Title</label>
                                <input type="text" name="page_title" value="{{ $setting->page_title ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Meta Keywords</label>
                                <input type="text" name="meta_keyword" value="{{ $setting->meta_keyword ?? '' }}"
                                    class="form-control" rows="3" />
                            </div>
                            <div class="col-md-6
                                    mb-3">
                                <label for="">Meta Description</label>
                                <input type="text" name="meta_description" value="{{ $setting->meta_description ?? '' }}"
                                    class="form-control" rows="3" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $setting->address ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone 1 *</label>
                                <input type="text" name="phone1" value="{{ $setting->phone1 ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone No.2</label>
                                <input type="text" name="phone2" value="{{ $setting->phone2 ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email Id 1 *</label>
                                <input type="text" name="email1" value="{{ $setting->email1 ?? '' }}"
                                    class="form-control" rows="3" />
                            </div>
                            <div class="col-md-6
                                    mb-3">
                                <label for="">Email Id 2</label>
                                <input type="text" name="email2" value="{{ $setting->email2 ?? '' }}"
                                    class="form-control" rows="3" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website -Social Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Facebook (Optinal)</label>
                                <input name="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Twitter (Optional)</label>
                                <input type="text" name="twitter" value="{{ $setting->twitter ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Instagram (Optional)</label>
                                <input type="text" name="instagram" value="{{ $setting->instagram ?? '' }}"
                                    class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Youtube (Optional)</label>
                                <input type="text" name="youtube" value="{{ $setting->youtube ?? '' }}"
                                    class="form-control" rows="3" />
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Setting</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
