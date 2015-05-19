<div class="form-group">
{!! Form::label("file", "Upload File") !!}
{!! Form::file("file",  ["class" => "form-control"]) !!}
</div>

<div class="form-group">
{!! Form::label("description", "File Description") !!}
{!! Form::textarea("description", null, ["class" => "form-control", "rows" => 3]) !!}
</div>

{!! Form::submit($submitTypeButton, ["class" => "btn btn-primary"]) !!}