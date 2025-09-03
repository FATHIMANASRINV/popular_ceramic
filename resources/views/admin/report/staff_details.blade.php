@extends('layouts.base')
@section('title', 'Staff Details')
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
		<form method="GET" action="{{ route(auth()->user()->user_type.'.report.staff_details') }}">
			<div class="flex gap-4">
				<div class="w-1/2">
					<label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">
						Users
					</label>
					<select id="categorynameidss" name="user_id"
					class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
					<option value="">Select Users</option>
				</select>
			</div>
		</div>
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
				<table class="w-full border-collapse border border-gray-300 text-slate-600 rounded-lg shadow">
					<thead class="bg-gray-100">
						<tr>
							<th class="border border-gray-300 px-4 py-2 text-left">User Name</th>
							
							<th class="border border-gray-300 px-4 py-2 text-left">Email</th>
							<th class="border border-gray-300 px-4 py-2 text-left">Join Date</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach ($user_details as $Products)
						<tr class="hover:bg-gray-50">
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->name) }}</td>
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->email) }}</td>
							<td class="border border-gray-300 px-4 py-2">{{ ucfirst($Products->created_at) }}</td>
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
@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$('.status').select2({
	});
	$('#categorynameidss').select2({
		placeholder: 'Select a Email',
		dropdownParent: $('#categorynameidss').parent(), 
		ajax: {
			url: '{{ route(auth()->user()->user_type.".report.usersselect2") }}',
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
	

</script>
@endsection
