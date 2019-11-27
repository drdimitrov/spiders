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
	<div class="row">
		<div class="col-md-8">
			<form action="{{ route('contact') }}" method="POST">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
					@if($errors->has('name'))
						<p style="color: red; !important">{{ $errors->first('name')  }}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control" id="email" placeholder="john@example.com">
					@if($errors->has('email'))
						<p style="color: red; !important">{{ $errors->first('email')  }}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" name="subject" class="form-control" id="subject" placeholder="Your subject">
					@if($errors->has('subject'))
						<p style="color: red; !important">{{ $errors->first('subject')  }}</p>
					@endif
				</div>
				<div class="form-group">
					<label for="body">Type your question here.</label>
					<textarea class="form-control" name="body" id="body" rows="5"></textarea>
					@if($errors->has('body'))
						<p style="color: red; !important">{{ $errors->first('body')  }}</p>
					@endif
				</div>

				<div id="contact_us_id"></div>

				<button type="submit" class="btn btn-custom">Submit</button>
				{{ csrf_field() }}
			</form>

			{!!  GoogleReCaptchaV3::render(['contact_us_id'=>'contact', 'signup_id'=>'signup']) !!}
		</div>
		<div class="col-md-4">
			<h3>Authors:</h3>
			<address>
				<strong>Dragomir Dimitrov</strong><br>
				National Museum of Natural History,<br>
				1 Tsar Osvoboditel Blvd,<br>
				1000 Sofia, Bulgaria<br>
				<abbr title="Email">Email:</abbr>
				{!! obscure('dimitrov@nmnhs.com') !!}
			</address>

			<address>
				<strong>Simeon Indzhov</strong><br>
				National Museum of Natural History,<br>
				1 Tsar Osvoboditel Blvd,<br>
				1000 Sofia, Bulgaria<br>
				<abbr title="Email">Email:</abbr>
				{!! obscure('sinjov@abv.com') !!}
			</address>
		</div>
	</div>
</div>
<style>
	.col-md-3{
		padding-left: 5%;
	}

	footer{
		z-index: -1;
	}
</style>
@endsection