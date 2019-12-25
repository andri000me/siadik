<header class="page-header">
    <h2>Add Survei Foto</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <a href="#/survei_foto">
                    <span>Survei Foto</span>
                </a>
            </li>
            <li><span>Add</span></li>
        </ol>
    </div>
</header>

<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Form Survei Foto</h2>
    </header>
    <div class="panel-body">
        <form class="form-horizontal form-bordered" id="form_add" enctype="multipart/form-data">

            <div class="form-group">
                <label class="col-md-3 control-label" for="kd_properti">Properti</label>
                <div class="col-md-6">
                    <select name="kd_properti" id="kd_properti" class="form-control">
                        <option value="" disabled selected></option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="tgl_deal">Tanggal Deal</label>
                <div class="col-md-6">
                    <input type="text" id="tgl_deal" name="tgl_deal" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="pembayaran_klien">Pembayaran Klien</label>
                <div class="col-md-6">
                    <input type="file" id="pembayaran_klien" name="pembayaran_klien" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="pembayaran_pemilik">Pembayaran Pemilik</label>
                <div class="col-md-6">
                    <input type="file" id="pembayaran_pemilik" name="pembayaran_pemilik" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="form_komisi">Form Komisi</label>
                <div class="col-md-6">
                    <input type="file" id="form_komisi" name="form_komisi" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="form_perjanjian">Form Perjanjian</label>
                <div class="col-md-6">
                    <input type="file" id="form_perjanjian" name="form_perjanjian" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="form_listing">Form Listing</label>
                <div class="col-md-6">
                    <input type="file" id="form_listing" name="form_listing" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="keterangan">Keterangan</label>
                <div class="col-md-6">
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="form-group" style="padding-left: 15px; padding-right: 15px">
                <button type="submit" id="btn_submit" class="btn btn-block btn-md btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</section>

<script>
    $(function(){
        dealController.add('<?= $this->session->userdata('level') ?>');
    })
</script>