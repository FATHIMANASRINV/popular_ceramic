@extends('layouts.base')
@section('title', 'Category Management')
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
<div id="addCategoryModal"
class="modal-overlay fixed inset-0 z-[9999] flex items-center justify-center bg-black/30 backdrop-blur-lg hidden">
<div class="modal-content bg-white rounded-2xl shadow-xl p-6 w-1/2 max-w-3xl mx-4">
	<div class="flex justify-between items-center border-b pb-3">
		<h5 class="text-xl font-semibold">Add Category</h5>
		<button 
		onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
		class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;
	</button>
</div>
<div class="mt-4">
	<form id="categoryForm">
		@csrf
		<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
			Category Name
		</label>
		<input type="hidden" name="submit" value="add">
		<input 
		type="text" 
		id="categoryName" 
		name="categoryName" 
		value="{{ old('categoryName') }}"  
		required 
		placeholder="Enter category name"
		class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
		@error('categoryName') border-red-500 @enderror"
		/>
		<p class="text-red-600 text-sm " style="font-size: 10px;" id="categoryNameError"></p>
		<div class="mt-6 flex justify-end space-x-4">
			<button type="submit" class="px-4 py-2 bg-fuchsia-500 text-white rounded-lg hover:bg-fuchsia-600">
				Add Category
			</button>&nbsp;&nbsp;&nbsp;
			<button 
			type="button" 
			onclick="document.getElementById('addCategoryModal').classList.add('hidden')" 
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
			Add Category
		</button></div>
	</div>
	<div class="flex-auto p-6 px-0 pb-2">
		<div class="overflow-x-auto">
			<div class="mx-auto w-full max-w-6xl p-4">
				<table class="w-full border-collapse border border-gray-300 text-slate-600 rounded-lg shadow">
					<thead class="bg-gray-100">
						<tr>
							<th class="border border-gray-300 px-4 py-2 text-left">Category Name</th>
							<th class="border border-gray-300 px-4 py-2 text-center">Status</th>
							<th class="border border-gray-300 px-4 py-2 text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($categories as $category)
						<tr class="hover:bg-gray-50">
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($category->name) }}</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								{{ ucfirst($category->status) }}
							</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								<a class="edit-category" data-id="{{  $category->id  }}">
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
<div id="editCategoryModal"
class="modal-overlay fixed inset-0 z-[9999] flex items-center justify-center bg-black/30 backdrop-blur-lg hidden">
<div class="modal-content bg-white rounded-2xl shadow-xl p-6 w-1/2 max-w-3xl mx-4">
	<div class="flex justify-between items-center border-b pb-3">
		<h5 class="text-xl font-semibold">Edit Category</h5>
		<button 
		onclick="document.getElementById('editCategoryModal').classList.add('hidden')"
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
<script>
	function openModal() {
		document.getElementById('addCategoryModal').classList.remove('hidden');
	}
	function closeModal() {
		document.getElementById('addCategoryModal').classList.add('hidden');
	}function openeditModal() {
		document.getElementById('editCategoryModal').classList.remove('hidden');
	}
	function closeeditModal() {
		document.getElementById('editCategoryModal').classList.add('hidden');
	}
</script>
<script>
	$('#categoryForm').on('submit', function(e) {
		e.preventDefault(); 
		$('#categoryForm #categoryNameError').text('');
		$.ajax({
			url: "{{ route('inventory.store') }}",
			method: "POST",
			data: $(this).serialize(),
			success: function(response) {
				if(response.status) {
					document.getElementById('addCategoryModal').classList.add('hidden');
					toastr.success(response.message);   
				} else {
					toastr.error(response.message || 'Something went wrong!'); 
				}
			},
			error: function(xhr) {
				console.log(xhr.responseJSON);
				if(xhr.status === 422) {
					let errors = xhr.responseJSON.errors;
					if(errors.categoryName) {
						$('#categoryForm #categoryNameError').text(errors.categoryName[0]);
						toastr.error('Please fix the errors and try again.'); 
					}
				} else {
					toastr.error('Unexpected error occurred.');
				}
			}
		});
	});


	$('.edit-category').on('click', function(e) {
		var id=$(this).data('id');
		$.ajax({
			url: "{{ route('inventory.editcategorydetails') }}",
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

$(document).ready(function(){

	$('#editcategoryForm').on('submit', function(e) {
    e.preventDefault(); 
    $('#editcategoryForm #categoryNameError').text('');
    $.ajax({
        url: "{{ route('inventory.store') }}", 
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if(response.status) {
                document.getElementById('editCategoryModal').classList.add('hidden');
                toastr.success(response.message);   
            } else {
                toastr.error(response.message || 'Something went wrong!'); 
            }
        },
        error: function(xhr) {
            console.log(xhr.responseJSON);
            if(xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                if(errors.categoryName) {
                    $('#editcategoryForm #categoryNameError').text(errors.categoryName[0]);
                    toastr.error('Please fix the errors and try again.'); 
                }
            } else {
                toastr.error('Unexpected error occurred.');
            }
        }
    });
});

	});
</script>
@endsection
