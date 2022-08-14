@extends('layout.main')

@section('main-page')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Riwayat Transaksi</h5>
                <table id="datatable" class="responsive-table display">
                    <thead class="primary white-text">
                        <tr>
                            <th>Nama Nasabah</th>
                            <th>NIK</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="/template/dist/css/pages/data-table.css?v={{ time() }}" rel="stylesheet">
@endsection

@section('js')
    <script src="/template/dist/js/plugins/DataTables/datatables.min.js"></script>
    <script src="/template/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script>
        $('#datatable').DataTable({
            "ajax": '/api/datatable/riwayat',
            "pageLength": 25,
        })
    </script>
@endsection
