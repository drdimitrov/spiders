@extends('layouts.main')

@section('content')
<div class="container">
  <div class="page-header">
    <h1>Contact us</h1>
  </div>

  	@if(Session::has('msg'))
	<div class="alert alert-success">
	  {{Session::get('msg')}}
	</div>
  	@endif

	<form action="{{ route('contact') }}" method="POST">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" class="form-control" id="email" placeholder="john@example.com">
		</div>
		<div class="form-group">
			<label for="subject">Subject</label>
			<input type="text" name="subject" class="form-control" id="subject" placeholder="Your subject">
		</div>
		<div class="form-group">
			<label for="body">Type your question here.</label>
			<textarea class="form-control" name="body" id="body" rows="5"></textarea>
		</div>
		<button type="submit" class="btn btn-custom">Submit</button>
		{{ csrf_field() }}
	</form>
  
</div>
@endsection