@extends('layouts.base')
@section('title', 'Requested Quantity')
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
	<div class="max-w-md bg-white shadow-lg rounded-2xl p-6">
		<form method="GET" action="{{ route(auth()->user()->user_type.'.inventory.pending_quantity') }}">
			<div class="flex gap-4">
				<div class="w-1/2">
					<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
						Category
					</label>
					<select id="categorynameidss" name="category_id"
					class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
					<option value="">Select category</option>
				</select>
			</div>

			<div class="w-1/2">
				<label for="status" class="block text-sm font-medium text-gray-700 mb-1">
					Status
				</label>
				<select name="status"
				class="status block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
				<option value="">Select an option</option>
				<option value="approved">Approved</option>
				<option value="pending" @if(auth()->user()->user_type=='admin')selected @endif>Pending</option>
				<option value="deleted">Deleted</option>
			</select>
		</div>
	</div>
	@if(auth()->user()->user_type!='admin')
	<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
	@endif
	<div class="flex justify-end">
		<button  
		class="mt-4 px-6 py-2 font-bold text-white uppercase rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 text-xs tracking-tight shadow-md hover:scale-105 transition">
		Submit
	</button>
</form>
</div>
</div>
</div>
<div class="w-full px-6 py-6 mx-auto">
	<div class="flex-auto p-6 px-0 pb-2">
		<div class="overflow-x-auto">
			<div class="mx-auto w-full max-w-6xl p-4">
				<table class="w-full border-collapse border border-gray-300 text-slate-600 rounded-lg shadow" id="table-wrapper">
					<thead class="bg-gray-100">
						<tr>
							@if(auth()->user()->user_type=='admin')
							<th class="border border-gray-300 px-4 py-2 text-left">User Name</th>
							@endif
							<th class="border border-gray-300 px-4 py-2 text-left">Product Name</th>
							<th class="border border-gray-300 px-4 py-2 text-left">category Name</th>
							<th class="border border-gray-300 px-4 py-2 text-left">Stock</th>
							<th class="border border-gray-300 px-4 py-2 text-center">Status</th>
							<th class="border border-gray-300 px-4 py-2 text-center">Date</th>
							@if(auth()->user()->user_type=='admin')
							<th class="border border-gray-300 px-4 py-2 text-center">Action</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $Products)
						<tr class="hover:bg-gray-50">
							@if(auth()->user()->user_type=='admin')
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->user_name) }}</td>
							@endif
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->product_name) }}</td>
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->category_name) }}</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								{{ ucfirst($Products->quantity) }}
							</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								@switch($Products->status)
								@case('approved')
								<span class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
									{{ ucfirst($Products->status) }}
								</span>
								@break
								@case('pending')
								<span class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
									{{ ucfirst($Products->status) }}
								</span>
								@break
								@case('deleted')
								<span class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
									{{ ucfirst($Products->status) }}
								</span>
								@break
								@default
								<span class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
									{{ ucfirst($Products->status) }}
								</span>
								@endswitch
							</td>
							<td class="border border-gray-300 px-4 py-2 text-center">
								{{ ucfirst($Products->created_at) }}
							</td>
							@if(auth()->user()->user_type=='admin')
							<td class="border border-gray-300 px-4 py-2">
								@if($Products->status=='pending')
								<a class="approve-quantity" data-id="{{  $Products->id  }}">
									<i class="fas fa-check text-blue-500 cursor-pointer" style="color: green;"></i></a>
									&nbsp;&nbsp;
									<a class="delete-quantity" data-id="{{  $Products->id  }}"><i class="fas fa-trash text-red-500 cursor-pointer"></i></a>
									@else
									---
									@endif
								</td>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$('.status').select2({
	});
	$('#categorynameidss').select2({
		placeholder: 'Select a Category',
		dropdownParent: $('#categorynameidss').parent(), 
		ajax: {
			url: '{{ route(auth()->user()->user_type.".inventory.categorysearch") }}',
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
	$(document).on('click', '.approve-quantity', function(e) {
		e.preventDefault(); 
		var id = $(this).data('id');
		$.ajax({
			url: "{{ route('inventory.approve_quantity') }}",
			method: "POST",
			data: { id: id,submit:'approve' },
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			success: function(response) {
				if (response.status) {
					toastr.success(response.message);
					$("#table-wrapper").load(location.href + " #table-wrapper > *");
				} else{
					toastr.success(response.message);
					$("#table-wrapper").load(location.href + " #table-wrapper > *");
				}
			},
			error: function(xhr) {
				console.log(xhr.responseJSON);
				if (xhr.status === 422) {
					toastr.error('Unexpected error occurred.');
				}
			}
		});
	});

	$(document).on('click', '.delete-quantity', function(e) {
		e.preventDefault(); 
		var id = $(this).data('id');
		$.ajax({
			url: "{{ route('inventory.approve_quantity') }}",
			method: "POST",
			data: { id: id,submit:'deleted' },
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			success: function(response) {
				if (response.status) {
					toastr.success(response.message);
					$("#table-wrapper").load(location.href + " #table-wrapper > *");
				} else{
					toastr.success(response.message);
					$("#table-wrapper").load(location.href + " #table-wrapper > *");
				}
			},
			error: function(xhr) {
				console.log(xhr.responseJSON);
				if (xhr.status === 422) {
					toastr.error('Unexpected error occurred.');
				}
			}
		});
	});


</script>
@endsection
