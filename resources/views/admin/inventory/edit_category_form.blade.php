<form id="editcategoryForm">
	@csrf
	<input type="hidden" name="id" value="{{ $details->id }}">
	<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
		Category Name
	</label>
	<input type="hidden" name="submit" value="edit">
	<input 
	type="text" 
	id="categoryName" 
	name="categoryName" 
	value="{{ $details->name }}"  
	required 
	placeholder="Enter category name"
	class="w-full rounded-md border border-gray-300 px-3 py-2 mb-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
	@error('categoryName') border-red-500 @enderror"
	/>
	<p class="text-red-600 text-sm " style="font-size: 10px;" id="categoryNameError"></p>
	<div class="mt-6 flex justify-end space-x-4">
		<button type="submit" class="px-4 py-2 bg-fuchsia-500 text-white rounded-lg hover:bg-fuchsia-600">
			Edit Category
		</button>&nbsp;&nbsp;&nbsp;
		<button 
		type="button" 
		onclick="document.getElementById('editCategoryModal').classList.add('hidden')" 
		class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300"
		>
		Close
	</button>
</div>
</form>
<script>
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