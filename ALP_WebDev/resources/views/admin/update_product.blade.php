@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('saveUpdate', $toEdit->product_id) }}" method="POST">
            {{-- <form action="#" method="POST"> --}}
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
                <label for="best_seller" class="form-label">Best Seller</label>
                <select name="best_seller" id="best_seller" Required>
                    <option value="1" {{ $toEdit->best_seller == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $toEdit->best_seller == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <input type="hidden" id="formCounter" name="formCounter" value="0">


            <div id="dynamicFormsContainer">
            </div>

            <script>
                const variantsData = @json($variants ?? []);

                document.addEventListener('DOMContentLoaded', function() {
                    variantsData.forEach(function(variant) {
                        addDynamicForm(variant);
                    });
                });
            </script>

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

            <input type="hidden" id="variant_id${formCounter}" name="variant_id${formCounter}">
            <button type="button" onclick="removeDynamicForm(${formCounter}, 'variant_id${formCounter}')">Remove</button>

            <!-- You can add more fields as needed -->

            <hr> <!-- Optional: Add a separator between forms -->
        `;

        document.getElementById('dynamicFormsContainer').appendChild(dynamicForm);

        // Set values from $variants if available
        const variantData = @json($variants ?? null);
        if (variantData) {
            document.getElementById(`variant_name${formCounter}`).value = variantData[formCounter - 1].variant_name;
            document.getElementById(`color${formCounter}`).value = variantData[formCounter - 1].color;
            document.getElementById(`description${formCounter}`).value = variantData[formCounter - 1].description;
            document.getElementById(`variant_id${formCounter}`).value = variantData[formCounter - 1].variant_id;
        }

        document.getElementById('formCounter').value = formCounter;
    }

    function removeDynamicForm(formNumber, variantId) {
        const dynamicForm = document.getElementById(`variant_form_${formNumber}`);
        dynamicForm.remove();
    }
</script>
