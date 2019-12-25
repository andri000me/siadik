toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 100,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "slideUp"
}

const authController = ((Set) => {

    const setSession = (data) => {
        $.ajax({
            url: `${BASE_URL}authenticate/login`,
            type: 'POST',
            dataType: 'JSON',
            data: {
                id_user: data.id_user,
                nama_lengkap: data.nama_lengkap,
                key: data.key,
                level: data.level
            },
            success: (data) => {
                if(data.status === true){
                    window.location.replace(`${BASE_URL}`);
                }
            },
            error: err => {
                toastr.error('Gagal melakukan login', 'Gagal')
            }
        })
    }

    const submitLogin = () => {

        $('#form_login').submit(function(e){
            e.preventDefault();
        }).validate({
            rules: {
                username: 'required',
                password: 'required'
            },
            messages: {
                username: 'Field harus diisi',
                password: 'Field harus diisi'
            },
            submitHandler: f => {
                $.ajax({
                    url: `${BASE_URL}api/auth/login`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(f).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        Set.authLoader('#container_login')
                    },
                    success: ({ data }) => {
                        setSession(data);
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        Set.closeAuthLoader('#container_login')
                    }
                })

            }
        })
    }

    const showPass = () => {

        $('#show_password').click(function () {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            };
        });
    }

    return {
        init: () => {
            submitLogin()
            showPass()
        }
    }
})(librarySetting);

const mainController = ((Set) => {

    const loadContent = path => {
        $.ajax({
            url: `${BASE_URL}${path}`,
            dataType: 'HTML',
            beforeSend: function () {
                Set.publicLoader()
            },
            success: function (response) {
                $('#page_container').html(response)
            },
            error: function () {
                alert('Access Denied');
            },
            complete: () => {
                Set.closePublicLoader()
            }
        })
    }

    const activeNav = path => {
        $('a').closest('li').removeClass('nav-active');
        $('a[href="' + path + '"]').closest('li').addClass('nav-active');
    }

    const setRoute = () => {
        let path;

        if (location.hash) {
            path = location.hash;
            loadContent(path.substr(2));
        } else {
            location.hash = '#/dashboard';
        }

        $(window).on('hashchange', function () {
            path = location.hash;

            activeNav(path);
            loadContent(path.substr(2));
        });
    }

    const logout = () => {
        $('#setting-logout').on('click', function(){
            $.ajax({
                url: `${BASE_URL}authenticate/logout`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function () {
                    Set.publicLoader()
                },
                success: (data) => {
                    if (data.status === true) {
                        window.location.replace(`${BASE_URL}login`);
                    }
                },
                error: err => {
                    toastr.error('Gagal melakukan logout', 'Gagal')
                },
                complete: () => {
                    Set.closePublicLoader()
                }
            })
        })
    }

    return {
        init: (level) => {
            setRoute()
            logout()
        }
    }
    
})(librarySetting)

const userController = ((Set) => {

    const openAdd = () => {
        let add = $('.btn-add')
        

        add.on('click', function(){
            let validator = $('.form-add').validate()
            validator.resetForm()

            $('.form-add')[0].reset();
            $('#modal-add').modal('show');
        })
    }


    const submitAdd = table => {
        let form = $('.form-add')

        form.validate({
            rules: {
                nama_lengkap: 'required',
                username: 'required',
                telepon: 'required',
                aktif: 'required',
                level: 'required'
            },
            submitHandler: add => {
                $.ajax({
                    url: `${BASE_URL}api/user/add`,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(add).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                        Set.privateLoader('#modal-add .modal-content');
                    },
                    success: res => {
                        table.ajax.reload()
                        $('#modal-add').modal('hide')
                        toastr.success(res.message, 'Berhasil')
                    },
                    error: err => {
                        toastr.error(res.error, 'Gagal')
                    },
                    complete: () => {
                        Set.closePrivateLoader('#modal-add .modal-content')
                    }
                })
            }
        })
    }

    const submitEdit = table => {
        let form = $('.form-edit')

        form.on('submit', function(e){
            e.preventDefault()
        }).validate({
            rules: {
                nama_lengkap: 'required',
                username: 'required',
                telepon: 'required',
                aktif: 'required',
                level: 'required'
            },
            submitHandler: edit => {
                let id = $('#edit_id_user').val()

                $.ajax({
                    url: `${BASE_URL}api/user/edit/${id}`,
                    method: 'PUT',
                    dataType: 'JSON',
                    data: $(edit).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                        Set.privateLoader('#modal-edit .modal-content');
                    },
                    success: res => {
                        table.ajax.reload()
                        $('#modal-edit').modal('hide')
                        toastr.success(res.message, 'Berhasil')
                    },
                    error: err => {
                        toastr.error(err.error, 'Gagal')
                    },
                    complete: () => {
                        Set.closePrivateLoader('#modal-edit .modal-content')
                    }
                })
            }
        })
    }

    const submitDelete = table => {
        let form = $('.form-delete')

        form.on('submit', function(e){
            let id = $('#delete_id').val()
            e.preventDefault()

            $.ajax({
                url: `${BASE_URL}api/user/delete/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend: xhr => {
                    xhr.setRequestHeader("X-API-KEY", TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    Set.privateLoader('#modal-delete .modal-content');
                },
                success: res => {
                    table.ajax.reload()
                    $('#modal-delete').modal('hide')
                    toastr.success(res.message, 'Berhasil')
                },
                error: err => {
                    toastr.error(err.error, 'Gagal')
                },
                complete: () => {
                    Set.closePrivateLoader('#modal-delete .modal-content')
                }
            })
        })
    }

    const openEdit = () => {
        let table = $('#t_user')

        table.on('click', '.btn-edit', function(){
            let id = $(this).data('id');

            $('.form-edit')[0].reset();
            $('#modal-edit').modal('show');

            $.ajax({
                url: `${BASE_URL}api/user/${id}`,
                method: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("X-API-KEY", TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    Set.privateLoader('#modal-edit .modal-content');
                },
                success: res => {
                    const { data } = res

                    $('#edit_id_user').val(data.id_user)
                    $('#edit_nama_lengkap').val(data.nama_lengkap)
                    $('#edit_username').val(data.username)
                    $('#edit_telepon').val(data.telepon)
                    $('#edit_level').val(data.level)
                    $('#edit_aktif').val(data.aktif)
                },
                error: err => {
                    $('#modal-edit').modal('hide');
                    toastr.error('User tidak ditemukan', 'Error')
                },
                complete: () => {
                    Set.closePrivateLoader('#modal-edit .modal-content')
                }
            })

            
        })
    }

    const openDelete = () => {
        let table = $('#t_user')

        table.on('click', '.btn-delete', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#delete_id').val(id)
            $('#delete_name').text(name)

            $('#modal-delete').modal('show');
        })
    }

    const reloadTable = table => {
        let btn = $('.btn-reload')

        btn.on('click', function(){
            table.ajax.reload();
        })
    }

    return {
        init: () => {
            const t_user = $('#t_user').DataTable({
                columnDefs: [
                    {
                        targets: [4],
                        searchable: false
                    },
                    {
                        targets: [4],
                        orderable: false
                    }
                ],
                autoWidth: true,
                processing: true,
                responsive: false,
                scrollX: true,
                scrollY: 300,
                ajax: {
                    url: `${BASE_URL}api/user`,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    },
                    dataSrc: res => {
                        let active = res.data.filter(v => v.aktif === 'Y').length;
                        let inactive = res.data.filter(v => v.aktif === 'T').length;

                        $('#count_active').text(active)
                        $('#count_inactive').text(inactive)

                        return res.data
                    },
                    error: err => {

                    }
                },
                columns: [
                    {
                        data: "nama_lengkap",
                        render: (data, type, row) => {
                            return `
                                <a href="#/user/${row.id_user}">
                                    ${row.nama_lengkap} 
                                    <br/>
                                    ${row.username}
                                </a>
                            `
                        }
                    },
                    {
                        data: "telepon"
                    },
                    {
                        data: "aktif",
                        render: (data, type, row) => {
                            if (row.aktif === 'Y') {
                                return `<span class="label label-success">Aktif</span> `
                            } else {
                                return `<span class="label label-danger">Tidak Aktif</span>`
                            }
                        }
                    },
                    {
                        data: "level"
                    },
                    {
                        data: "id_user",
                        render: (data, type, row) => {
                            return `
                                <div class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-edit" role="button" data-id="${row.id_user}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-delete" role="button" data-id="${row.id_user}" data-name="${row.nama_lengkap}"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            `
                        }
                    }
                ],
                order: [[0, "desc"]]
            });

            reloadTable(t_user)

            openAdd()
            openEdit()
            openDelete()

            submitAdd(t_user)
            submitEdit(t_user)
            submitDelete(t_user)
        }
    }
})(librarySetting)

const surveiFotoController = ((Set, UI) => {
    const fetchSurvei = (id, callback) => {

        $.ajax({
            url: `${BASE_URL}api/survei_foto/${id}`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                callback(res.data)
            },
            error: err => {
                let error = err.responseJSON
                UI.renderError(error);
            }
        })
    }

    const initializeDetailPlugin = level => {
        $('.detail-container .timeline .thumbnail-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });

        $('.detail-container #btn_delete').confirmation({
            title: 'Apakah anda yakin?',
            btnOkLabel: 'Ya',
            btnCancelLabel: 'Tidak',
            onConfirm: function () {
                let id = $('.detail-container #btn_delete').data('id');
                submitDelete(id);
            }
        });

        $('.detail-container #btn_tolak').confirmation({
            title: 'Apakah anda yakin?',
            btnOkLabel: 'Ya',
            btnCancelLabel: 'Tidak',
            onConfirm: function () {
                let obj = {
                    id: $('.detail-container #btn_tolak').data('id'),
                    status: $('.detail-container #btn_tolak').data('status')
                }
                submitTolak(obj, level);
            }
        });
    }

    const initializeEditPlugin = () => {
        $('#edit-container .foto').dropify({
            messages: {
                default: `Upload Documentation Photo`,
                replace: 'Photo',
                remove: 'Remove'
            }
        })
    }

    const submitAdd = () => {
        $('#form_add').submit(function(e){
            e.preventDefault()
        }).validate({
            rules: {
                alamat: 'required',
                foto_1: 'required',
                foto_2: 'required',
                foto_3: 'required',
                foto_4: 'required',
                foto_5: 'required',
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}api/survei_foto/add`,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                        Set.buttonLoader('#btn_submit')
                    },
                    success: function (res) {
                        toastr.success(res.message, 'Berhasil')
                        location.hash = `#/survei_foto/${res.input_id}`
                    },
                    error: function (err) {
                        toastr.error(err.error, 'Gagal')
                    },
                    complete: () => {
                        Set.closeButtonLoader('#btn_submit')
                    }
                })
            }
        })
    }

    const submitDelete = id => {
        $.ajax({
            url: `${BASE_URL}api/survei_foto/delete/${id}`,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                toastr.success(res.message, 'Berhasil')
                location.hash = `#/survei_foto`
            },
            error: err => {
                toastr.error(err.error, 'Gagal')
            }
        })
    }

    const submitEdit = () => {

        $('#edit-container #form_edit').validate({
                rules: {
                    alamat: 'required',
                    foto_1_desc: 'required',
                    foto_2_desc: 'required',
                    foto_3_desc: 'required',
                    foto_4_desc: 'required',
                    foto_5_desc: 'required',
                },
                submitHandler: form => {
                    let id = $('#edit-container #kd_foto').val();

                    $.ajax({
                        url: `${BASE_URL}api/survei_foto/edit/${id}`,
                        type: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        cache: false,
                        beforeSend: xhr => {
                            xhr.setRequestHeader("X-API-KEY", TOKEN)
                            xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                            Set.buttonLoader('#btn_submit')
                        },
                        success: function (res) {
                            toastr.success(res.message, 'Berhasil')
                            location.hash = `#/survei_foto/${res.update_id}`
                        },
                        error: function (err) {
                            toastr.error(err.error, 'Gagal')
                        },
                        complete: () => {
                            Set.closeButtonLoader('#btn_submit')
                        }
                    })
                }
            })
    }

    const submitTolak = (obj, level) => {
        $.ajax({
            url: `${BASE_URL}api/survei_foto/update_status/${obj.id}`,
            type: 'PUT',
            dataType: 'JSON',
            data: {
                status: obj.status
            },
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                toastr.success(res.message, 'Berhasil')
                fetchSurvei(obj.id, data => {
                    UI.renderDetail(data, level, function () {
                        initializeDetailPlugin(level)
                    });
                })
            },
            error: err => {
                toastr.error(err.error, 'Gagal')
            }
        })
    }

    const reloadTable = table => {
        let btn = $('.btn-reload')

        btn.on('click', function () {
            table.ajax.reload();
        })
    }

    return {
        data: (level) => {
            if(level === 'Agen'){
                $('.btn-add').show()
            }

            const t_survei = $('#t_survei').DataTable({
                columnDefs: [
                    {
                        targets: [4],
                        searchable: false
                    },
                    {
                        targets: [4],
                        orderable: false
                    }
                ],
                autoWidth: true,
                processing: true,
                responsive: false,
                scrollX: true,
                scrollY: 300,
                ajax: {
                    url: `${BASE_URL}api/survei_foto`,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    },
                    dataSrc: res => {
                        let proses = res.data.filter(v => v.status === 'Proses').length;
                        let konfirmasi = res.data.filter(v => v.status === 'Konfirmasi').length;
                        let tolak = res.data.filter(v => v.status === 'Tolak').length;

                        $('#count_proses').text(proses)
                        $('#count_konfirmasi').text(konfirmasi)
                        $('#count_tolak').text(tolak)

                        return res.data
                    },
                    error: err => {

                    }
                },
                columns: [
                    {
                        data: "kd_foto",
                        render: (data, type, row) => {
                            return `
                                <a href="#/survei_foto/${row.kd_foto}">
                                    ${row.kd_foto}
                                </a>
                            `
                        }
                    },
                    {
                        data: "agen.nama_lengkap",
                    },
                    {
                        data: "alamat"
                    },
                    {
                        data: "status",
                        render: (data, type, row) => {
                            switch(row.status) {
                                case 'Konfirmasi': 
                                    return `<span class="label label-success">Konfirmasi</span> `
                                break;

                                case 'Proses':
                                    return `<span class="label label-primary">Proses</span> `
                                break;

                                case 'Tolak':
                                    return `<span class="label label-danger">Tolak</span> `
                                break;
                            }
                        }
                    },
                    {
                        data: "keterangan"
                    }
                ],
                order: [[0, "desc"]]
            });

            reloadTable(t_survei)
        },

        detail: (level) => {
            let id = location.hash.substr(14)

            fetchSurvei(id, data => {
                UI.renderDetail(data, level, function () {
                    initializeDetailPlugin(level)
                });
            })
        },

        add: (level) => {
            $('.foto').dropify({
                messages: {
                    default: `Upload Documentation Photo`,
                    replace: 'Photo',
                    remove: 'Remove'
                }
            })

            submitAdd()
        },

        edit: (level) => {
            let id = location.hash.substr(19)

            fetchSurvei(id, data => {
                UI.renderFormEdit(data, function () {
                    initializeEditPlugin()
                });

                submitEdit()
            })

            
        }
    }
})(librarySetting, surveiFotoUI)

const propertiController = ((Set, UI) => {

    const fetchProperti = (id, callback) => {
        $.ajax({
            url: `${BASE_URL}api/properti/${id}`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                callback(res.data)
            },
            error: err => {
                let error = err.responseJSON
                UI.renderSurveiError(error);
            }
        })
    }

    const fetchSurvei = (id, callback) => {
        $.ajax({
            url: `${BASE_URL}api/survei_foto/${id}`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                if(res.data.status === 'Proses'){
                    callback(res.data)
                } else {
                    UI.renderSurveiError({ error: 'Survei foto tidak ditemukan'});
                }
            },
            error: err => {
                let error = err.responseJSON
                UI.renderSurveiError(error);
            }
        })
    }

    const fetchAllSurvei = (callback) => {
        $.ajax({
            url: `${BASE_URL}api/survei_foto`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                let filtered = [];

                res.data.filter(i => i.status === 'Proses').map(v => {
                    let obj = {
                        id: v.kd_foto,
                        text: v.kd_foto,
                        data_row: JSON.stringify(v)
                    }

                    filtered.push(obj)
                })

                callback(filtered)
            },
            error: err => {
                initializeSelect2([])
            }
        })
    }

    const initializeWizard = () => {
        var $w1finish = $('#w1').find('ul.pager li.finish'),
            $w1validator = $("#w1 form").validate({
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                    $(element).remove();
                },
                errorPlacement: function (error, element) {
                    element.parent().append(error);
                }
            });

        $w1finish.on('click', function (ev) {
            ev.preventDefault();
            var validated = $('#w1 form').valid();
            if (validated) {
                submitAdd()
            }
        });


        $('#w1').bootstrapWizard({
            tabClass: 'wizard-steps',
            nextSelector: 'ul.pager li.next',
            previousSelector: 'ul.pager li.previous',
            firstSelector: null,
            lastSelector: null,
            onNext: function (tab, navigation, index, newindex) {
                var validated = $('#w1 form').valid();
                if (!validated) {
                    $w1validator.focusInvalid();
                    return false;
                }
            },
            onTabClick: function (tab, navigation, index, newindex) {
                if (newindex == index + 1) {
                    return this.onNext(tab, navigation, index, newindex);
                } else if (newindex > index + 1) {
                    return false;
                } else {
                    return true;
                }
            },
            onTabChange: function (tab, navigation, index, newindex) {
                var totalTabs = navigation.find('li').size() - 1;
                $w1finish[newindex != totalTabs ? 'addClass' : 'removeClass']('hidden');
                $('#w1').find(this.nextSelector)[newindex == totalTabs ? 'addClass' : 'removeClass']('hidden');
            }
        });
    }

    const initializeSurveiPlugin = () => {
        $('#w1-survei-foto .thumbnail-gallery, .selected-container .thumbnail-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    }

    const initializeSelect2 = data => {
        $('#w1-kd_foto').select2({
            theme: "bootstrap",
            data: data
        })
    }

    const onChangeSurvei = () => {
        $('#w1-kd_foto').on('select2:select', function(e){
            let data = e.params.data;

            UI.renderSelectedSurvei(JSON.parse(data.data_row))
            initializeSurveiPlugin()
        })
    }

    const submitAdd = () => {
        $.ajax({
            url: `${BASE_URL}api/properti/add`,
            method: 'POST',
            dataType: 'JSON',
            data: $('#form_add').serialize(),
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                Set.buttonLoader('#w1 .finish');
            },
            success: res => {
                toastr.success(res.message, 'Berhasil')
                location.hash = `#/properti/${res.input_id}`
            },
            error: err => {
                toastr.error(err.error, 'Gagal')
            },
            complete: () => {
                Set.closeButtonLoader('#w1 .finish')
            }
        })
    }

    const submitDelete = id => {
        $.ajax({
            url: `${BASE_URL}api/properti/delete/${id}`,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                toastr.success(res.message, 'Berhasil')
                location.hash = `#/properti`
            },
            error: err => {
                toastr.error(err.error, 'Gagal')
            }
        })
    }

    const submitIklan = (id, level) => {
        $.ajax({
            url: `${BASE_URL}api/iklan/add`,
            type: 'POST',
            dataType: 'JSON',
            data: {
                kd_properti: id
            },
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                toastr.success(res.message, 'Berhasil')

                fetchProperti(id, data => {
                    UI.renderDetail(data, level, function () {
                        initializeDetailPlugin(level)
                    });
                })
            },
            error: err => {
                toastr.error(err.error, 'Gagal')
            }
        })
    }

    const submitBatal = (obj, level) => {
        $.ajax({
            url: `${BASE_URL}api/iklan/delete/${obj.id}`,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                fetchProperti(obj.properti, data => {
                    UI.renderDetail(data, level, function () {
                        initializeDetailPlugin(level)
                    });
                })
                toastr.success(res.message, 'Berhasil')
            },
            error: err => {
                toastr.error(err.error, 'Gagal')
            }
        })
    }

    const initializeDetailPlugin = level => {
        $('.detail-container .timeline .thumbnail-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });

        $('.detail-container #btn_delete').confirmation({
            title: 'Apakah anda yakin?',
            btnOkLabel: 'Ya',
            btnCancelLabel: 'Tidak',
            onConfirm: function () {
                let id = $('.detail-container #btn_delete').data('id');
                submitDelete(id);
            }
        });

        $('.detail-container #btn_iklan').confirmation({
            title: 'Apakah anda yakin?',
            btnOkLabel: 'Confirm',
            btnCancelLabel: 'Tidak',
            onConfirm: function () {
                let id = $('.detail-container #btn_iklan').data('id');
                submitIklan(id, level);
            }
        });

        $('.detail-container #btn_batal').confirmation({
            title: 'Apakah anda yakin?',
            btnOkLabel: 'Ya',
            btnCancelLabel: 'Tidak',
            onConfirm: function () {
                let obj = {
                    id: $('.detail-container #btn_batal').data('id'),
                    properti: $('.detail-container #btn_batal').data('properti')
                }

                submitBatal(obj, level);
            }
        });
    }

    return {
        data: (level) => {
            if (level === 'Telemarketing') {
                $('.btn-add').show()
            }

            const t_properti = $('#t_properti').DataTable({
                columnDefs: [
                    {
                        targets: [5],
                        searchable: false
                    },
                    {
                        targets: [5],
                        orderable: false
                    }
                ],
                autoWidth: true,
                processing: true,
                responsive: false,
                scrollX: true,
                scrollY: 300,
                ajax: {
                    url: `${BASE_URL}api/properti`,
                    type: 'GET',
                    dataType: 'JSONP',
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    },
                    dataSrc: res => {
                        let terjual = res.data.filter(v => v.terjual === 'Y').length;
                        let available = res.data.filter(v => v.terjual === 'T').length;

                        $('#count_terjual').text(terjual)
                        $('#count_available').text(available)

                        return res.data
                    },
                    error: err => {
                        
                    }
                },
                processing: true,
                columns: [
                    {
                        data: "kd_properti",
                        render: (data, type, row) => {
                            return `
                                <a href="#/properti/${row.kd_properti}">
                                    ${row.kd_properti}
                                </a>
                            `
                        }
                    },
                    {
                        data: "telemarketing.nama_lengkap",
                    },
                    {
                        data: "nama_pemilik",
                    },
                    {
                        data: "alamat_properti"
                    },
                    {
                        data: "iklan",
                        render: (data, type, row) => {
                            if(row.iklan !== null){
                                return `
                                    <span class="label label-success">${row.iklan.kd_hos}</span>
                                `
                            } else {
                                return 'Iklan belum tersedia'
                            }
                        }
                    },
                    {
                        data: "terjual",
                        render: (data, type, row) => {
                            switch (row.terjual) {
                                case 'Y':
                                    return `<span class="label label-success">Terjual</span> `
                                    break;

                                case 'T':
                                    return `<span class="label label-primary">Available</span> `
                                    break;
                            }
                        }
                    },
                    {
                        data: "keterangan"
                    }
                ],
                order: [[0, "desc"]]
            });
        },

        add: (level, id) => {
            initializeWizard()

            if(id !== '') {
                fetchSurvei(id, data => {
                    UI.renderSurveiFoto(data);
                    initializeSurveiPlugin();
                })
            } else {
                fetchAllSurvei(data => {
                    UI.renderSelectSurvei();
                    initializeSelect2(data);
                    onChangeSurvei()
                })
            }
        },

        detail: (level, id) => {
            fetchProperti(id, data => {
                UI.renderDetail(data, level, function () {
                    initializeDetailPlugin(level)
                });
            })
        }
    }
})(librarySetting, propertiUI)

const iklanController = ((Set) => {

    const submitEdit = table => {
        let form = $('.form-edit')

        form.on('submit', function (e) {
            e.preventDefault()

            let id = $('#edit_kd_hos').val()

            $.ajax({
                url: `${BASE_URL}api/iklan/edit/${id}`,
                method: 'PUT',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend: xhr => {
                    xhr.setRequestHeader("X-API-KEY", TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    Set.privateLoader('#modal-edit .modal-content');
                },
                success: res => {
                    table.ajax.reload()
                    $('#modal-edit').modal('hide')
                    toastr.success(res.message, 'Berhasil')
                },
                error: err => {
                    toastr.error(err.error, 'Gagal')
                },
                complete: () => {
                    Set.closePrivateLoader('#modal-edit .modal-content')
                }
            })
        })
    }

    const submitDelete = table => {
        let form = $('.form-delete')

        form.on('submit', function (e) {
            let id = $('#delete_id').val()
            e.preventDefault()

            $.ajax({
                url: `${BASE_URL}api/iklan/delete/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("X-API-KEY", TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    Set.privateLoader('#modal-delete .modal-content');
                },
                success: res => {
                    table.ajax.reload()
                    $('#modal-delete').modal('hide')
                    toastr.success(res.message, 'Berhasil')
                },
                error: err => {
                    toastr.error(err.error, 'Gagal')
                },
                complete: () => {
                    Set.closePrivateLoader('#modal-delete .modal-content')
                }
            })
        })
    }

    const openEdit = () => {
        let table = $('#t_iklan')

        table.on('click', '.btn-edit', function () {
            let id = $(this).data('id');
            let keterangan = $(this).data('keterangan');

            $('#keterangan').val(keterangan)
            $('#edit_kd_hos').val(id)

            $('#modal-edit').modal('show');
        })
    }

    const openDelete = () => {
        let table = $('#t_iklan')

        table.on('click', '.btn-delete', function () {
            let id = $(this).data('id');

            $('#delete_id').val(id)
            $('#delete_name').text(id)

            $('#modal-delete').modal('show');
        })
    }

    const reloadTable = table => {
        let btn = $('.btn-reload')

        btn.on('click', function () {
            table.ajax.reload();
        })
    }

    return {
        init: () => {
            const t_iklan = $('#t_iklan').DataTable({
                columnDefs: [
                    {
                        targets: [3],
                        searchable: false
                    },
                    {
                        targets: [3],
                        orderable: false
                    }
                ],
                autoWidth: true,
                processing: true,
                responsive: false,
                scrollX: true,
                scrollY: 300,
                ajax: {
                    url: `${BASE_URL}api/iklan`,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    },
                    dataSrc: res => {
                        $('#count_iklan').text(res.data.length)

                        return res.data
                    },
                    error: err => {

                    }
                },
                columns: [
                    {
                        data: "kd_hos"
                    },
                    {
                        data: "properti.kd_properti",
                        render: (data, type, row) => {
                            return `
                                <a href="#/properti/${row.properti.kd_properti}">
                                    ${row.properti.kd_properti}
                                </a>
                            `
                        }
                    },
                    {
                        data: "advertising.nama_lengkap",
                    },
                    {
                        data: "keterangan",
                    },
                    {
                        data: "kd_hos",
                        render: (data, type, row) => {
                            return `
                                <div class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-edit" role="button" data-id="${row.kd_hos}" data-keterangan=${row.keterangan}><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-delete" role="button" data-id="${row.kd_hos}"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            `
                        }
                    }
                ],
                order: [[0, "desc"]]
            });

            reloadTable(t_iklan)

            openEdit()
            openDelete()

            submitEdit(t_iklan)
            submitDelete(t_iklan)
        }
    }
})(librarySetting)

const showingController = ((Set) => {

    const fetchProperti = () => {
        $.ajax({
            url: `${BASE_URL}api/properti`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                let filtered = [];

                res.data.filter(i => i.terjual === 'T').map(v => {
                    let obj = {
                        id: v.kd_properti,
                        text: v.kd_properti,
                        data_row: JSON.stringify(v)
                    }

                    filtered.push(obj)
                })

                initializeSelect2(filtered)
            },
            error: err => {
                let error = err.responseJSON
                UI.renderSurveiError(error);
            }
        })
    }

    const submitAdd = () => {
        $('#form_add').validate({
            rules: {
                kd_properti: 'required',
                agen_name: 'required',
                nama_klien: 'required',
                tlp_klien: 'required',
                tgl_showing: 'required',
                jam_showing: 'required'
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}api/showing/add`,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                        Set.buttonLoader('#btn_submit');
                    },
                    success: res => {
                        toastr.success(res.message, 'Berhasil')
                        location.hash = `#/showing/${res.input_id}`
                    },
                    error: err => {
                        toastr.error(err.error, 'Gagal')
                    },
                    complete: () => {
                        Set.closeButtonLoader('#btn_submit')
                    }
                })
            }
        })
    }

    const fetchShowing = (id, callback) => {
        $.ajax({
            url: `${BASE_URL}api/showing/${id}`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                callback(res.data)
            },
            error: err => {
                let error = err.responseJSON
                UI.renderError(error);
            }
        })
    }

    const onChangeProperti = () => {
        $('#kd_properti').on('select2:select', function (e) {
            let obj = e.params.data;
            let data = JSON.parse(obj.data_row)

            $('#agen').val(data.survei_foto.agen.id_user)
            $('#agen_name').val(data.survei_foto.agen.nama_lengkap)
        })  
    }

    const initializeSelect2 = data => {
        $('#kd_properti').select2({
            theme: "bootstrap",
            data: data
        })
    }

    const initializeDefaultPlugin = () => {
        $('#jam_showing').timepicker({
            showMeridian: false
        })

        $('#tgl_showing').datepicker()

    }

    return {
        data: (level) => {
            if(level === 'Cs'){
                $('.btn-add').show()
            }

            const t_showing = $('#t_showing').DataTable({
                columnDefs: [
                    {
                        targets: [],
                        searchable: false
                    },
                    {
                        targets: [],
                        orderable: false
                    }
                ],
                autoWidth: true,
                processing: true,
                responsive: false,
                scrollX: true,
                scrollY: 300,
                ajax: {
                    url: `${BASE_URL}api/showing`,
                    type: 'GET',
                    dataType: 'JSONP',
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    },
                    dataSrc: res => {
                        let batal = res.data.filter(v => v.status === 'Batal').length;
                        let proses = res.data.filter(v => v.status === 'Proses').length;
                        let limit = res.data.filter(v => v.status === 'Limit').length;
                        let selesai = res.data.filter(v => v.status === 'Selesai').length;

                        $('#count_batal').text(batal)
                        $('#count_proses').text(proses)
                        $('#count_limit').text(limit)
                        $('#count_selesai').text(selesai)

                        return res.data
                    },
                    error: err => {

                    }
                },
                columns: [
                    {
                        data: "kd_showing",
                        render: (data, type, row) => {
                            return `
                                <a href="#/showing/${row.kd_showing}">
                                    ${row.kd_showing}
                                </a>
                            `
                        }
                    },
                    {
                        data: "properti.kd_properti",
                        render: (data, type, row) => {
                            return `
                                <a href="#/properti/${row.properti.kd_properti}">
                                    ${row.properti.kd_properti}
                                </a>
                            `
                        }
                    },
                    {
                        data: "nama_klien"
                    },
                    {
                        data: "tgl_showing",
                        render: (data, type, row) => {
                            return `
                                ${row.tgl_showing} ${row.jam_showing}
                            `
                        }
                    },
                    {
                        data: "status",
                        render: (data, type, row) => {
                            let status;

                            switch(row.status){
                                case 'Proses':
                                    return `<span class="label label-primary">Proses</span> `
                                  
                                case 'Limit':
                                    return `<span class="label label-warning">Limit</span> `

                                case 'Batal':
                                    return `<span class="label label-danger">Batal</span> `
                                    
                                case 'Selesai':
                                    return `<span class="label label-success">Selesai</span> `
                            }

                        }
                    },
                    {
                        data: "keterangan"
                    },
                ],
                order: [[0, "desc"]]
            });
        },

        add: level => {
            fetchProperti()
            initializeDefaultPlugin()
            onChangeProperti()
            submitAdd()
        },

        edit: (level, id) => {
            fetchShowing(id, data => {
                console.log(data);
            })

            
        }
    }
})(librarySetting)

const dealController = ((Set) => {

    const fetchProperti = () => {
        $.ajax({
            url: `${BASE_URL}api/properti`,
            type: 'GET',
            dataType: 'JSONP',
            beforeSend: xhr => {
                xhr.setRequestHeader("X-API-KEY", TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            success: res => {
                let filtered = [];

                res.data.filter(i => i.terjual === 'T').map(v => {
                    let obj = {
                        id: v.kd_properti,
                        text: v.kd_properti,
                        data_row: JSON.stringify(v)
                    }

                    filtered.push(obj)
                })

                initializeSelect2(filtered)
            },
            error: err => {
                let error = err.responseJSON
                UI.renderSurveiError(error);
            }
        })
    }

    const initializeSelect2 = data => {
        $('#kd_properti').select2({
            theme: "bootstrap",
            data: data
        })
    }

    const initializeDefaultPlugin = () => {
        $('#tgl_deal').datepicker()

        $('.foto').dropify({
            messages: {
                default: `Upload Documentation Photo`,
                replace: 'Photo',
                remove: 'Remove'
            }
        })
    }

    const submitAdd = () => {
        $('#form_add').submit(function (e) {
            e.preventDefault()
        }).validate({
            rules: {
                kd_properti: 'required',
                tgl_deal: 'required',
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}api/deal/add`,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                        Set.buttonLoader('#btn_submit')
                    },
                    success: function (res) {
                        toastr.success(res.message, 'Berhasil')
                        location.hash = `#/deal/${res.input_id}`
                    },
                    error: function (err) {
                        toastr.error(err.error, 'Gagal')
                    },
                    complete: () => {
                        Set.closeButtonLoader('#btn_submit')
                    }
                })
            }
        })
    }

    return {
        data: (level) => {
            if(level === 'Agen'){
                $('.btn-add').show()
            }

            const t_deal = $('#t_deal').DataTable({
                columnDefs: [
                    {
                        targets: [],
                        searchable: false
                    },
                    {
                        targets: [],
                        orderable: false
                    }
                ],
                autoWidth: true,
                processing: true,
                responsive: false,
                scrollX: true,
                scrollY: 300,
                ajax: {
                    url: `${BASE_URL}api/deal`,
                    type: 'GET',
                    dataType: 'JSONP',
                    beforeSend: xhr => {
                        xhr.setRequestHeader("X-API-KEY", TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    },
                    dataSrc: res => {
                        $('#count_deal').text(res.data.length)

                        return res.data
                    },
                    error: err => {

                    }
                },
                columns: [
                    {
                        data: "kd_booking",
                        render: (data, type, row) => {
                            return `
                                <a href="#/deal/${row.kd_booking}">
                                    ${row.kd_booking}
                                </a>
                            `
                        }
                    },
                    {
                        data: "properti.kd_properti",
                        render: (data, type, row) => {
                            return `
                                <a href="#/properti/${row.properti.kd_properti}">
                                    ${row.properti.kd_properti}
                                </a>
                            `
                        }
                    },
                    {
                        data: "tgl_deal"
                    },
                    {
                        data: "keterangan"
                    },
                ],
                order: [[0, "desc"]]
            });
        },

        add: level => {
            fetchProperti()
            initializeDefaultPlugin()
            submitAdd()
        }
    }
})(librarySetting)