@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('saveSocial', $social->social_id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="socialmedia_name" class="form-label">Social Name</label>
                <input type="socialmedia_name" class="form-control" id="socialmedia_name" name="socialmedia_name" placeholder="Social Name"
                    value="{{ $social->socialmedia_name }}" Required>
            </div>
            @error('socialmedia_name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="socialmedia_link" class="form-label">Social Link</label>
                <input type="socialmedia_link" class="form-control" id="socialmedia_link" name="socialmedia_link" placeholder="Social Link"
                    value="{{ $social->socialmedia_link }}" Required>
            </div>
            @error('socialmedia_link')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="socialmedia_icon" class="form-label">Image Upload</label>
                <img class="img-preview img-fluid mb-3 col-sm-5" src="{{ asset('storage/images/' . $social->socialmedia_icon) }}"
                    alt="Preview">
                <input class="form-control" type="file" id="socialmedia_icon" name="socialmedia_icon"
                    accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
