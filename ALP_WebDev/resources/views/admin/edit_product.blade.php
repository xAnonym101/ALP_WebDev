@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('saveUpdate', $toEdit->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="product_name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name"
                    value="{{ $toEdit->product_name }}" Required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="price"
                    value="{{ $toEdit->price }}"Required>
            </div>
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount</label>
                <input type="text" class="form-control" id="discount_percent" name="discount_percent"
                    placeholder="Discount Percent" value="{{ $toEdit->discount_percent }}" Required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description"
                    value="{{ $toEdit->description }}" Required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" Required>
                    @foreach ($categories as $option)
                        @if (old('category_id', $toEdit->category_id) === $option->category_id)
                            <option value="{{ $option->category_id }}" selected>{{ $option->category_name }}</option>
                        @else
                            <option value="{{ $option->category_id }}">{{ $option->category_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Events</label>
                <select name="event_id" id="event_id">
                    @foreach ($events as $option)
                        @if ($toEdit->event_id)
                            @if (old('event_id', $toEdit->event_id) === $option->event_id)
                                <option value="{{ $option->event_id }}" selected>{{ $option->event_name }}</option>
                            @else
                                <option value="{{ $option->event_id }}">{{ $option->event_name }}</option>
                            @endif
                        @else
                            <option value="{{ $option->event_id }}">{{ $option->event_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="best_seller" class="form-label">Best Seller</label>
                <select name="best_seller" id="best_seller" Required>
                    <option value="1" {{ $toEdit->best_seller == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $toEdit->best_seller == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>


            <div>
                @php $formCounter = 1 @endphp
                @foreach ($variants as $item)
                    @method('put')
                    @csrf
                    <h3>Variant {{ $formCounter }}</h3>

                    <label for="variant_name{{ $formCounter }}">Variant Name</label>
                    <input type="text" id="variant_name{{ $formCounter }}" name="variant_name{{ $formCounter }}"
                        value="{{ $item->variant_name }}" required>

                    <label for="color{{ $formCounter }}">Color </label>
                    <input type="text" id="color{{ $formCounter }}" name="color{{ $formCounter }}"
                        value="{{ $item->color }}" required>

                    <label for="description{{ $formCounter }}">Description </label>
                    <input type="text" id="description{{ $formCounter }}" name="description{{ $formCounter }}"
                        value="{{ $item->description }}" required>

                    <input type="hidden" id="variant_id{{ $formCounter }}" name="variant_id{{ $formCounter }}"
                        value="{{ $item->variant_id }}">
                    @php $formCounter++ @endphp

                    <script>
                        let formCounter = {{ $formCounter }};
                    </script>
                    <button class="btn btn-info" id="delete" name="delete"
                        value="{{ $item->variant_id }}">Delete</button>
                    <hr>
                @endforeach
            </div>



            <input type="hidden" id="formCounter" name="formCounter" value="0">
            <div id="dynamicFormsContainer">
            </div>

            <button type="button" onclick="addDynamicForm()">Add Another Form</button>
            <button onclick="submitForms()" class="btn btn-primary">Submit</button>
        </form>

        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($images as $key => $item)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }} pb-5">
                        <img src="{{ asset('storage/images/' . $item->image) }}" class="d-block w-100" alt="..."
                            style="object-fit: contain; max-height: 60vh;">
                        <div class="position-relative top-10">
                            <form class="position-absolute bottom-20 start-50 translate-middle"
                                action="{{ route('deleteImage', $item->image_id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <input type="hidden" id="{}">
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

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

        <form action="{{ route('saveUpdate', $toEdit->product_id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Image Add</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control" type="file" id="image" name="image"
                    accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
                <button>Add Image</button>
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
            <h3 for="field_${formCounter}">Add Variant ${formCounter}</h3>

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
