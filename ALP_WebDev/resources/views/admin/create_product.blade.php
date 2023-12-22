@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <h1 class="mb-5">Create Product</h1>
        <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data">
        {{-- <form action="#" method="POST"> --}}
            @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" Required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" Required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price" Required>
            </div>
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount</label>
                <input type="text" class="form-control" id="discount_percent" name="discount_percent" placeholder="Discount (NUMBERS ONLY)" Required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="Link?" Required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image Upload</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control" type="file" id="image" name="image" required
                    accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
            </div>
            <div class="d-flex gap-5">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" Required>
                        @foreach ($categories as $option)
                            <option value="{{$option->category_id}}">{{$option->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="event_id" class="form-label">Events</label>
                    <select name="event_id" id="event_id">
                        <option value="0">None</option>
                        @foreach ($events as $option)
                            <option value="{{ $option->event_id }}">{{ $option->event_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" id="formCounter" name="formCounter" value="0">


            <div id="dynamicFormsContainer">
                <!-- Dynamic forms will be added here -->
            </div>

            <button type="button" onclick="addDynamicForm()">Add Another Form</button>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <br>

@endsection

<script>
    let formCounter = 0;

    function addDynamicForm() {
        formCounter++;

        const dynamicForm = document.createElement('div');
        dynamicForm.classList.add('mb-3');
        dynamicForm.id = `variant_form_${formCounter}`;
        dynamicForm.innerHTML = `
        <div class="mb-3">
        <h3 class="variant-title" for="field_${formCounter}">Add Variant ${formCounter}</h3>

        <!-- New form fields -->
        <div class="form-group mb-2">
            <label for="variant_name${formCounter}" class="form-label">Variant Name</label>
            <input type="text" id="variant_name${formCounter}" name="variant_name${formCounter}" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label for="color${formCounter}" class="form-label">Color</label>
            <input type="text" id="color${formCounter}" name="color${formCounter}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="description${formCounter}" class="form-label">Description</label>
            <input type="text" id="description${formCounter}" name="description${formCounter}" class="form-control" required>
        </div>

        <button type="button" onclick="removeDynamicForm(${formCounter})" class="btn btn-warning">Remove</button>
        <!-- You can add more fields as needed -->

        <hr class="variant-separator"> <!-- Optional: Add a separator between forms -->
    </div>
        `;

        document.getElementById('dynamicFormsContainer').appendChild(dynamicForm);
        document.getElementById('formCounter').value = formCounter;
    }

    function removeDynamicForm(formNumber) {
        const dynamicForm = document.getElementById(`variant_form_${formNumber}`);
        dynamicForm.remove();
    }

    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

