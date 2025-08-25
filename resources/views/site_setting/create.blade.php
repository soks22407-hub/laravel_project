@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add Site Setting</h4>
    <form action="{{ route('site_setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Facebook</label>
            <input type="text" name="facebook" class="form-control">
        </div>
        <div class="mb-3">
            <label>Telegram</label>
            <input type="text" name="telegram" class="form-control">
        </div>
        <div class="mb-3">
            <label>Youtube</label>
            <input type="text" name="youtube" class="form-control">
        </div>
        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control" id="myFile">
        </div>
        <div id="imgpreview" style="display:none; margin-top:10px;">
            <img id="preview-img" src="#" alt="Logo Preview" style="max-width: 150px;">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
@push('scripts')
    <script>
    document.getElementById('myFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('imgpreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
@endpush