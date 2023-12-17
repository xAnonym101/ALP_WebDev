@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{route('storeProduct')}}" method="POST">
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
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" Required>
                    @foreach ($categories as $option)
                        <option value="{{$option->category_id}}">{{$option->category_name}}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div id="dynamicFormsContainer">
                <!-- Dynamic forms will be added here -->
            </div>

            <button type="button" onclick="addDynamicForm()">Add Another Form</button> --}}

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

{{-- <script>
    let formCounter = 0;

    function addDynamicForm() {
        formCounter++;

        const dynamicForm = document.createElement('div');
        dynamicForm.innerHTML = `

            <h3 for="field_${formCounter}">Variant ${formCounter}</h3>

            <!-- New form fields -->
            <label for="variant_name${formCounter}">Variant Name</label>
            <input type="text" id="variant_name${formCounter}" name="variant_name${formCounter}" required>

            <label for="color${formCounter}">Color </label>
            <input type="text" id="color${formCounter}" name="color${formCounter}" required>

            <label for="description${formCounter}">Description </label>
            <input type="text" id="description${formCounter}" name="description${formCounter}" required>
            <!-- You can add more fields as needed -->

            // <hr> <!-- Optional: Add a separator between forms -->
        `;

        document.getElementById('dynamicFormsContainer').appendChild(dynamicForm);
    }

    function submitForm() {
        const mainForm = document.getElementById('mainForm');

        // Gather the dynamically added form data
        const dynamicFormData = [];
        for (let i = 1; i <= formCounter; i++) {
            dynamicFormData.push({
                variant_name: document.getElementById(`variant_name${i}`).value,
                color: document.getElementById(`color${i}`).value,
                description: document.getElementById(`description${i}`).value,
            });
        }

        // Append the dynamic form data to the main form
        const dynamicInput = document.createElement('input');
        dynamicInput.type = 'hidden';
        dynamicInput.name = 'variants';
        dynamicInput.value = JSON.stringify(dynamicFormData);
        mainForm.appendChild(dynamicInput);

        // Submit the form
        mainForm.submit();
    }
</script> --}}
