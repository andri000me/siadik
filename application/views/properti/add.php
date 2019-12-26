<header class="page-header">
    <h2>Add Properti</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            
            <?php 
                if(isset($kd_foto)){
                    echo '
                        <li>
                            <a href="#/survei_foto/'.$kd_foto.'">
                                <span>Survei Foto</span>
                            </a>
                        </li>
                        <li><span>Confirm</span></li>
                        <li><span>'.$kd_foto.'</span></li>
                    ';
                } else {
                    echo '
                        <li>
                            <a href="#/properti">
                                <span>Properti</span>
                            </a>
                        </li>
                        <li><span>Add</span></li>
                    ';
                }
            ?>
        </ol>
    </div>
</header>

<section class="panel" id="w1">
    <header class="panel-heading">
        <h2 class="panel-title">Form Properti</h2>
    </header>
    <div class="panel-body panel-body-nopadding">
        <div class="wizard-tabs">
            <ul class="wizard-steps">
                <li class="active">
                    <a href="#w1-survei-foto" data-toggle="tab" class="text-center">
                        <span class="badge hidden-xs">1</span>
                        Survei Foto
                    </a>
                </li>
                <li>
                    <a href="#w1-pemilik" data-toggle="tab" class="text-center">
                        <span class="badge hidden-xs">2</span>
                        Pemilik
                    </a>
                </li>
                <li>
                    <a href="#w1-properti" data-toggle="tab" class="text-center">
                        <span class="badge hidden-xs">3</span>
                        Properti
                    </a>
                </li>
                <li>
                    <a href="#w1-harga" data-toggle="tab" class="text-center">
                        <span class="badge hidden-xs">4</span>
                        Harga
                    </a>
                </li>
            </ul>
        </div>
        <form class="form-horizontal" id="form_add" novalidate="novalidate">
            <div class="tab-content">

                <div id="w1-survei-foto" class="tab-pane active">
                    <h2 class="text-center">Loading...</h2>
                </div>

                <div id="w1-pemilik" class="tab-pane">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-nama_pemilik">Nama Pemilik</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="nama_pemilik" id="w1-nama_pemilik" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-alamat_pemilik">Alamat Pemilik</label>
                        <div class="col-sm-10">
                            <textarea class="form-control input-sm" name="alamat_pemilik" id="w1-alamat_pemilik" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-telp">Telepon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" name="telp" id="w1-telp" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="w1-fax">Fax</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control input-sm" name="fax" id="w1-fax">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-email">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="email" id="w1-email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-pic">Sebagai</label>
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="pic" id="w1-pic" required>
                                <option value="" disabled selected></option>
                                <option value="Pemilik">Pemilik</option>
                                <option value="Kuasa Pemilik">Kuasa Pemilik</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="w1-properti" class="tab-pane">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-status">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="status" id="w1-status" required>
                                <option value="" disabled selected></option>
                                <option value="Jual">Jual</option>
                                <option value="Sewa">Sewa</option>
                                <option value="Jual & Sewa">Jual & Sewa</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-kondisi">Kondisi</label>
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="kondisi" id="w1-kondisi" required>
                                <option value="" disabled selected></option>
                                <option value="Baru">Baru</option>
                                <option value="Second">Second</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-jenis">Jenis</label>
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="jenis" id="w1-jenis" required>
                                <option value="" disabled selected></option>
                                <option value="Tanah">Tanah</option>
                                <option value="Rumah">Rumah</option>
                                <option value="Ruko">Ruko</option>
                                <option value="Apartemen">Apartemen</option>
                                <option value="Ruang Usaha">Ruang Usaha</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-alamat_properti">Alamat Properti</label>
                        <div class="col-sm-10">
                            <textarea class="form-control input-sm" name="alamat_properti" id="w1-alamat_properti" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-luas_tanah">Luas Tanah</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" name="luas_tanah" id="w1-luas_tanah">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-luas_bangunan">Luas Bangunan</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" name="luas_bangunan" id="w1-luas_bangunan">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-panjang">Panjang</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" name="panjang" id="w1-panjang">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-lebar">Lebar</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" name="lebar" id="w1-lebar">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-sertifikat">Sertifikat</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" name="sertifikat" id="w1-sertifikat">
                                        <option value="" disabled selected></option>
                                        <option value="hs">HS</option>
                                        <option value="shm">SHM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-imb">IMB</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" name="imb" id="w1-imb">
                                        <option value="" disabled selected></option>
                                        <option value="Y">Ada</option>
                                        <option value="T">Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-orientasi">Orientasi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="orientasi" id="w1-orientasi">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-kamar">Kamar</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" name="kamar" id="w1-kamar">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-listrik">Listrik</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="listrik" id="w1-listrik">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-air">Air</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" name="air" id="w1-air">
                                        <option value="" disabled selected></option>
                                        <option value="PAM">PAM</option>
                                        <option value="Sumur">Sumur</option>
                                        <option value="Jetpum">Jetpum</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-lantai">Lantai</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="lantai" id="w1-lantai">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-kamar_mandi">Kamar Mandi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="kamar_mandi" id="w1-kamar_mandi">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-jenis_lantai">Jenis Lantai</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="jenis_lantai" id="w1-jenis_lantai">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-garasi">Garasi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="garasi" id="w1-garasi">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-line-telepon">Line Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="line-telepon" id="w1-line-telepon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-tahun">Tahun</label>
                                <div class="col-sm-8">
                                    <input type="year" class="form-control input-sm" name="tahun" id="w1-tahun">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-fully_furnish">Fully Furnish</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="fully_furnish" id="w1-fully_furnish"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="w1-semi_furnish">Semi Furnish</label>
                                <textarea class="col-sm-8">
                                    <textarea class="form-control" name="semi_furnish" id="w1-semi_furnish"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="w1-harga" class="tab-pane">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-harga_penawaran">Harga Penawaran</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control input-sm" name="harga_penawaran" id="w1-harga_penawaran" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-komisi">Komisi</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control input-sm" name="komisi" id="w1-komisi" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="w1-keterangan">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control input-sm" name="keterangan" id="w1-keterangan" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="checkbox-custom" style="float: right">
                                <input type="checkbox" name="terms" id="w1-terms" required>
                                <label for="w1-terms">Pemilik sudah menyetujui semua persyaratan dari PINRUMAH</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <ul class="pager">
            <li class="previous disabled">
                <a><i class="fa fa-angle-left"></i> Previous</a>
            </li>
            <li class="finish hidden pull-right">
                <a>Finish</a>
            </li>
            <li class="next">
                <a>Next <i class="fa fa-angle-right"></i></a>
            </li>
        </ul>
    </div>
</section>
    


<script>
    $(function(){
        propertiController.add('<?= $this->session->userdata('level') ?>', '<?= isset($kd_foto) ? $kd_foto : '' ?>');
    })
</script>