<header class="page-header">
    <h2>Detail Deal</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <a href="#/deal">
                    <span>Deal</span>
                </a>
            </li>
            <li><span><?= $kd_booking ?></span></li>
        </ol>
    </div>
</header>

<section class="detail-container">
    <h1 class="text-center">Loading...</h1>
</section>

<script>
    $(function(){
        dealController.detail('<?= $this->session->userdata('level') ?>', '<?= $kd_booking ?>')
    })
</script>