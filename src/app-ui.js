const mainUI = (() => {
    return {
        renderProfile: data => {
            let html = `
                <div class="row">
                    <div class="col-md-4">
                        <div class="thumb-info mb-md">
                            <img src="${BASE_URL}assets/images/user-default.jpg" class="rounded img-responsive" alt="John Doe">
                            <div class="thumb-info-title">
                                <span class="thumb-info-inner">${data.nama_lengkap}</span>
                                <span class="thumb-info-type">${data.level}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="simple-user-list text-right">
                            <li>
                                <span class="title">Nama</span>
                                <span class="message truncate">${data.nama_lengkap}</span>
                            </li>
                            <li>
                                <span class="title">Telepon</span>
                                <span class="message truncate">${data.telepon}</span>
                            </li>
                            <li>
                                <span class="title">Status</span>
                                ${data.aktif === 'Y' ? '<span class="label label-primary">Aktif</span>' : '<span class="label label-danger">Tidak Aktif</span>'}
                            </li>
                            <li>
                                <span class="title">Tanggal Terdaftar</span>
                                <span class="message truncate">${data.timestamps.created_at}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            `

            $('#profile_container').html(html)
        }
    }
})()

const surveiFotoUI = (() => {

    const renderAction = (data, level) => {
        let action;

        switch(level){
            case 'Agen':
                if(data.status !== 'Proses'){
                    action = `<h5 class="text-center">Tidak tersedia</h5>`
                } else {
                    action = `
                        <a class="btn btn-md btn-block btn-success" href="#/survei_foto/edit/${data.kd_foto}">Edit</a>
                        <button class="btn btn-md btn-block btn-danger" id="btn_delete" data-placement="bottom" data-id="${data.kd_foto}">Hapus</button>
                    `
                }
            break;

            case 'Telemarketing':
                if(data.status !== 'Proses'){
                    action = `<h5 class="text-center">Tidak tersedia</h5>`
                } else {
                    action = `
                        <a class="btn btn-md btn-block btn-primary" href="#/survei_foto/confirm/${data.kd_foto}" data-status="Konfirmasi">Konfirmasi</a>
                        <button class="btn btn-md btn-block btn-danger" id="btn_tolak" data-id="${data.kd_foto}" data-placement="bottom" data-status="Tolak">Ditolak</button>
                    `
                }
            break;

            default: 
                action = `<h5 class="text-center">Tidak tersedia</h5>`
        }

        return action;
    }
    
    const renderProperti = data => {
        let properti = '';

        if(data !== null){
            properti = `
                <section class="panel">
                    <header class="panel-heading panel-heading-transparent">
                        <h2 class="panel-title">Properti</h2>
                    </header>
                    <div class="panel-body">
                        <div class="text-center">
                            <h4 class="text-primary">${data.kd_properti}</h4>
                            <a href="#/properti/${data.kd_properti}" class="btn btn-block btn-md btn-primary">Klik untuk lihat</a>
                        </div>
                    </div>
                </section>
            `
        }

        return properti
    }

    return {
        renderDetail: (data, level, callback) => {
            let html = `
               <div class="row">
                    <div class="col-md-8">
                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#detail" data-toggle="tab">Detail</a>
                                </li>
                                <li>
                                    <a href="#foto" data-toggle="tab">Foto</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="detail" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="simple-user-list mb-xlg" style="margin-top: 5%; margin-left: 5%;">
                                                <li>
                                                    <span class="title">Kode Foto</span>
                                                    <span class="message">${data.kd_foto}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Alamat</span>
                                                    <span class="message">${data.alamat}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Status</span>
                                                    <span class="label label-primary">${data.status}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Keterangan</span>
                                                    <span class="message">${data.keterangan}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="simple-user-list mb-xlg" style="margin-top: 5%; margin-left: 5%;">
                                                <li>
                                                    <span class="title">Dibuat oleh</span>
                                                    <span class="message">${data.agen.nama_lengkap} - ${data.agen.telepon}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Dibuat pada</span>
                                                    <span class="message">${data.timestamps.created_at}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Terakhir Update</span>
                                                    <span class="message">${data.timestamps.updated_at}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="foto" class="tab-pane">
                                    <div class="timeline timeline-simple mt-xlg mb-md">
										<div class="tm-body">
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 1
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.foto_1}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.foto_1}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 2
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.foto_2}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.foto_2}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 3
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.foto_3}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.foto_3}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 4
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.foto_4}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.foto_4}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 5
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.foto_5}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.foto_5}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
										</div>
									</div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Action</h2>
                            </header>
                            <div class="panel-body">
                                ${renderAction(data, level)}
                            </div>
                        </section>

                        ${renderProperti(data.properti)}
                    </div>
               </div> 
            `

            $('.detail-container').html(html)

            callback()
        },

        renderFormEdit: (data, callback) => {
            let html = `
                <header class="panel-heading">
                    <h2 class="panel-title">Form Survei Foto</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" id="form_edit" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="alamat">Alamat</label>
                            <div class="col-md-6">
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10">${data.alamat}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="foto_1">Foto 1</label>
                            <div class="col-md-6">
                                <input type="file" id="foto_1" name="foto_1" class="foto" data-default-file="${data.foto_1}" data-allowed-file-extensions="jpg png jpeg">
                                <input type="hidden" id="foto_1_desc" name="foto_1_desc" value="${data.foto_1.substr(47)}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="foto_2">Foto 2</label>
                            <div class="col-md-6">
                                <input type="file" id="foto_2" name="foto_2" class="foto" data-default-file="${data.foto_2}" data-allowed-file-extensions="jpg png jpeg">
                                <input type="hidden" id="foto_2_desc" name="foto_2_desc" value="${data.foto_2.substr(47)}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="foto_3">Foto 3</label>
                            <div class="col-md-6">
                                <input type="file" id="foto_3" name="foto_3" class="foto" data-default-file="${data.foto_3}" data-allowed-file-extensions="jpg png jpeg">
                                <input type="hidden" id="foto_3_desc" name="foto_3_desc" value="${data.foto_3.substr(47)}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="foto_4">Foto 4</label>
                            <div class="col-md-6">
                                <input type="file" id="foto_4" name="foto_4" class="foto" data-default-file="${data.foto_4}" data-allowed-file-extensions="jpg png jpeg">
                                <input type="hidden" id="foto_4_desc" name="foto_4_desc" value="${data.foto_4.substr(47)}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="foto_5">Foto 5</label>
                            <div class="col-md-6">
                                <input type="file" id="foto_5" name="foto_5" class="foto" data-default-file="${data.foto_5}" data-allowed-file-extensions="jpg png jpeg">
                                <input type="hidden" id="foto_5_desc" name="foto_5_desc" value="${data.foto_5.substr(47)}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="keterangan">Keterangan</label>
                            <div class="col-md-6">
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">${data.keterangan}</textarea>
                            </div>
                        </div>

                        <div class="form-group" style="padding-left: 15px; padding-right: 15px">
                            <input type="hidden" id="kd_foto" name="kd_foto" value="${data.kd_foto}">
                            <button type="submit" id="btn_submit" class="btn btn-block btn-md btn-success">Simpan Perubahan</button>
                        </div>

                    </form>
                </div>
            `

            $('#edit-container').html(html)
            callback()
        },
        renderError: err => {
            let html = `<h1 class="text-center">${err.error}</h1>`

            $('#edit-container, .detail-container').html(html);
        }
    }
})()

const propertiUI = (() => {
    const renderAction = (data, level) => {
        let action;

        switch (level) {
            case 'Telemarketing':
                if (data.iklan !== null) {
                    action = `<button class="btn btn-md btn-block btn-primary" id="btn_print">Print</button>`
                } else {
                    action = `
                        <a class="btn btn-md btn-block btn-success" href="#/properti/edit/${data.kd_properti}">Edit</a>
                        <button class="btn btn-md btn-block btn-primary" id="btn_print">Print</button>
                        <button class="btn btn-md btn-block btn-danger" id="btn_delete" data-placement="bottom" data-id="${data.kd_properti}">Hapus</button>
                    `
                }
                break;

            case 'Advertising':
                if (data.iklan !== null) {
                    action = `<button class="btn btn-md btn-block btn-primary" id="btn_print">Print</button>`
                } else {
                    action = `
                        <form id="form_iklan">
                            <div class="form-group">
                                <label for="kd_iklan">Kode Iklan PINRUMAH</label>
                                <input type="text" class="form-control" id="kd_iklan" name="kd_iklan">
                            </div>
                            <div class="form-group">
                                <label for="kd_iklan">Kode Iklan Lainnya</label>
                                <input type="text" class="form-control" id="kd_lainnya" name="kd_lainnya">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="kd_properti" name="kd_properti" value="${data.kd_properti}">
                                <button class="btn btn-md btn-block btn-primary" id="btn_iklan">Posting Sebagai Iklan</button>
                            </div>
                        </form>
                    `
                }
                break;

            default:
                action = `<button class="btn btn-md btn-block btn-primary" id="btn_print">Print</button>`
        }

        return action;
    }

    const renderIklan = data => {
        let properti = '';

        if (data.iklan !== null) {
            properti = `
                <section class="panel">
                    <header class="panel-heading panel-heading-transparent">
                        <h2 class="panel-title">Kode Iklan</h2>
                    </header>
                    <div class="panel-body">
                        <div class="text-center">
                            <h4 class="text-primary">${data.iklan.kd_iklan}</h4>
                        </div>
                    </div>
                </section>
            `
        }

        return properti
    }

    return {
        renderSurveiFoto: data => {
            let html = `
                <div class="thumbnail-gallery">
                    <a class="img-thumbnail" href="${data.foto_1}" style="width: 18%">
                        <img width="100%" src="${data.foto_1}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_2}" style="width: 18%">
                        <img width="100%" src="${data.foto_2}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_3}" style="width: 18%">
                        <img width="100%" src="${data.foto_3}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_4}" style="width: 18%">
                        <img width="100%" src="${data.foto_4}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_5}" style="width: 18%">
                        <img width="100%" src="${data.foto_5}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <div class="col-sm-12">
                        <div class="checkbox-custom" style="float: right">
                            <input type="checkbox" name="kd_foto" id="w1-kd_foto" required="" value="${data.kd_foto}">
                            <label for="w1-kd_foto">Gunakan Kode Foto ini? <b>${data.kd_foto}</b></label>
                        </div>
                    </div>
                </div>
            `

            $('#w1-survei-foto').html(html);
        },

        renderSelectSurvei: () => {
            let html = `
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="w1-kd_foto">Pilih Kode Foto</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kd_foto" id="w1-kd_foto" required>
                            <option value="" disabled selected></option>
                        </select>
                    </div>
                </div>

                <div class="selected-container">
                    <div class="panel">
                        <div class="panel-body">
                            <h4 class="text-center">Silahkan pilih Kode Foto</h4>
                        </div>
                    </div>
                </div>
            `

            $('#w1-survei-foto').html(html);
        },

        renderSelectedSurvei: data => {
            let html = `
                <div class="thumbnail-gallery">
                    <a class="img-thumbnail" href="${data.foto_1}" style="width: 18%">
                        <img width="100%" src="${data.foto_1}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_2}" style="width: 18%">
                        <img width="100%" src="${data.foto_2}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_3}" style="width: 18%">
                        <img width="100%" src="${data.foto_3}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_4}" style="width: 18%">
                        <img width="100%" src="${data.foto_4}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                    <a class="img-thumbnail" href="${data.foto_5}" style="width: 18%">
                        <img width="100%" src="${data.foto_5}">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                </div>
            `

            $('.selected-container').html(html)
        },

        renderSurveiError: err => {
            let html = `<h1 class="text-center">${err.error}</h1>`

            $('#w1').html(html);
        },

        renderDetail: (data, level, callback) => {
            let html = `
               <div class="row">
                    <div class="col-md-8">
                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#detail" data-toggle="tab">Open Listing Agreement</a>
                                </li>
                                <li>
                                    <a href="#foto" data-toggle="tab">Foto</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="detail" class="tab-pane active">

                                    <div class="invoice">
                                        <header class="clearfix">
                                            <div class="row">
                                                <div class="col-sm-6 mt-md">
                                                    <h4 class="h4 mt-none mb-sm text-dark text-weight-bold">Kode Properti</h4>
                                                    <h4 class="h4 m-none text-dark text-weight-bold">${data.kd_properti}</h4>
                                                </div>
                                                <div class="col-sm-6 text-right mt-md mb-md">
                                                    <address class="ib mr-xlg">
                                                        Agen : ${data.survei_foto.agen.nama_lengkap}
                                                        <br>
                                                        Telemarketing : ${data.telemarketing.nama_lengkap}
                                                        <br>
                                                        Advertising : ${data.iklan !== null ? `${data.iklan.advertising.nama_lengkap}` : ''}
                                                    </address>
                                                    <div class="ib">
                                                        <img src="${BASE_URL}assets/images/logo.png" class="img-responsive" alt="OKLER Themes">
                                                    </div>
                                                </div>
                                            </div>
                                        </header>

                                        <div class="bill-info">
                                            <h5>Yang bertanda tangan di bawah ini :</h5>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 30%">Nama Pemilik</td>
                                                    <td style="width: 5%">:</td>
                                                    <td style="border-bottom: 1px solid black">${data.nama_pemilik}</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Pemilik</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.alamat_pemilik}</td>
                                                </tr>
                                                <tr>
                                                    <td>No.Tlp / HP</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.telp}</td>
                                                </tr>
                                                <tr>
                                                    <td>Fax</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.fax}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.email}</td>
                                                </tr>
                                                <tr>
                                                    <td>Bertindak sebagai</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.pic}</td>
                                                </tr>
                                            </table>

                                            <br/>

                                            <h5>Telah sepakat untuk bekerja sama dengan PINRUMAH.COM untuk memasarkan (menjual / menyewakann) properti kami secara tidak terikat dengan data properti sebagai berikut :</h5>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 30%">Jenis Properti</td>
                                                    <td style="width: 5%">:</td>
                                                    <td style="border-bottom: 1px solid black">${data.jenis}</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Properti</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.alamat_properti}</td>
                                                </tr>
                                                <tr>
                                                    <td>Luas Tanah</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.luas_tanah}</td>
                                                </tr>
                                                <tr>
                                                    <td>Luas Bangunan</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.luas_bangunan}</td>
                                                </tr>
                                                <tr>
                                                    <td>Panjang x Lebar</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.panjang} m2 x ${data.lebar} m2</td>
                                                </tr>
                                                <tr>
                                                    <td>Sertifikat</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.sertifikat}</td>
                                                </tr>
                                                <tr>
                                                    <td>IMB</td>
                                                    <td>:</td>
                                                    <td style="border-bottom: 1px solid black">${data.imb}</td>
                                                </tr>
                                            </table>

                                            <br/>

                                            <h5>Spesifikasi :</h5>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 33%; padding: 8px;">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td style="width: 50%">Kamar Tidur</td>
                                                                <td style="border-bottom: 1px solid black">${data.kamar}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%;">Listrik</td>
                                                                <td style="border-bottom: 1px solid black">${data.listrik}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%">Jumlah Lantai</td>
                                                                <td style="border-bottom: 1px solid black">${data.lantai}</td>
                                                            </tr>
                                                        </table>
                                                    </td>                                                
                                                    <td style="width: 33%; padding: 8px;">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td style="width: 50%">Kamar Mandi</td>
                                                                <td style="border-bottom: 1px solid black">${data.kamar_mandi}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%">Air</td>
                                                                <td style="border-bottom: 1px solid black">${data.air}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%">Jenis Lantai</td>
                                                                <td style="border-bottom: 1px solid black">${data.jenis_lantai}</td>
                                                            </tr>
                                                        </table>
                                                    </td>                                                
                                                    <td style="width: 33%; padding: 8px;">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td style="width: 50%">Garasi</td>
                                                                <td style="border-bottom: 1px solid black">${data.garasi}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%">Telp</td>
                                                                <td style="border-bottom: 1px solid black">${data.line_tlp}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%">Tahun</td>
                                                                <td style="border-bottom: 1px solid black">${data.tahun}</td>
                                                            </tr>
                                                        </table>
                                                    </td>                                                
                                                </tr>                                            
                                            </table>

                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 15%">Fully Furnish</td>
                                                    <td style="border-bottom: 1px solid black">${data.fully_furnish}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">Semi Furnish</td>
                                                    <td style="border-bottom: 1px solid black">${data.semi_furnish}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">Keterangan</td>
                                                    <td style="border-bottom: 1px solid black">${data.keterangan}</td>
                                                </tr>
                                            </table>

                                            <br/>

                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 30%">Harga Penawaran</td>
                                                    <td style="width: 5%">:</td>
                                                    <td style="border-bottom: 1px solid black">Rp. ${parseInt(data.harga_penawaran).toLocaleString(['ban', 'id'])}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%">Harga Bawah</td>
                                                    <td style="width: 5%">:</td>
                                                    <td style="border-bottom: 1px solid black">Rp. ${parseInt(parseInt(data.harga_penawaran) + (parseInt(data.harga_penawaran) * parseInt(data.komisi) / 100)).toLocaleString(['ban', 'id'])}</td>
                                                </tr>
                                            </table>
                                            
                                            <br/>

                                            <h5>Jika PINRUMAH.com beserta seluruh kantor cabangnya berhasil Menjual atau Menyewakan properti tersebut, kami menyetujui untuk membayar jasa Pemasaran atau Komisi sebesar <b>${data.komisi} %</b> dari nilai Total Transaksi</h5>
                                        </div>

                                        
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 50%" class="text-center">
                                                    <div>Yang Memberi Persetujuan</div>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <div>( ..............................................................)</div>
                                                </td>
                                                <td style="width: 50%" class="text-center">
                                                    <div>PINRUMAH.COM</div>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <div>( ..............................................................)</div>
                                                </td>
                                            </tr>
                                        </table>


                                    </div>


                                </div>

                                <div id="foto" class="tab-pane">
                                    <div class="timeline timeline-simple mt-xlg mb-md">
										<div class="tm-body">
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 1
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.survei_foto.foto_1}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.survei_foto.foto_1}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 2
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.survei_foto.foto_2}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.survei_foto.foto_2}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 3
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.survei_foto.foto_3}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.survei_foto.foto_3}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 4
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.survei_foto.foto_4}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.survei_foto.foto_4}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
											<ol class="tm-items">
												<li>
													<div class="tm-box">
														<p>
															Foto 5
														</p>
														<div class="thumbnail-gallery">
															<a class="img-thumbnail lightbox" href="${data.survei_foto.foto_5}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">
																<img class="img-responsive" width="100%" src="${data.survei_foto.foto_5}" onerror="this.onerror=null;this.src='${BASE_URL}assets/images/projects/project-4.jpg';">
																<span class="zoom">
																	<i class="fa fa-search"></i>
																</span>
															</a>
														</div>
													</div>
												</li>
											</ol>
										</div>
									</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Action</h2>
                            </header>
                            <div class="panel-body">
                                ${renderAction(data, level)}
                            </div>
                        </section>

                        ${renderIklan(data)}
                    </div>
               </div> 
            `

            $('.detail-container').html(html)

            callback()
        },
    }
})()

const showingUI = (() => {

    const renderAction = (level, data) => {
        switch(level){
            case 'Cs': 
                if(data.status === 'Proses' && data.properti.terjual === 'T'){
                    return `
                        <a class="btn btn-md btn-block btn-success" href="#/showing/edit/${data.kd_showing}">Edit</a>
                        <button class="btn btn-md btn-block btn-danger" id="btn_delete" data-placement="bottom" data-id="${data.kd_showing}">Hapus</button>
                    `
                } else {
                    return `<h5 class="text-center">Tidak tersedia</h5>`
                }

            default:
                return `<h5 class="text-center">Tidak tersedia</h5>`
        }
    }

    const renderProperti = (data) => {
        if(data === null){
            return `
                <h5 class="text-center">Properti tidak tersedia</h5>
            `
        } else {
            return `
                <h4 class="text-primary text-center"><a href="#/properti/${data.kd_properti}">${data.kd_properti}</a></h4>
            `
        }
    }
    
    return {
        renderDetail: (level, data, callback) => {
            let html = `
            
                <div class="row">
                    <div class="col-md-8">
                        <section class="panel panel-featured">
                            <header class="panel-heading">
                                <h2 class="panel-title">Showing Schedule</h2>
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="simple-user-list">
                                            <li>
                                                <span class="title">Kode Showing</span>
                                                <span class="message truncate">${data.kd_showing}</span>
                                            </li>
                                            <li>
                                                <span class="title">Agen</span>
                                                <span class="message truncate">${data.agen.nama_lengkap}</span>
                                            </li>
                                            <li>
                                                <span class="title">Nama Klien / Telepon</span>
                                                <span class="message truncate">${data.nama_klien} - ${data.tlp_klien}</span>
                                            </li>
                                            <li>
                                                <span class="title">Tanggal/Jam</span>
                                                <span class="message truncate">${data.tgl_showing} ${data.jam_showing}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="showing_schedule" data-date-format="yyyy/mm/dd" data-date="${data.tgl_showing}"></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Action</h2>
                            </header>
                            <div class="panel-body">
                                ${renderAction(level, data)}
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Kode Properti</h2>
                            </header>
                            <div class="panel-body">
                                ${renderProperti(data.properti)}
                            </div>
                        </section>
                    </div>
                </div>
            
            `

            $('.detail-container').html(html)
            callback()
        }
    }
})()

const dealUI = (() => {

    const renderAction = (data, level) => {
        switch (level) {
            case 'Agen':
                return `
                    <a class="btn btn-md btn-block btn-success" href="#/deal/edit/${data.kd_booking}">Edit</a>
                    <button class="btn btn-md btn-block btn-danger" id="btn_delete" data-placement="bottom" data-id="${data.kd_booking}">Hapus</button>
                `
            default:
                return `<h5 class="text-center">Tidak tersedia</h5>`
        }
    }

    const renderProperti = data => {
        if (data === null) {
            return `
                <h5 class="text-center">Properti tidak tersedia</h5>
            `
        } else {
            return `
                <h4 class="text-primary text-center"><a href="#/properti/${data.kd_properti}">${data.kd_properti}</a></h4>
            `
        }
    }

    return {
        renderDetail: (level, data, callback) => {
            console.log(data)
            let html = `
               <div class="row">
                    <div class="col-md-9">
                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#pembayaran_klien" data-toggle="tab">Pembayaran Klien</a>
                                </li>
                                <li>
                                    <a href="#pembayaran_pemilik" data-toggle="tab">Pembayaran Pemilik</a>
                                </li>
                                <li>
                                    <a href="#form_komisi" data-toggle="tab">Form Komisi</a>
                                </li>
                                <li>
                                    <a href="#form_perjanjian" data-toggle="tab">Form Perjanjian</a>
                                </li>
                                <li>
                                    <a href="#form_listing" data-toggle="tab">Form Listing</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="pembayaran_klien" class="tab-pane active">
                                    <embed src="${data.pembayaran_klien}" width="100%" height="500px">
                                </div>

                                <div id="pembayaran_pemilik" class="tab-pane">
                                    <embed src="${data.pembayaran_pemilik}" width="100%" height="500px">
                                </div>

                                <div id="form_komisi" class="tab-pane">
                                    <embed src="${data.form_komisi}" width="100%" height="500px">
                                </div>

                                <div id="form_perjanjian" class="tab-pane">
                                    <embed src="${data.form_perjanjian}" width="100%" height="500px">
                                </div>

                                <div id="form_listing" class="tab-pane">
                                    <embed src="${data.form_listing}" width="100%" height="500px">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Action</h2>
                            </header>
                            <div class="panel-body">
                                ${renderAction(data, level)}
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Detail</h2>
                            </header>
                            
                            <div class="deal_schedule" data-date-format="yyyy/mm/dd" data-date="${data.tgl_deal}"></div>
                            
                            <br/>

                            <div class="panel-body">
                                <label>Keterangan</label>
                                <p>
                                    ${data.keterangan}
                                </p>
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading panel-heading-transparent">
                                <h2 class="panel-title">Properti</h2>
                            </header>
                            <div class="panel-body">
                                ${renderProperti(data.properti)}
                            </div>
                        </section>
                    </div>
               </div> 
            `

            $('.detail-container').html(html)

            callback()
        },

        renderError: err => {
            let html = `<h1 class="text-center">${err.error}</h1>`

            $('#edit-container, .detail-container').html(html);
        }
    }
})()

const reportUI = (() => {

    return {
        renderLaporanView: (data, periode, callback) => {
            let html = '';
            let total = 0;
            let list_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']

            if(data.length === 0){
                html += `
                    <div class="text-center">
                        <h4>Data tidak tersedia</h4>
                    </div>
                `
            } else {
                html += `
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <button class="btn btn-success" id="btn_print" style="margin-right: 10px;">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </header>
                    <div class="panel-body" id="print_area">
                        <table>
                            <tr>
                                <td style="width: 100%">
                                    <div class="text-right">
                                        <img src="${BASE_URL}assets/images/logo.png" style="width: 50%" alt="OKLER Themes">
                                        <h4>Jl. Petojo Viy I 30A, Cideng, Jakarta Pusat 10150</h4>
                                        <h5>Telp. 021-6338080 Email. admin@pinrumah.com</h5>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <hr/>

                        <h4>Laporan Penjualan Periode ${list_bulan[parseInt(periode.bulan) - 1]} ${periode.tahun}</h4>

                        <table class="table table-bordered table-striped mb-none" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Kode Properti</th>
                                    <th>Agen</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Harga Penawaran</th>
                                    <th>Komisi</th>
                                    <th>Harga Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.map(v => {
                                    let total_harga = parseInt(v.properti.harga_penawaran) + (parseInt(v.properti.harga_penawaran) * parseInt(v.properti.komisi) / 100)
                                    total += total_harga

                                    return `
                                        <tr>
                                            <td>${v.kd_booking}</td>
                                            <td>${v.properti.kd_properti}</td>
                                            <td>${v.agen.nama_lengkap}</td>
                                            <td>${v.tgl_deal}</td>
                                            <td>Rp. ${parseInt(v.properti.harga_penawaran).toLocaleString(['ban', 'id'])}</td>
                                            <td>${v.properti.komisi} %</td>
                                            <td>Rp. ${parseInt(total_harga).toLocaleString(['ban', 'id'])}</td>
                                        </tr>
                                    `
                                }).join('')}
                            </tbody>
                        </table>
                        
                        <br/>

                        <table style="width: 100%">
                            <tr>
                                <td style="width: 50%">
                                
                                </td>
                                <td style="width: 50%">
                                    <table style="width: 100%">
                                        <tr>
                                            <td class="text-right">
                                                <h5><b>Grand Total</b> Rp. ${parseInt(total).toLocaleString(['ban', 'id'])}</h5>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                `
            }

            $('#report_container').html(html)
            callback()
        }
    }
})()