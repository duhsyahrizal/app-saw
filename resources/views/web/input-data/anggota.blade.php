@extends('layout.main')

@section('main-page')
    <div class="container-fluid">
<form>
    <div class="row">
        <div class="input-field col s12">
            <input id="name" type="text">
            <label for="name">Name</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="nik" type="text">
            <label for="NIK">NIK</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
            </button>
        </div>
    </div>
</form>
    </div>
@endsection
