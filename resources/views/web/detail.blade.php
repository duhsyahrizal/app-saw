@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Dokumen Nasabah - {{ $nasabah->name_by_identity }}</h5>
            <div class="row m-t-20">
                <div class="input-field col s12 m12 l6">
                    <label for="name">Nama Nasabah</label>
                    <input type="text" name="name" value="{{ $nasabah->name_by_identity }}" disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="nik">NIK</label>
                    <input type="text" name="nik" value="{{ $nasabah->nik }}" disabled="true">
                </div>
                @if($nasabah->information)
                <div class="input-field col s12 m12 l6">
                    <label for="address">Alamat sesuai KTP</label>
                    <input type="text" name="address" value="{{ $nasabah->information->address_by_identity }}"
                        id="address" disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="mdate">Tanggal Lahir</label>
                    <input type="text" name="birth_date" value="{{ $nasabah->information->birth_date }}"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="location">Tempat Lahir</label>
                    <input type="text" name="birth_location" value="{{ $nasabah->information->birth_location }}"
                        disabled="true">
                </div>
                <div class="col s12 m12 l6 m-b-20">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <input type="text" value="{{ $nasabah->information->gender ? 'Perempuan' : 'Laki-laki' }}"
                        disabled="true">
                </div>
                <div class="input-field col s6 m6 l3">
                    <label for="rt">RT</label>
                    <input type="text" name="rt" value="{{ $nasabah->information->rt }}" disabled="true">
                </div>
                <div class="input-field col s6 m6 l3">
                    <label for="rw">RW</label>
                    <input type="text" name="rw" value="{{ $nasabah->information->rw }}" disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="province">Provinsi</label>
                    <input type="text" name="province" value="{{ $nasabah->information->province }}" id="province"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="city">Kota/Kabupaten</label>
                    <input type="text" name="city" value="{{ $nasabah->information->district }}" id="city"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="district">Kecamatan</label>
                    <input type="text" name="district" value="{{ $nasabah->information->sub_district }}"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="ward">Kelurahan</label>
                    <input type="text" name="ward" value="{{ $nasabah->information->ward }}" disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="postal_code">Kode Pos</label>
                    <input type="text" name="postal_code" value="{{ $nasabah->information->postal_code }}"
                        id="postal_code" disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="ktp_status">Status KTP</label>
                    <input type="text" name="ktp_status"
                        value="{{ $nasabah->information->ktp_status ? 'Berlaku seumur hidup' : 'Belum dicetak (Resi)' }}"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="religion">Agama</label>
                    <input type="text" name="religion" value="{{ $nasabah->information->religion }}" id="religion"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="citizenship">Kewarganegaraan</label>
                    <input type="text" name="citizenship" value="{{ $nasabah->information->citizenship }}"
                        id="citizenship" disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="profession">Pekerjaan</label>
                    <input type="text" name="profession" value="{{ $nasabah->information->profession }}" id="profession"
                        disabled="true">
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="status">Status</label>
                    <input type="text" name="status"
                        value="{{ $nasabah->information->status == 0 ? 'Belum Menikah' : $nasabah->information->status == 1 ? 'Menikah' : 'Bercerai' }}"
                        disabled="true">
                </div>
                @endif
                <hr>
            </div>
            @if($nasabah->information)
            <h5 class="card-title m-t-30">Dokumen Foto</h5>
            <div class="row" style="text-align: center">
                <div class="col s12 m12 l6">
                    <label for="selfi" style="font-size: 20px">Foto Selfi</label>
                    <div class="card" style="padding: 0 15%;">
                        <div class="card-image">
                            <img src="{{ $nasabah->information->selfi_photo }}">
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l6">
                    <label for="ktp" style="font-size: 20px">Foto KTP</label>
                    <div class="card" style="padding: 0 15%;">
                        <div class="card-image">
                            <img src="{{ $nasabah->information->ktp_photo }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col s12 m12 l6">
                    <label for="savings" style="font-size: 20px">Foto Tabungan</label>
                    <div class="card" style="padding: 0 15%;">
                        <div class="card-image">
                            <img src="{{ $nasabah->information->savings_photo }}">
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l6">
                    <label for="face_with_ktp" style="font-size: 20px">Foto Selfi + KTP</label>
                    <div class="card" style="padding: 0 15%;">
                        <div class="card-image">
                            <img src="{{ $nasabah->information->face_with_ktp_photo }}">
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection