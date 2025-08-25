@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Site Setting</h4>
    <form action="{{ route('site_setting.update', $row->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $row->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" value="{{ $row->description }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control">{{ $row->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Facebook</label>
            <input type="text" name="facebook" value="{{ $row->facebook }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Telegram</label>
            <input type="text" name="telegram" value="{{ $row->telegram }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Youtube</label>
            <input type="text" name="youtube" value="{{ $row->youtube }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Logo</label>
            @if($row->logo)
                <div class="mb-2">
                    <img src="{{ asset('uploads/logos/thumb_' . $row->logo) }}" alt="Logo" style="height:40px;">
                </div>
            @endif
            <input type="file" name="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('logo');
        const previewContainer = document.getElementById('imgpreview');
        const previewImage = document.getElementById('preview-img');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);

                // Hide existing logo when selecting a new file
                const existingLogo = document.getElementById('existing-logo');
                if (existingLogo) {
                    existingLogo.style.display = 'none';
                }
            } else {
                previewImage.src = "";
                previewContainer.style.display = 'none';

                // Show existing logo again if file is cleared
                const existingLogo = document.getElementById('existing-logo');
                if (existingLogo) {
                    existingLogo.style.display = 'block';
                }
            }
        });
    });
    </script>
@endpush
