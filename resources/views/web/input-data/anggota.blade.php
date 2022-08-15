@extends('layout.main')

@section('main-page')
<div class="container-fluid">
  <div class="row">
    <div class="col s12 m12 l12 xl6">
      <div class="card">
        <div class="card-content">
          <h5 class="card-title">Form Daftar Nasabah</h5>
          <form method="POST" action="/input/data/nasabah" style="padding-top: .75rem !important;">
            @if ($errors->has(0))
            <ul style="padding-bottom: .75rem;">
              <li style="color: red;">{{ $errors->first(0) }}</li>
            </ul>
            @endif
            @csrf
            <div class="input-field">
              <input id="name" name="name" type="text" class="@if($errors->has('name')) invalid @endif"
                placeholder="Masukkan Nama KTP">
              <label for="name" class="active">Nama KTP</label>
              @if($errors->has('name'))
              <span class="helper-text" data-error="{{ $errors->first('name') }}" data-success="right"></span>
              @endif
            </div>
            <div class="input-field">
              <input id="nik" name="nik" type="text" class="@if($errors->has('nik')) invalid @endif"
                placeholder="Masukkan NIK">
              <label for="nik" class="active">NIK</label>
              @if($errors->has('nik'))
              <span class="helper-text" data-error="{{ $errors->first('nik') }}" data-success="right"></span>
              @endif
            </div>
            <div class="box-button">
              <button type="submit" class="btn waves-effect waves-light primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection