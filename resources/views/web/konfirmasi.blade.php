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
            <form action="/konfirmasi/data" method="post">
                @csrf
                <div class="box-button m-t-40">
                    <button type="submit" class="btn waves-effect waves-light primary">Confirmation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection