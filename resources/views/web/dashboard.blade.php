@extends('layout.main')

@section('main-page')
<!-- ============================================================== -->
<!-- Container fluid scss in scafholding.scss -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col l3 m6 s12">
            <div class="card danger-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2 class="white-text m-b-5">{{ $totalNasabah }}</h2>
                            <h7 class="white-text op-5 light-blue-text">Data Nasabah</h7>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">account_circle</i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m6 s12">
            <div class="card info-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2 class="white-text m-b-5">{{ $totalTransaksi }}</h2>
                            <h6 class="white-text op-5">Riwayat Transaksi</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">receipt</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col l3 m6 s12">
            <div class="card success-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2 class="white-text m-b-5">{{ $totalPengajuan }}</h2>
                            <h6 class="white-text op-5 text-darken-2">Hasil Pengajuan</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col l3 m6 s12">
            <div class="card warning-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2 class="white-text m-b-5">{{ $totalBayar }}</h2>
                            <h8 class="white-text op-5">Pembayaran Selesai</h8>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">attach_money</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Transaksi Terkini</h5>
            <div class="table-responsive m-b-20">
                <table class="">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Nasabah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Sisa Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($nasabahs->isEmpty())
                        <tr>
                            <td>No data available</td>
                        </tr>
                        @else
                        @foreach($nasabahs as $item)
                        <tr>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->name_by_identity }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->borrow_date)->format('d-m-Y') }}</td>
                            <td>{{ 'Rp. ' . number_format($item->riwayat->remaining_payment, 0, '', '.') }}</td>
                            <td><span class="new badge {{ $item->result->is_approved ? 'green' : 'red' }}"
                                    data-badge-caption="">{{ $item->result->is_approved ? 'Approved' :
                                    'Rejected' }}</span></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection