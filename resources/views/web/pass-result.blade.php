@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Hasil Kelolosan</h5>
            <table id="datatable" class="responsive-table display">
                <thead class="primary white-text">
                    <tr>
                        <th>No</th>
                        <th>Nama Nasabah</th>
                        <th>Usia</th>
                        <th>Plafond</th>
                        <th>Status</th>
                        <th>Lama Usaha</th>
                        <th>Hasil</th>
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
        "ajax": '/api/datatable/pass-result', 
        "pageLength": 25, 
    })

</script>
@endsection