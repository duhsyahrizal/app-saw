@extends('layout.main')

@section('main-page')
<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h5 class="card-title">Form Data Informasi tambahan & Usaha</h5>
            <div class="row m-t-20">
                <div class="input-field col s12 m12 l6">
                    <label for="nama_usaha">Nama Usaha</label>
                    <input type="text" name="nama_usaha" placeholder="Nama Usaha" id="nama_usaha" required>
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="alamat_usaha">Alamat Lengkap Usaha</label>
                    <input type="text" name="alamat_usaha" placeholder="Alamat Usaha" id="alamat_usaha" required>
                </div>
                <div class="input-field col s12 m12 l6">
                    <select required>
                        <option value="" disabled selected>Pilih Lama Usaha</option>
                        <option value="1">Kurang dari 1 Tahun</option>
                        <option value="2">1 Tahun > 4 Tahun</option>
                        <option value="3">4 Tahun Keatas</option>
                    </select>
                </div>
                <div class="input-field col s12 m12 l6">
                    <div class="file-field input-field" id="foto1">
                        <div class="btn teal darken-1">
                            <span>Foto Usaha</span>
                            <input type="file" name="foto_usaha" accept=".png,.jpeg,.jpg" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="Foto Outlet/Saat Berusaha" type="text">
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l12 m-b-20">
                    <label for="pendapatan_usaha">Pendapatan Usaha</label>
                    <form action="#">
                        <p>
                            <label>
                                <input class="with-gap" name="group1" type="radio" />
                                <span>Kurang dari 1 Juta Rupiah</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="with-gap" name="group1" type="radio" />
                                <span>1 Juta Rupiah > 4 Juta Rupiah</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="with-gap" name="group1" type="radio" />
                                <span>Diatas 4 Juta Rupiah</span>
                            </label>
                        </p>
                    </form>
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="pembelian_usaha">Pembelian Usaha</label>
                    <input type="text" name="modal_dagang" placeholder="Modal Dagang (Dalam Rupiah)" id="rupiah"
                        required>
                </div>
                <div class="input-field col s12 m12 l6">
                    <label for="pengeluaran_usaha">Pengeluaran Usaha</label>
                    <input type="text" name="pengeluaran_usaha" placeholder="Biaya Tambahan dalam Usaha (Dalam Rupiah)"
                        id="rupiah" required>
                </div>
                <div class="box-button m-t-40">
                    <button type="submit" class="btn waves-effect waves-light primary right">Next</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e)
    {
        rupiah.value = formatRupiah(this.value, 'Rp. ');
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