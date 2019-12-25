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
                <label class="col-md-3 control-label" for="alamat">Alamat</label>
                <div class="col-md-6">
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="foto_1">Foto 1</label>
                <div class="col-md-6">
                    <input type="file" id="foto_1" name="foto_1" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="foto_2">Foto 2</label>
                <div class="col-md-6">
                    <input type="file" id="foto_2" name="foto_2" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="foto_3">Foto 3</label>
                <div class="col-md-6">
                    <input type="file" id="foto_3" name="foto_3" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="foto_4">Foto 4</label>
                <div class="col-md-6">
                    <input type="file" id="foto_4" name="foto_4" class="foto">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="foto_5">Foto 5</label>
                <div class="col-md-6">
                    <input type="file" id="foto_5" name="foto_5" class="foto">
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
        surveiFotoController.add('<?= $this->session->userdata('level') ?>');
    })
</script>