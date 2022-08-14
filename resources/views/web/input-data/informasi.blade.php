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
        <select id="nik" name="nik">
          <option value="" disabled selected>Pilih NIK</option>
          <option value="1">312312</option>
          <option value="2">12512</option>
          <option value="3">6124312321</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input type='text' class="pickadate" placeholder="Tanggal Pendaftaran" />
      </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="nik" type="text">
        <label for="NIK">NIK</label>
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