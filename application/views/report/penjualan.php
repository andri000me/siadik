<header class="page-header">
    <h2>Laporan Penjualan</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Laporan Penjualan</span></li>
        </ol>
    </div>
</header>

<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Form Laporan</h2>
    </header>
    <div class="panel-body">
        <form id="form_report">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">-- Pilih Tahun --</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn btn-md btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="panel" id="report_container">
    <!-- REPORT CONTAINER -->
</section>

<script>
    $(function(){
        reportController.init()
    })
</script>

