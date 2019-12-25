<header class="page-header">
    <h2>Survei Foto</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Survei Foto</span></li>
        </ol>
    </div>
</header>

<div class="row">
    <div class="col-md-4">
        <section class="panel">
            <div class="panel-body">
                <div class="small-chart pull-right">
                    <i class="fa fa-refresh fa-4x text-primary"></i>
                </div>

                <div class="h4 text-weight-bold mb-none" id="count_proses">...</div>
                <p class="text-xs text-muted mb-none">Total Survei Proses</p>
            </div>
        </section>
    </div>
    <div class="col-md-4">
        <section class="panel">
            <div class="panel-body">
                <div class="small-chart pull-right">
                    <i class="fa fa-check fa-4x text-success"></i>
                </div>

                <div class="h4 text-weight-bold mb-none" id="count_konfirmasi">...</div>
                <p class="text-xs text-muted mb-none">Total Survei Terkonfirmasi</p>
            </div>
        </section>
    </div>
    <div class="col-md-4">
        <section class="panel">
            <div class="panel-body">
                <div class="small-chart pull-right">
                    <i class="fa fa-times fa-4x text-danger"></i>
                </div>

                <div class="h4 text-weight-bold mb-none" id="count_tolak">...</div>
                <p class="text-xs text-muted mb-none">Total Survei Ditolak</p>
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
            <a href="#/survei_foto/add" class="panel-action btn-add" style="display: none">
                <i class="fa fa-plus fa-2x"></i>
            </a>
        </div>

        <h2 class="panel-title">Data Survei Foto</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="t_survei" style="width: 100%">
            <thead>
                <tr>
                    <th>Kode Foto</th>
                    <th>Agen</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<script>
    $(function(){
        surveiFotoController.data('<?= $this->session->userdata('level') ?>');
    })
</script>