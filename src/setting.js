const librarySetting = (() => {
    return {
        authLoader: element => {
            $(element).block({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="square-spin loader-success">
                          <div></div>
                        </div>
                      </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        },
        publicLoader: () => {
            $.blockUI({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="ball-clip-rotate-multiple loader-success">
                          <div></div>
                          <div></div>
                        </div>
                      </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        privateLoader: element => {
            $(element).block({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="square-spin loader-success">
                          <div></div>
                        </div>
                      </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        },
        buttonLoader: btn => {
            $(btn).block({
                message: `
                    <i class="fa fa-spinner fa-spin"></i>
                `,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        },
        closeAuthLoader: element => {
            $(element).unblock()
        },
        closePublicLoader: () => {
            $.unblockUI()
        },
        closePrivateLoader: element => {
            $(element).unblock()
        },
        closeButtonLoader: btn => {
            $(btn).unblock()
        }
    }
})()
