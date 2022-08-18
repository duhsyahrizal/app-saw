@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Hasil Penilaian</h5>
            <table id="datatable" class="responsive-table display" style="width: 100%;">
                <thead class="primary white-text">
                    <tr>
                        <th>Nama Nasabah</th>
                        <th>NIK</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th>Kelolosan</th>
                        <th>Nominal Pinjam</th>
                        <th>Sisa Pembayaran</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="fixed-action-btn">
    <button data-target="inputPembayaran"
        class="btn-floating btn-large waves-effect waves-light primary modal-trigger"><i
            class="material-icons">add</i></button>
</div>

<!-- Modal Structure -->
<div id="inputPembayaran" class="modal">
    <div class="modal-content">
        <h4>Input Pembayaran Nasabah</h4>
        <div class="row m-t-30">
            <div class="input-field col s12 m12 l6">
                <select id="nasabah_id" name="nasabah_id" required>
                    <option value="" disabled selected>Pilih Nasabah</option>
                    @foreach($nasabahs as $item)
                    <option value="{{ $item->id }}">{{ $item->nik . ' - ' . $item->name_by_identity }}</option>
                    @endforeach
                </select>
                <label for="nasabah_id">Pilih Nasabah</label>
            </div>
            <div class="input-field col s12 m12 l6">
                <label for="nominal_bayar">Nominal Pembayaran</label>
                <input type="text" name="nominal_bayar" placeholder="Masukkan Nominal Pembayaran" id="nominal_bayar"
                    required>
            </div>
            <div class="box-button col s12 m12 l12">

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button onclick="inputPembayaran()" class="btn waves-effect waves-light primary">Submit</button> <a href="#!"
            class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
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
        "ajax": '/api/datatable/result', 
        "pageLength": 25, 
    })

    var pembayaran = document.getElementById('nominal_bayar');

    pembayaran.addEventListener('keyup', function(e)
    {
        pembayaran.value = formatRupiah(this.value, 'Rp. ');
    });

    // trigger api input pembayaran nasabah
    function inputPembayaran() 
    {
        var nominal_bayar   = $('#nominal_bayar').val()
        var nasabah_id      = $('#nasabah_id').val()

        if(nasabah_id === null) {
            alert('Tolong pilih nasabah terlebih dahulu!')
        }
        
        if(nominal_bayar == '') {
            alert('Tolong isi nominal pembayaran!')
        }

        var nominal_pembayaran = nominal_bayar.split('Rp. ')[1].split('.').join('')

        if(nominal_pembayaran < 100000) {
            alert('Tolong isi nominal pembayaran lebih dari Rp. 100.000')
        }

        var requestData = '?nasabah_id='+nasabah_id+'&nominal_bayar='+nominal_pembayaran

        $.get('/api/nasabah/input/pembayaran'+requestData, function(data) {
            if(data.success) swal(data.message, "", "success")
            else swal(data.message, "", "error")

            setTimeout(() => {
                location.reload()
            }, 1500);
        })
    }

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>
@endsection