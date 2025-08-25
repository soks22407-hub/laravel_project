@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Edit Post</h4>
                            </div><!-- end col -->
                        </div> <!-- end row -->
                    </div><!-- end card-header -->
                    <div class="card-body pt-0">
                        <!-- Add enctype="multipart/form-data" for file uploads. -->
                        <form class="form" method="POST" action="{{ route('post.update', $row->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Title field with old() helper to retain value on validation error -->
                            <div class="mb-2">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" class="form-control @error('title') is-invalid @enderror" type="text" value="{{ old('title', $row->title) }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Sub_Title field with old() helper -->
                            <div class="mb-2">
                                <label for="sub_title" class="form-label">Sub Title</label>
                                <input name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" type="text" value="{{ old('sub_title', $row->sub_title) }}">
                                @error('sub_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description field with old() helper -->
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ old('description', $row->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <!-- Content field with old() helper -->
                            <div class="mb-2">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content', $row->content) }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <fieldset>
                                <div class="body-title">Upload images <span class="tf-color-1">*</span>
                                </div>
                                <div class="upload-image flex-grow">
                                    <div class="item" id="imgpreview" style="display:none">
                                        <img src="upload-1.html" class="effect8" alt="">
                                    </div>
                                    <div id="upload-file" class="item up-load">
                                        <label class="uploadfile" for="myFile">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <span class="body-text">Drop your images here or select <span
                                                    class="tf-color">click to browse</span></span>
                                            <input type="file" id="myFile" name="image" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            @error('image') <span class = "alert alert-danger text-center">{{$message}}</span> @enderror

                            <!-- Active status select field with old() helper -->
                             <div class="mb-2">
                                <label for="active" class="form-label">Active</label>
                                <select name="active" class="form-control @error('active') is-invalid @enderror">
                                    <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('active')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form><!-- end form -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div> <!-- end col -->
        </div><!-- end row -->
    </div><!-- container -->
@endsection
