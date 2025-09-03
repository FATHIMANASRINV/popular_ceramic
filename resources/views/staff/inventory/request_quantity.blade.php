@extends('layouts.base')
@section('title', 'Add Quantity')
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
<div class="w-full px-6 py-6 mx-auto">
	<form id="requestProductForm">
		@csrf
		<div class="max-w-md bg-white shadow-lg rounded-2xl p-6">
			<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1 mt-2">
				Category
			</label>
			<select id="categorynameidss" required name="category_id" style="width: 100%;">
				<option value="">Select category</option>
			</select>
			<p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="category_idError"></p>
			<label for="ProductName" class="block text-sm font-medium text-gray-700 mb-1 mt-2">
				Product
			</label>
			<select id="productnameajax" required name="product" style="width: 100%;">
				<option value="">Select Product</option>
			</select>
			<p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="productError"></p>
			<label for="ProductName" class="block text-sm font-medium text-gray-700 mb-1 mt-2">
				Quantity
			</label>
			<input 
			type="number" 
			id="quantity" 
			name="quantity" 
			required 
			placeholder="Enter Quantity"  min="0"  
			class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
			@error('quantity') border-red-500 @enderror"
			/>
			<p class="text-red-600 text-sm error-text" style="font-size: 10px;" id="quantityError"></p>
			<div class="flex justify-end">
				<button  
				class="mt-4 px-6 py-2 font-bold text-white uppercase rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 text-xs tracking-tight shadow-md hover:scale-105 transition">
				Submit
			</button>
		</div>
	</form>
</div>
</div>
@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$('#categorynameidss').select2({
		placeholder: 'Select a Category',
		dropdownParent: $('#categorynameidss').parent(), 
		ajax: {
			url: '{{ route("staff.inventory.categorysearch") }}',
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
	$('#productnameajax').select2({
		placeholder: 'Select a Product',
		dropdownParent: $('#productnameajax').parent(), 
		ajax: {
			url: '{{ route("inventory.productsearch") }}',
			method: 'POST',   
			dataType: 'json',
			delay: 250,
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			data: function(params) {
				return { 
					q: params.term,
					category: $( "select#categorynameidss option:checked" ).val()
				};
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
	$('#categorynameidss').on('change', function () {
		$('#productnameajax').val(null).trigger('change'); 
		$('#productnameajax').empty().trigger('change');
	});
	$('#requestProductForm').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			url: "{{ route('inventory.InsertRequestproduct') }}",
			method: "POST",
			data: $(this).serialize(),
			success: function(response) {
				if(response.status) {
					toastr.success(response.message);   
					$('#requestProductForm')[0].reset(); 
					$('#categorynameidss').empty().trigger('change');
					$('#productnameajax').empty().trigger('change');
					$('#requestProductForm .error-text').empty();
				} else {
					toastr.error(response.message || 'Something went wrong!'); 
				}
			},
			error: function(xhr) {
				console.log(xhr.responseJSON);
				if(xhr.status === 422) {
					let errors = xhr.responseJSON.errors;
					console.log(errors);
					$('#requestProductForm .error-text').empty();
					$.each(errors, function(field, messages) {
						let errorElement = $('#requestProductForm #' + field + 'Error');
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
	// $('.edit-product').on('click', function(e) {
	// 	var id=$(this).data('id');
	// 	$.ajax({
	// 		url: "{{ route('inventory.editProductdetails') }}",
	// 		method: "GET",
	// 		data: { id: id },
	// 		success: function(response) {
	// 			if(response.status){
	// 				$('.append-datas').empty().html(response.html);
	// 				openeditModal();
	// 			} 
	// 		},
	// 		error: function(xhr) {
	// 			console.log(xhr.responseJSON);
	// 			if(xhr.status === 422) {
	// 				let errors = xhr.responseJSON.errors;
	// 				toastr.error('Unexpected error occurred.');
	// 			}
	// 		}
	// 	});
	// });
	// $(document).on('submit', '#editProductForm', function(e) {
	// 	e.preventDefault();

	// 	$.ajax({
	// 		url: "{{ route('inventory.Insertproduct') }}",
	// 		method: "POST",
	// 		data: $(this).serialize(),
	// 		success: function(response) {
	// 			if (response.status) {
	// 				$('#editProductModal').addClass('hidden');
	// 				toastr.success(response.message);   
	// 				$('#editProductForm')[0].reset(); 
	// 				$('#categorynameid').empty().trigger('change');
	// 				$('#editProductForm .error-text').empty();
	// 			} else {
	// 				toastr.error(response.message || 'Something went wrong!'); 
	// 			}
	// 		},
	// 		error: function(xhr) {
	// 			if (xhr.status === 422) {
	// 				let errors = xhr.responseJSON.errors;
	// 				$('#editProductForm .error-text').empty();
	// 				$.each(errors, function(field, messages) {
	// 					let errorElement = $('#editProductForm #' + field + 'Error');
	// 					if (errorElement.length) {
	// 						errorElement.empty().text(messages[0]);
	// 					}
	// 				});
	// 				toastr.error('Please fix the errors and try again.'); 
	// 			} else {
	// 				toastr.error('Unexpected error occurred.');
	// 			}
	// 		}
	// 	});
	// });

</script>
@endsection
