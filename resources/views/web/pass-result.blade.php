@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s4"><a class="active" href="#normalisasi">Ternormalisasi</a></li>
                    <li class="tab col s4"><a href="#hasil">Hasil SAW</a></li>
                </ul>
            </div>
            <div id="normalisasi">
                <table id="normalisasiDatatable" class="responsive-table display" style="width: 100%;">
                    <thead class="primary white-text">
                        <tr>
                            <th>No</th>
                            <th>Nama Nasabah</th>
                            <th>Usia</th>
                            <th>Status</th>
                            <th>Plafond</th>
                            <th>Lama Usaha</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="hasil">
                <table id="datatable" class="responsive-table display" style="width: 100%;">
                    <thead class="primary white-text">
                        <tr>
                            <th>No</th>
                            <th>Nama Nasabah</th>
                            <th>Usia</th>
                            <th>Status</th>
                            <th>Plafond</th>
                            <th>Lama Usaha</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
        "ajax": '/api/datatable/pass-result', 
        "pageLength": 25, 
    })

    $('#normalisasiDatatable').DataTable({
        "ajax": '/api/datatable/saw-result', 
        "pageLength": 25, 
    })

</script>
@endsection