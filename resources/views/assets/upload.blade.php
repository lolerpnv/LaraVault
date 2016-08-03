@extends('layouts.app')

@section('content')
<form align="center" role="form"  method="post" action="{{ url('/file') }}" enctype="multipart/form-data" >
    {!!  csrf_field() !!}
    <div class="form-group">
        <label class="btn btn-default btn-file"> Select ...
            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none">
        </label>
    </div>
    <br/>
    <div class="checkbox">
        <label><input type="checkbox" name="private" id="private">Private</label>
    </div>
    <button type="submit" class="btn btn-default" value="Upload" name="submit">Upload</button>
</form>
@endsection