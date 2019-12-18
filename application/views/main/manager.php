
<!doctype html>
<html class="fixed search-results">
	<head>
		<meta charset="UTF-8">
		<title>Manager | SIADIK</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/skins/default.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme-custom.css">

        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/loaders/loaders.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/toastr/build/toastr.min.css" />
        
		<script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>

		<script>
			const BASE_URL = "<?= base_url() ?>"
			const TOKEN = "<?= $this->session->userdata('key') ?>"
		</script>
	</head>
	<body>
		<section class="body">

			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="<?= base_url() ?>assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<div class="header-right">
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?= base_url() ?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="<?= base_url() ?>assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?= $this->session->userdata('nama_lengkap') ?></span>
								<span class="role"><?= $this->session->userdata('level') ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a id="setting-profile" href="javascript:void(0);"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a id="setting-password" href="javascript:void(0);"><i class="fa fa-lock"></i> Change Password</a>
								</li>
								<li>
									<a id="setting-logout" href="javascript:void(0);"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
                </div>
                
			</header>

			<div class="inner-wrapper">
				<aside id="sidebar-left" class="sidebar-left">
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="#/dashboard">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
								</ul>
							</nav>
				
							
						</div>
				
					</div>
				</aside>

				<section role="main" id="page_container" class="content-body">
					
				</section>
			</div>
<!-- 
			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="<?= base_url() ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="<?= base_url() ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="<?= base_url() ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="<?= base_url() ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
			 -->
        </section>
        
		<script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
		<script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<script src="<?= base_url() ?>assets/javascripts/theme.js"></script>
		<script src="<?= base_url() ?>assets/javascripts/theme.custom.js"></script>
        <script src="<?= base_url() ?>assets/javascripts/theme.init.js"></script>
        
        <script src="<?= base_url() ?>assets/vendor/jquery-validation/jquery.validate.js"></script>
        <script src="<?= base_url() ?>assets/vendor/block-ui/jquery.blockUI.js"></script>
        <script src="<?= base_url() ?>assets/vendor/toastr/build/toastr.min.js"></script>

        <script src="<?= base_url() ?>src/additional.js"></script>
        <script src="<?= base_url() ?>src/setting.js"></script>
        <script src="<?= base_url() ?>src/app-ui.js"></script>
        <script src="<?= base_url() ?>src/app-controller.js"></script>
        <script>
            mainController.init();
        </script>

	</body>
</html>