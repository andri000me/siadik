<header class="page-header">
    <h2>Detail Showing</h2>

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
            <li><span><?= $kd_showing ?></span></li>
        </ol>
    </div>
</header>

<section class="detail-container">
    <h1 class="text-center">Loading...</h1>
</section>

<script>
    $(function(){
        showingController.detail('<?= $this->session->userdata('level') ?>', '<?= $kd_showing ?>')
    })
</script>