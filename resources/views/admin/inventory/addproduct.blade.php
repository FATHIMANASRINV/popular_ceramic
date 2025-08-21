@extends('layouts.base')
@section('title', 'Product Management')
@section('header')
<style>
	.modal-overlay {
		position: fixed;
		inset: 0;
		top: -62px;
		width: 100vw;
		height: 100vh;
		background-color: rgba(0, 0, 0, 0.25);
		backdrop-filter: blur(8px);
		-webkit-backdrop-filter: blur(8px);
		z-index: 9999; 
		display: flex;
		justify-content: center;
		align-items: center;
	}
</style>
@endsection
@section('content')
<div id="addproductModal"
class="modal-overlay fixed inset-0 z-[9999] flex items-center justify-center bg-black/30 backdrop-blur-lg hidden">
<div class="modal-content bg-white rounded-2xl shadow-xl p-6 w-1/2 max-w-3xl mx-4">
	<div class="flex justify-between items-center border-b pb-3">
		<h5 class="text-xl font-semibold">Add Product</h5>
		<button 
		onclick="document.getElementById('addproductModal').classList.add('hidden')"
		class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;
	</button>
</div>
<div class="mt-4">
	<form id="ProductForm">
		@csrf
		<input type="hidden" name="submit" value="add">



		<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
			Product Name
		</label>
		<input 
		type="text" 
		id="productname" 
		name="productname" 
		value="{{ old('productname') }}"  
		required 
		placeholder="Enter Product name"
		class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
		@error('productname') border-red-500 @enderror"
		/>
		<p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="productnameError"></p>
		<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
			Category
		</label>
	<!-- 	<input 
		type="text" 
		id="categoryname" 
		name="categoryname" 
		value="{{ old('categoryname') }}"  
		required 
		placeholder="Enter Category Name"
		class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
		@error('categoryname') border-red-500 @enderror"
		/> -->
		<select id="categorynameid" name="category_id" style="width: 100%;">
			<option value="">Select category</option>
			
		</select>
		<p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="category_idError"></p>
		<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
			Stock
		</label>
		<input 
		type="number" 
		id="stock" 
		name="stock" 
		value="{{ old('stock') }}"  
		required 
		placeholder="Stock" min="0"  
		class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
		@error('stock') border-red-500 @enderror"
		/>
		<p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="stockError"></p>
		<div class="mt-6 flex justify-end space-x-4">
			<button type="submit" class="px-4 py-2 bg-fuchsia-500 text-white rounded-lg hover:bg-fuchsia-600">
				Add Product
			</button>&nbsp;&nbsp;&nbsp;
			<button 
			type="button" 
			onclick="document.getElementById('addproductModal').classList.add('hidden')" 
			class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300"
			>
			Close
		</button>
	</div>
</form>
</div>
</div>
</div>
<div class="w-full px-6 py-6 mx-auto">
	<div class="flex flex-wrap my-6 -mx-3">
		<div
		class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-full md:flex-none lg:w-full lg:flex-none">
		<div
		class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
		<div
		class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
		<div class="flex items-center justify-between">
			<h6 class="m-0"></h6>
			<button onclick="openModal()" 
			class="inline-block px-6 py-3 font-bold text-center text-white uppercase rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 text-xs tracking-tight shadow-md hover:scale-105 transition">
			Add Product
		</button></div>
	</div>
	<div class="flex-auto p-6 px-0 pb-2">
		<div class="overflow-x-auto">
			<div class="mx-auto w-full max-w-6xl p-4">
				<table class="w-full border-collapse border border-gray-300 text-slate-600 rounded-lg shadow">
					<thead class="bg-gray-100">
						<tr>
							<th class="border border-gray-300 px-4 py-2 text-left">Product Name</th>
							<th class="border border-gray-300 px-4 py-2 text-left">category Name</th>
							<th class="border border-gray-300 px-4 py-2 text-left">Stock</th>
							<th class="border border-gray-300 px-4 py-2 text-center">Status</th>
							<th class="border border-gray-300 px-4 py-2 text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $Products)
						<tr class="hover:bg-gray-50">
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->name) }}</td>
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->category_name) }}</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								{{ ucfirst($Products->stock) }}
							</td><td class="border border-gray-300 px-4 py-2 text-center">
								{{ ucfirst($Products->status) }}
							</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								<a class="edit-product" data-id="{{  $Products->id  }}">
									<i class="fas fa-edit text-blue-500 cursor-pointer"></i></a>
									&nbsp;&nbsp;
									<a class="delete-category"><i class="fas fa-trash text-red-500 cursor-pointer"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div id="editProductModal"
class="modal-overlay fixed inset-0 z-[9999] flex items-center justify-center bg-black/30 backdrop-blur-lg hidden">
<div class="modal-content bg-white rounded-2xl shadow-xl p-6 w-1/2 max-w-3xl mx-4">
	<div class="flex justify-between items-center border-b pb-3">
		<h5 class="text-xl font-semibold">Edit Product</h5>
		<button 
		onclick="document.getElementById('editProductModal').classList.add('hidden')"
		class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;
	</button>
</div>
<div class="mt-4 append-datas">
</div>
</div>
</div>
@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	function openModal() {
		document.getElementById('addproductModal').classList.remove('hidden');
	}
	function closeModal() {
		document.getElementById('addproductModal').classList.add('hidden');
	}function openeditModal() {
		document.getElementById('editProductModal').classList.remove('hidden');
	}
	function closeeditModal() {
		document.getElementById('editProductModal').classList.add('hidden');
	}
</script>
<script>
	$('#categorynameid').select2({
		placeholder: 'Select a Category',
		dropdownParent: $('#categorynameid').parent(), 
		ajax: {
			url: '{{ route("inventory.categorysearch") }}',
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
	$('#ProductForm').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			url: "{{ route('inventory.Insertproduct') }}",
			method: "POST",
			data: $(this).serialize(),
			success: function(response) {
				if(response.status) {
					document.getElementById('addproductModal').classList.add('hidden');
					toastr.success(response.message);   
					$('#ProductForm')[0].reset(); 
					$('#categorynameid').empty().trigger('change');
					$('#ProductForm .error-text').empty();
				} else {
					toastr.error(response.message || 'Something went wrong!'); 
				}
			},
			error: function(xhr) {
				console.log(xhr.responseJSON);
				if(xhr.status === 422) {
					let errors = xhr.responseJSON.errors;
					console.log(errors);
					$('#ProductForm .error-text').empty();
					$.each(errors, function(field, messages) {
						let errorElement = $('#ProductForm #' + field + 'Error');
						if (errorElement.length) {
							errorElement.empty().text(messages[0]);
						}
					});
					if(errors) {
						toastr.error('Please fix the errors and try again.'); 
					}
				} else {
					toastr.error('Unexpected error occurred.');
				}
			}
		});
	});
	$('.edit-product').on('click', function(e) {
		var id=$(this).data('id');
		$.ajax({
			url: "{{ route('inventory.editProductdetails') }}",
			method: "GET",
			data: { id: id },
			success: function(response) {
				if(response.status){
					$('.append-datas').empty().html(response.html);
					openeditModal();
				} 
			},
			error: function(xhr) {
				console.log(xhr.responseJSON);
				if(xhr.status === 422) {
					let errors = xhr.responseJSON.errors;
					toastr.error('Unexpected error occurred.');
				}
			}
		});
	});
	$(document).on('submit', '#editProductForm', function(e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('inventory.Insertproduct') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if (response.status) {
                $('#editProductModal').addClass('hidden');
                toastr.success(response.message);   
                $('#editProductForm')[0].reset(); 
                $('#categorynameid').empty().trigger('change');
                $('#editProductForm .error-text').empty();
            } else {
                toastr.error(response.message || 'Something went wrong!'); 
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $('#editProductForm .error-text').empty();
                $.each(errors, function(field, messages) {
                    let errorElement = $('#editProductForm #' + field + 'Error');
                    if (errorElement.length) {
                        errorElement.empty().text(messages[0]);
                    }
                });
                toastr.error('Please fix the errors and try again.'); 
            } else {
                toastr.error('Unexpected error occurred.');
            }
        }
    });
});

</script>
@endsection
