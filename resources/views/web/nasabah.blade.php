@extends('layout.main')

@section('main-page')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Daftar Nasabah</h5>
                <table id="datatable" class="responsive-table display">
                    <thead class="primary white-text">
                        <tr>
                            <th>Name</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Age</th>
                            <th>Tanggal Pendaftaran</th>
                         </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="/template/dist/css/pages/data-table.css?v={{ time() }}" rel="stylesheet">
@endsection

@section('js')
    <script src="/template/assets/extra-libs/Datatables/datatables.min.js"></script>
    <script src="/template/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script>
        $('#datatable').DataTable({
            // "ajax": '/api/datatable/nasabah',
            "pageLength": 25,
        })
    </script>
@endsection
