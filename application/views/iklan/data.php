
    <header class="page-header">
        <h2>Iklan</h2>

        <div class="right-wrapper pull-right" style="margin-right: 15px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="#/dashboard">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Iklan</span></li>
            </ol>
        </div>
    </header>

    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <div class="panel-body">
                    <div class="small-chart pull-right">
                        <i class="fa fa-check fa-4x text-success"></i>
                    </div>

                    <div class="h4 text-weight-bold mb-none" id="count_iklan">...</div>
                    <p class="text-xs text-muted mb-none">Total Iklan Diposting</p>
                </div>
            </section>
        </div>
    </div>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="javascript:void(0);" class="panel-action btn-reload" style="margin-right: 10px;">
                    <i class="fa fa-refresh fa-2x"></i>
                </a>
            </div>

            <h2 class="panel-title">Data Iklan</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="t_iklan" style="width: 100%">
                <thead>
                    <tr>
                        <th>Kode Iklan</th>
                        <th>Kode Properti</th>
                        <th>Advertising</th>
                        <th>Kode Lainnya</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>

    <form class="form-edit">
        <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Keterangan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kd_lainnya">Kode Iklan Lainnya</label>
                            <input type="text" id="edit_kd_lainnya" name="kd_lainnya" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea type="text" id="keterangan" name="keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kd_iklan" id="edit_kd_iklan">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form class="form-delete">
        <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Iklan</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Apakah anda yakin ingin menghapus <b><i id="delete_name"></i></b> ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kd_hos" id="delete_id">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(function(){
            iklanController.init();
        })
    </script>