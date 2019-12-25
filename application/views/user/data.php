<header class="page-header">
    <h2>User</h2>

    <div class="right-wrapper pull-right" style="margin-right: 15px;">
        <ol class="breadcrumbs">
            <li>
                <a href="#/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>User</span></li>
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

                <div class="h4 text-weight-bold mb-none" id="count_active">...</div>
                <p class="text-xs text-muted mb-none">Total User Aktif</p>
            </div>
        </section>
    </div>
    <div class="col-md-6">
        <section class="panel">
            <div class="panel-body">
                <div class="small-chart pull-right">
                    <i class="fa fa-times fa-4x text-danger"></i>
                </div>

                <div class="h4 text-weight-bold mb-none" id="count_inactive">...</div>
                <p class="text-xs text-muted mb-none">Total User Tidak Aktif</p>
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
            <a href="javascript:void(0);" class="panel-action btn-add">
                <i class="fa fa-plus fa-2x"></i>
            </a>
        </div>

        <h2 class="panel-title">Data User</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="t_user" style="width: 100%">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<form class="form-add">
    <div class="modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="add_nama_lengkap" name="nama_lengkap" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="add_username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="number" id="add_telepon" name="telepon" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aktif">Status</label>
                                <select id="add_aktif" name="aktif" class="form-control">
                                    <option value="" selected disabled></option>
                                    <option value="Y">Aktif</option>
                                    <option value="T">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select id="add_level" name="level" class="form-control">
                                    <option value="" selected disabled></option>
                                    <option value="Agen">Agen</option>
                                    <option value="Advertising">Advertising</option>
                                    <option value="CS">Customer Service</option>
                                    <option value="Telemarketing">Telemarketing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form class="form-edit">
    <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="edit_nama_lengkap" name="nama_lengkap" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="edit_username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="number" id="edit_telepon" name="telepon" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aktif">Status</label>
                                <select id="edit_aktif" name="aktif" class="form-control">
                                    <option value="" selected disabled></option>
                                    <option value="Y">Aktif</option>
                                    <option value="T">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select id="edit_level" name="level" class="form-control">
                                    <option value="" selected disabled></option>
                                    <option value="Agen">Agen</option>
                                    <option value="Advertising">Advertising</option>
                                    <option value="Cs">Customer Service</option>
                                    <option value="Telemarketing">Telemarketing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_user" id="edit_id_user">
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
                    <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                </div>
                <div class="modal-body">
                    <h5>Apakah anda yakin ingin menghapus <b><i id="delete_name"></i></b> ?</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_user" id="delete_id">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(function(){
        userController.init();
    })
</script>