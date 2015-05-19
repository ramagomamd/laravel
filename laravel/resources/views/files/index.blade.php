@extends("app")

@section("content")

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Upload Files</h1>
			@include("errors._errors")
			{!! Form::open(["route" => "files.store", "files" => true]) !!}
			
			@include("files._form", ["submitTypeButton" => "Upload File"])

			{!! Form::close() !!}

		</div>
	</div>
</div>

@endsection