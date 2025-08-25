@extends('layouts.app')
@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Banner</h4>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('banner.update', $row->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label class="form-label">Name</label>
                            <input name="name" class="form-control" type="text" value="{{ $row->name }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2">{{ $row->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection