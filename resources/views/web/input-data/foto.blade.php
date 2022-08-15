@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Form Ambil Foto</h5>
                    <form method="POST" action="/input/data/foto" enctype="multipart/form-data"
                        style="padding-top: .75rem !important;">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12 m12 l6">
                                <div class="file-field input-field" id="foto1">
                                    <div class="btn teal darken-1">
                                        <span>Foto</span>
                                        <input type="file" name="foto1" accept=".png,.jpeg,.jpg" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Foto Selfi" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s12 m12 l6">
                                <div class="file-field input-field" id="foto2">
                                    <div class="btn blue darken-1">
                                        <span>Foto</span>
                                        <input type="file" name="foto2" accept=".png,.jpeg,.jpg" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Foto KTP" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s12 m12 l6">
                                <div class="file-field input-field" id="foto3">
                                    <div class="btn purple darken-1">
                                        <span>Foto</span>
                                        <input type="file" name="foto3" accept=".png,.jpeg,.jpg" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Foto Tabungan" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s12 m12 l6">
                                <div class="file-field input-field" id="foto3">
                                    <div class="btn cyan darken-1">
                                        <span>Foto</span>
                                        <input type="file" name="foto4" accept=".png,.jpeg,.jpg" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Foto Selfi & Tabungan"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-button">
                            <button type="submit" class="btn waves-effect waves-light primary">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection