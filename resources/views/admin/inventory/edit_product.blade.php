<form id="editProductForm">
    @csrf
    <input type="hidden" name="submit" value="edit">
    <input type="hidden" name="id" value="{{ $details->id }}">

    {{-- Product Name --}}
    <label for="productname" class="block text-sm font-medium text-gray-700 mb-1">
        Product Name
    </label>
    <input 
        type="text" 
        id="productname" 
        name="productname" 
        value="{{ $details->name }}"  
        required 
        placeholder="Enter Product name"
        class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
        @error('productname') border-red-500 @enderror"
    />
    <p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="productnameError"></p>

    {{-- Category --}}
    <label for="categorynameids" class="block text-sm font-medium text-gray-700 mb-1">
        Category
    </label>
    <select id="categorynameids" name="category_id" style="width: 100%;">
        @if($details->category_id)
            <option value="{{ $details->category_id }}" selected>{{ $details->category_name }}</option>
        @endif
    </select>
    <p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="category_idError"></p>

    {{-- Stock --}}
    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
        Stock
    </label>
    <input 
        type="number" 
        id="stock" 
        name="stock" 
        value="{{ old('stock', $details->stock) }}"  
        required 
        placeholder="Stock" 
        min="0"  
        class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
        @error('stock') border-red-500 @enderror"
    />
    <p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="stockError"></p>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="submit" class="px-4 py-2 bg-fuchsia-500 text-white rounded-lg hover:bg-fuchsia-600">
            Save Product
        </button>
       <!--  <button 
            type="button" 
            onclick="document.getElementById('editproductModal').classList.add('hidden')" 
            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300"
        >
            Close
        </button> -->
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categorynameids').select2({
            placeholder: 'Select a Category',
            dropdownParent: $('#categorynameids').parent(), 
            ajax: {
                url: '{{ route("admin.inventory.categorysearch") }}',
                method: 'POST',
                dataType: 'json',
                delay: 250,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function(params) {
                    return { q: params.term };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return { id: item.id, text: item.name };
                        })
                    };
                },
                cache: true
            }
        });
        if ($('#categorynameids').find('option[selected]').length) {
            $('#categorynameids').trigger('change');
        }
    });
</script>
