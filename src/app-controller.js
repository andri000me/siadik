const authController = ((Set) => {

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

            // activeNav(path);
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