@extends('layout.main')

@section('main-page')
<div class="container-fluid">
  <div class="row">
    <div class="col s12 m12 l12 xl6">
      <div class="card">
        <div class="card-content">
          <h5 class="card-title">Form Daftar Nasabah</h5>
          <form method="POST" action="/input/data/nasabah" style="padding-top: .75rem !important;">
            @if ($errors->any())
            <ul style="padding-bottom: .75rem;">
              @foreach ($errors->all() as $error)
              <li style="color: red;">{{ $error }}</li>
              @endforeach
            </ul>
            @endif
            @csrf
            <div class="input-field">
              <input id="name" name="name" type="text" placeholder="Masukkan Nama KTP">
              <label for="name" class="active">Nama KTP</label>
            </div>
            <div class="input-field">
              <input id="nik" name="nik" type="text" placeholder="Masukkan NIK">
              <label for="nik" class="active">NIK</label>
            </div>
            <div class="box" style="width: 100%; display: flex; justify-content: end;">
              <button type="submit" class="btn waves-effect waves-light primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection