<header class="page-header">
    <h2>Add Showing</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <a href="#/showing">
                    <span>Showing</span>
                </a>
            </li>
            <li><span>Add</span></li>
        </ol>
    </div>
</header>

<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Form Showing</h2>
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
                <label class="col-md-3 control-label" for="agen">Agen</label>
                <div class="col-md-6">
                    <select name="agen" id="agen" class="form-control">
                        <option value="" disabled selected></option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="nama_klien">Nama Klien</label>
                <div class="col-md-6">
                    <input type="text" id="nama_klien" name="nama_klien" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="tlp_klien">Telepon</label>
                <div class="col-md-6">
                    <input type="number" id="tlp_klien" name="tlp_klien" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="tgl_showing">Tanggal</label>
                <div class="col-md-6">
                    <input type="text" id="tgl_showing" name="tgl_showing" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="jam_showing">Jam</label>
                <div class="col-md-6">
                     <input type="text" id="jam_showing" name="jam_showing" class="form-control">
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
        showingController.add('<?= $this->session->userdata('level') ?>');
    })
</script>