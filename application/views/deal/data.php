<header class="page-header">
    <h2>Deal</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Deal</span></li>
        </ol>
    </div>
</header>

<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <div class="panel-body">
                <div class="small-chart pull-right">
                    <i class="fa fa-check fa-4x text-success"></i>
                </div>

                <div class="h4 text-weight-bold mb-none" id="count_deal">...</div>
                <p class="text-xs text-muted mb-none">Total Properti Terjual</p>
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
            <a href="#/deal/add" class="panel-action btn-add" style="display: none">
                <i class="fa fa-plus fa-2x"></i>
            </a>
        </div>

        <h2 class="panel-title">Data Deal</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="t_deal" style="width: 100%;">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Kode Properti</th>
                    <th>Tgl Deal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<script>
    $(function(){
        dealController.data('<?= $this->session->userdata('level') ?>');
    })
</script>