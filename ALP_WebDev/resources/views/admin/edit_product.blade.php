@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <h1 class="mb-5">Update Product</h1>
        <form action="{{ route('saveUpdate', $toEdit->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Information -->
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    placeholder="Enter Product Name" value="{{ $toEdit->product_name }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price"
                    value="{{ $toEdit->price }}" required>
            </div>

            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount Percent</label>
                <input type="text" class="form-control" id="discount_percent" name="discount_percent"
                    placeholder="Enter Discount Percent" value="{{ $toEdit->discount_percent }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                    placeholder="Enter Description" value="{{ $toEdit->description }}" required>
            </div>

            <!-- Product Attributes -->
            <div class="d-flex gap-5">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" required>
                        @foreach ($categories as $option)
                            <option value="{{ $option->category_id }}"
                                {{ old('category_id', $toEdit->category_id) === $option->category_id ? 'selected' : '' }}>
                                {{ $option->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="event_id" class="form-label">Events</label>
                    <select name="event_id" id="event_id">
                        <option value="0">None</option>
                        @foreach ($events as $option)
                            <option value="{{ $option->event_id }}"
                                {{ $toEdit->event_id ? (old('event_id', $toEdit->event_id) === $option->event_id ? 'selected' : '') : '' }}>
                                {{ $option->event_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="best_seller" class="form-label">Best Seller</label>
                    <select name="best_seller" id="best_seller" required>
                        <option value="1" {{ $toEdit->best_seller == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $toEdit->best_seller == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <!-- Variant Forms -->
            <div>
                @php $formCounter = 1 @endphp
                @foreach ($variants as $item)
                    <!-- Variant Form Fields -->
                    <div class="mb-3">
                        <h3 class="variant-title" for="field_${formCounter}">Variant {{$formCounter}}</h3>

                        <!-- New form fields -->
                        <div class="form-group mb-2">
                            <label for="variant_name${formCounter}" class="form-label">Variant Name</label>
                            <input type="text" id="variant_name${formCounter}" name="variant_name${formCounter}" class="form-control" value="{{$item->variant_name}}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="color${formCounter}" class="form-label">Color</label>
                            <input type="text" id="color${formCounter}" name="color${formCounter}" class="form-control" value="{{$item->color}}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="description${formCounter}" class="form-label">Description</label>
                            <input type="text" id="description${formCounter}" name="description${formCounter}" class="form-control" value="{{$item->description}}" required>
                        </div>
                        <!-- You can add more fields as needed -->
                    </div>
                    <!-- Add variant form fields -->

                    <input type="hidden" id="variant_id{{ $loop->iteration }}" name="variant_id{{ $loop->iteration }}"
                        value="{{ $item->variant_id }}">

                    <button class="btn btn-danger" id="delete" name="delete"
                        value="{{ $item->variant_id }}">Delete</button>
                    <hr>
                    @php
                        $formCounter++;
                    @endphp
                @endforeach
            </div>

            <!-- Dynamic Variant Forms -->
            <input type="hidden" id="formCounter" name="formCounter" value="0">
            <div id="dynamicFormsContainer"></div>
            <button type="button" onclick="addDynamicForm()" class="btn btn-success">Add Another Variant</button>
            <button onclick="submitForms()" class="btn btn-primary">Submit</button>
        </form>

        <!-- Image Carousel -->
        <div id="carouselExample" class="carousel slide mt-5">
            <div class="carousel-inner">
                @foreach ($images as $key => $item)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }} pb-5">
                        <img src="{{ asset('storage/images/' . $item->image) }}" class="d-block w-100" alt="Product Image"
                            style="object-fit: contain; max-height: 60vh;">
                    </div>
                @endforeach
            </div>

            <!-- Image Deletion Buttons -->
            @foreach ($images as $item)
                <form class="position-absolute bottom-20 start-50 translate-middle"
                    action="{{ route('deleteImage', $item->image_id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <input type="hidden" id="{}">
                    <button type="submit" class="btn btn-danger delete-button">Delete Image</button>
                </form>
            @endforeach

            <!-- Carousel Controls -->
            <style>
                .carousel-control-prev-icon,
                .carousel-control-next-icon {
                    background-color: black;
                }
            </style>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Add Image Section -->
        <form action="{{ route('saveUpdate', $toEdit->product_id) }}" method="POST" enctype="multipart/form-data"
            class="mt-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label ms-1">Add Image</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control mb-3" type="file" id="image" name="image"
                    accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
                <button type="submit" class="btn btn-primary">Save Image</button>
            </div>
        </form>
    </div>
@endsection



<script>
    let formCounter = {{ $formCounter ?? 0 }};
    formCounter = formCounter ? formCounter : 0;

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

    function submitForms() {
        // document.getElementById('productForm').submit();

        const formCount = {{ $formCounter }};
        for (let i = 1; i <= formCount; i++) {
            document.getElementById(`variantForm${i}`).submit();
        }
    }
</script>
