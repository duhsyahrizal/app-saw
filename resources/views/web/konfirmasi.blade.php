@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Perhitungan Kemampuan Bayar</h5>
            <div class="row m-t-20">
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Pendapatan usaha (A)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->operating_revenue, 0, '', '.') }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Pembelian (B)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->business_fund, 0, '', '.') }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Margin Usaha (C) <br />
                        A - B
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format(($plafond->operating_revenue - $plafond->business_fund), 0, '', '.')
                        }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Pengeluaran Usaha (D)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->business_expense, 0, '', '.') }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Pendapatan Bersih Usaha (E) <br />
                        C - D
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->net_income, 0, '', '.') }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Pendapatan Lainnya (F)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->other_income, 0, '', '.') }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Pengeluaran Non Usaha (G)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->non_business_expense, 0, '', '.') }}
                    </div>
                </div>
                <div class="p-b-10">
                    <div class="col s12 m12 l6">
                        Total Angsuran (H)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ 'Rp. ' . number_format($plafond->total_installment, 0, '', '.') }}
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Sisa Penghasilan <br />
                        ((E + F) - G) - H
                    </div>
                    <div class="col s12 m12 l6">
                        {{ $plafondSisa }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Rekomendasi nilai angsuran (I)
                    </div>
                    <div class="col s12 m12 l6">
                        {{ $nilaiAngsuran }}
                    </div>
                </div>
                <div class="row p-b-10">
                    <div class="col s12 m12 l6">
                        Rekomendasi nilai pengajuan
                    </div>
                    <div class="col s12 m12 l6">
                        {{ $nilaiPengajuan }}
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col m12">
                    <form action="/konfirmasi/data" method="post" enctype="multipart/form-data">
                        @csrf
                        <label style="font-size: 18px !important; color: #676869;" for="pelatihan">Sudah Mengikuti
                            Pelatihan
                            ?</label>
                        <div class="row">
                            <div class="col s3 m2 l1">
                                <label>
                                    <input name="pelatihan" value="1" type="radio" required />
                                    <span>Ya</span>
                                </label>
                            </div>
                            <div class="col s3 m2 l1">
                                <label>
                                    <input name="pelatihan" value="0" type="radio" />
                                    <span>Tidak</span>
                                </label>
                            </div>
                        </div>
                        <div class="row d-none" id="fotoPelatihan">
                            <div class="input-field col s12 m12 l6">
                                <div class="file-field input-field" id="foto2">
                                    <div class="btn blue darken-1">
                                        <span>Foto Pelatihan</span>
                                        <input type="file" name="foto_pelatihan" accept=".png,.jpeg,.jpg" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Foto Pelatihan" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-button m-t-20">
                            <button type="submit" class="btn waves-effect waves-light primary">Confirmation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('[name="pelatihan"]').on('change', function() {
            let val = $(this).val()

            if(val == 1 || val == '1') {
                $('#fotoPelatihan').removeClass('d-none')
            } else {
                $('#fotoPelatihan').addClass('d-none')
            }
        })
</script>
@endsection