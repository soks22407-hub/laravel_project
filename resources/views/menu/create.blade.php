@extends('layouts.app')
@section('content')
    <div class="container-xxl">

        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Create Menu</h4>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <form class="form" method="POST" action="{{ route('menu.store') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" class="form-control" type="text" placeholder="Enter title">
                                <!-- {{-- <small>Error Message</small> --}} -->
                            </div>
                            <div class="mb-2">
                                <label for="sub_title" class="form-label">Sub_Title</label>
                                <input name="sub_title" class="form-control" type="text" placeholder="Enter sub_title">
                                <!-- {{-- <small>Error Message</small> --}} -->
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2">{{ old('description', $row->description ?? '') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="active" class="form-label">Active</label>
                                <select name="active" class="form-control">
                                    <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form><!--end form-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

    </div><!-- container -->
@endsection
