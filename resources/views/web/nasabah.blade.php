@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Daftar Nasabah</h5>
            <table id="datatable" class="responsive-table display" style="width: 100%;">
                <thead class="primary white-text">
                    <tr>
                        <th>Nama Nasabah</th>
                        <th>NIK</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating waves-effect waves-light btn-large primary">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        <li>
            <a class="btn-floating tooltipped blue" href="/input/data/nasabah" data-position="left" data-delay="50"
                data-tooltip="Input Nasabah"><i class="material-icons">group</i></a>
        </li>
        <li>
            <a class="btn-floating tooltipped purple" href="/input/data/informasi" data-position="left" data-delay="50"
                data-tooltip="Input Persyaratan"><i class="material-icons">assignment</i></a>
        </li>
    </ul>
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
        "ajax": '/api/datatable/nasabah', 
        "pageLength": 25, 
    })

</script>
@endsection