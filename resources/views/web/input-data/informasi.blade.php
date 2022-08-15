@extends('layout.main')

@section('main-page')
<div class="container-fluid">
  <div class="card">
    <div class="card-content">
      <h5 class="card-title">Form Input Persyaratan</h5>
      <form action="/input/data/informasi" method="POST">
        @csrf
        <div class="row m-t-20">
          <div class="input-field col s12 m12 l6">
            <select id="nasabah" name="nasabah_id">
              <option value="" disabled selected>Pilih Nasabah</option>
              @foreach($nasabah as $item)
              <option value="{{ $item->id }}">{{ $item->nik . ' - ' . $item->name_by_identity }}</option>
              @endforeach
            </select>
            <label for="nasabah">Pilih Nasabah</label>
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="address">Alamat sesuai KTP</label>
            <input type="text" name="address" placeholder="Masukkan Alamat" id="address">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="mdate">Tanggal Lahir</label>
            <input type="text" name="birth_date" placeholder="Pilih Tanggal Lahir" id="mdate">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="location">Tempat Lahir</label>
            <input type="text" name="birth_location" placeholder="Tempat Lahir" id="location">
          </div>
          <div class="input-field col s6 m6 l3">
            <label for="rt">RT</label>
            <input type="text" name="rt" placeholder="RT" id="rt">
          </div>
          <div class="input-field col s6 m6 l3">
            <label for="rw">RW</label>
            <input type="text" name="rw" placeholder="RW" id="rw">
          </div>
          <div class="col s12 m12 l12 m-b-20">
            <label for="gender">Jenis Kelamin</label>
            <div class="row m-t-20">
              <div class="col s6 m3 l2">
                <label>
                  <input name="gender" value="0" type="radio" />
                  <span>Laki laki</span>
                </label>
              </div>
              <div class="col s6 m3 l2">
                <label>
                  <input name="gender" value="1" type="radio" />
                  <span>Perempuan</span>
                </label>
              </div>
            </div>
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="province">Provinsi</label>
            <input type="text" name="province" placeholder="Provinsi" id="province">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="city">Kota/Kabupaten</label>
            <input type="text" name="city" placeholder="Kota/Kabupaten" id="city">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="district">Kecamatan</label>
            <input type="text" name="district" placeholder="Kecamatan" id="district">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="sub_district">Kelurahan</label>
            <input type="text" name="sub_district" placeholder="Kelurahan" id="sub_district">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="postal_code">Kode Pos</label>
            <input type="text" name="postal_code" placeholder="Kode Pos" id="postal_code">
          </div>
          <div class="col s12 m12 l12 m-b-20">
            <label for="ktp_status">Masa berlaku KTP</label>
            <div class="row m-t-20">
              <div class="col s6 m6 l3">
                <label>
                  <input name="ktp_status" value="1" type="radio" />
                  <span>KTP berlaku seumur hidup</span>
                </label>
              </div>
              <div class="col s6 m6 l3">
                <label>
                  <input name="ktp_status" value="0" type="radio" />
                  <span>KTP belum dicetak (Resi)</span>
                </label>
              </div>
            </div>
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="religion">Agama</label>
            <input type="text" name="religion" placeholder="Agama" id="religion">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="citizenship">Kewarganegaraan</label>
            <input type="text" name="citizenship" placeholder="Kewarganegaraan" id="citizenship">
          </div>
          <div class="input-field col s12 m12 l6">
            <label for="profession">Pekerjaan</label>
            <input type="text" name="profession" placeholder="Pekerjaan" id="profession">
          </div>
          <div class="col s12 m12 l12" style="margin-top: 0 !important;">
            <label for="status">Status Perkawinan</label>
            <div class="row">
              <div class="input-field col s4 m3 l2">
                <label>
                  <input name="status" value="menikah" type="radio" />
                  <span>Menikah</span>
                </label>
              </div>
              <div class="input-field col s4 m3 l2">
                <label>
                  <input name="status" value="bercerai" type="radio" />
                  <span>Bercerai</span>
                </label>
              </div>
              <div class="input-field col s4 m3 l3">
                <label>
                  <input name="status" value="belum menikah" type="radio" />
                  <span>Belum Menikah</span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="box-button m-t-40">
          <button type="submit" class="btn waves-effect waves-light primary right">Submit</button>
        </div>
      </form>
    </div>
  </div>
    <script src="../../assets/libs/pickadate/lib/compressed/picker.js"></script>
    <script src="../../assets/libs/pickadate/lib/compressed/picker.date.js"></script>
    <script src="../../assets/libs/pickadate/lib/compressed/picker.time.js"></script>
    <script src="../../assets/libs/pickadate/lib/compressed/legacy.js"></script>
    <script src="../../assets/libs/moment/moment.js"></script>
    <script src="../../assets/libs/daterangepicker/daterangepicker.js"></script>
    <script src="../../dist/js/pages/forms/datetimepicker/datetimepicker.init.js"></script>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css"
  href="/template/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
@endsection

@section('js')
<script src="/template/assets/libs/moment/moment.js"></script>
<script src="/template/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js">
</script>
<script>
  // MAterial Date picker    
  $(document).ready(function() {
    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
  })
</script>
@endsection