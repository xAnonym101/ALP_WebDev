@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data">
        {{-- <form action="#" method="POST"> --}}
            @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" Required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description" Required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="price" Required>
            </div>
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount</label>
                <input type="text" class="form-control" id="discount_percent" name="discount_percent" placeholder="discount_percent" Required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control" type="file" id="image" name="image"
                    accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" Required>
                    @foreach ($categories as $option)
                        <option value="{{$option->category_id}}">{{$option->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" id="formCounter" name="formCounter" value="0">


            <div id="dynamicFormsContainer">
                <!-- Dynamic forms will be added here -->
            </div>

            <button type="button" onclick="addDynamicForm()">Add Another Form</button>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

<script>
    let formCounter = 0;

    function addDynamicForm() {
        formCounter++;

        const dynamicForm = document.createElement('div');
        dynamicForm.classList.add('mb-3');
        dynamicForm.id = `variant_form_${formCounter}`;
        dynamicForm.innerHTML = `
            <h3 for="field_${formCounter}">Variant ${formCounter}</h3>

            <!-- New form fields -->
            <label for="variant_name${formCounter}">Variant Name</label>
            <input type="text" id="variant_name${formCounter}" name="variant_name${formCounter}" required>

            <label for="color${formCounter}">Color </label>
            <input type="text" id="color${formCounter}" name="color${formCounter}" required>

            <label for="description${formCounter}">Description </label>
            <input type="text" id="description${formCounter}" name="description${formCounter}" required>

            <button type="button" onclick="removeDynamicForm(${formCounter})">Remove</button>
            <!-- You can add more fields as needed -->

            <hr> <!-- Optional: Add a separator between forms -->
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

