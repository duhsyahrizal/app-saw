@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Form Data Informasi tambahan & Usaha</h5>
            <form action="/input/data/usaha" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row m-t-20">
                    <div class="input-field col s12 m12 l6">
                        <label for="nama_usaha">Nama Usaha</label>
                        <input type="text" name="business_name" placeholder="Nama Usaha" id="nama_usaha" required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="alamat_usaha">Alamat Lengkap Usaha</label>
                        <input type="text" name="business_address" placeholder="Alamat Usaha" id="alamat_usaha"
                            required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <select id="lama_usaha" name="business_age" required>
                            <option value="" disabled selected>Pilih Lama Usaha</option>
                            <option value="1">Kurang dari 1 Tahun</option>
                            <option value="2">1 Tahun sampai 4 Tahun</option>
                            <option value="3">4 Tahun Keatas</option>
                        </select>
                        <label for="lama_usaha">Lama Usaha</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="pendapatan_usaha">Pendapatan Usaha (per bulan)</label>
                        <input type="text" name="operating_revenue" placeholder="Pendapatan Usaha" id="pendapatan_usaha"
                            required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="pembelian_usaha">Pembelian Usaha (per bulan)</label>
                        <input type="text" name="business_fund" placeholder="Modal Dagang (Dalam Rupiah)" id="pembelian"
                            required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="pengeluaran_usaha">Pengeluaran Usaha (per bulan)</label>
                        <input type="text" name="business_expense"
                            placeholder="Biaya Tambahan dalam Usaha (Dalam Rupiah)" id="pengeluaran" required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="pendapatan_lainnya">Pendapatan lainnya (per bulan)</label>
                        <input type="text" name="other_income" placeholder="Pendapatan Lainnya (Dalam Rupiah)"
                            id="pendapatan_lainnya" required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="pengeluaran_non_usaha">Pengeluaran Non Usaha (per bulan)</label>
                        <input type="text" name="non_business_expense"
                            placeholder="Pengeluaran Non Usaha (Dalam Rupiah)" id="pengeluaran_non_usaha" required>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <label for="total_angsuran">Total Angsuran (per bulan)</label>
                        <input type="text" name="total_installment" placeholder="Total Angsuran Lainnya (Dalam Rupiah)"
                            id="total_angsuran" required>
                    </div>
                    <div class="input-field col s12 m12 l8">
                        <div class="file-field input-field" id="foto1">
                            <div class="btn teal darken-1">
                                <span>Foto Usaha</span>
                                <input type="file" name="business_photo" accept=".png,.jpeg,.jpg" required>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" placeholder="Foto Outlet/Saat Berusaha" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="box-button m-t-40">
                        <button type="submit" class="btn waves-effect waves-light primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var pembelian           = document.getElementById('pembelian');
    var pengeluaran         = document.getElementById('pengeluaran');
    var pengeluaran_lainnya = document.getElementById('pengeluaran_non_usaha');
    var pendapatan_usaha    = document.getElementById('pendapatan_usaha');
    var pendapatan_lainnya  = document.getElementById('pendapatan_lainnya');
    var total_angsuran      = document.getElementById('total_angsuran');

    pembelian.addEventListener('keyup', function(e)
    {
        pembelian.value = formatRupiah(this.value, 'Rp. ');
    });

    pengeluaran.addEventListener('keyup', function(e)
    {
        pengeluaran.value = formatRupiah(this.value, 'Rp. ');
    });

    pendapatan_usaha.addEventListener('keyup', function(e)
    {
        pendapatan_usaha.value = formatRupiah(this.value, 'Rp. ');
    });

    pendapatan_lainnya.addEventListener('keyup', function(e)
    {
        pendapatan_lainnya.value = formatRupiah(this.value, 'Rp. ');
    });

    total_angsuran.addEventListener('keyup', function(e)
    {
        total_angsuran.value = formatRupiah(this.value, 'Rp. ');
    });

    pengeluaran_lainnya.addEventListener('keyup', function(e)
    {
        pengeluaran_lainnya.value = formatRupiah(this.value, 'Rp. ');
    });
    
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