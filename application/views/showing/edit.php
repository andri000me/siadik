<header class="page-header">
    <h2>Edit Survei Foto</h2>

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
            <li><span>Edit</span></li>
            <li><span><?= $kd_showing ?></span></li>
        </ol>
    </div>
</header>

<section class="panel" id="edit-container">
    <h1 class="text-center">Loading...</h1>
</section>

<script>
    $(function(){
        showingController.edit('<?= $this->session->userdata('level') ?>', '<?= $kd_showing ?>');
    })
</script>