<header class="page-header">
    <h2>Dashboard</h2>
</header>

<div class="row">
    <div class="col-md-12 col-lg-4 col-xl-4">
        <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-image"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Total Survei Foto</h4>
                            <div class="info">
                                <strong class="count_survei">0</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="#/survei_foto" class="text-muted text-uppercase">(view all)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <section class="panel panel-featured-left panel-featured-secondary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-secondary">
                            <i class="fa fa-bank"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Total Properti</h4>
                            <div class="info">
                                <strong class="count_properti">0</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="#/properti" class="text-muted text-uppercase">(view all)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <section class="panel panel-featured-left panel-featured-warning">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-warning">
                            <i class="fa fa-file"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Total Iklan</h4>
                            <div class="info">
                                <strong class="count_iklan">0</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="#/iklan" class="text-muted text-uppercase">(view all)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-tertiary">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Total Showing</h4>
                            <div class="info">
                                <strong class="count_showing">0</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="#/showing" class="text-muted text-uppercase">(view all)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <section class="panel panel-featured-left panel-featured-quartenary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-quartenary">
                            <i class="fa fa-dollar"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Total Deal</h4>
                            <div class="info">
                                <strong class="count_deal">0</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="#/deal" class="text-muted text-uppercase">(view all)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <section class="panel panel-featured-left panel-featured-info">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-info">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Total User</h4>
                            <div class="info">
                                <strong class="count_user">0</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="#/user" class="text-muted text-uppercase">(view all)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <h4>Surve Foto Chart</h4>
                <canvas id="surveiChart" height="200"></canvas>
            </div>
        </section>
    </div>
    <div class="col-md-6">
        <section class="panel panel-featured-left panel-featured-danger">
            <div class="panel-body">
                <h4>Properti Chart</h4>
                <canvas id="propertiChart" height="200"></canvas>
            </div>
        </section>
    </div>
    <div class="col-md-12">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <h4>Showing Calendar</h4>
                <div id="showing_calendar"></div>
            </div>
        </section>
    </div>
</div>

<script>
    $(function(){
        dashboardController.manager()
    })
</script>