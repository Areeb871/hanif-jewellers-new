<!DOCTYPE html>

<html lang="en">
	<head><base href="../../../"/>
		<title>Hanif Jewellers</title>
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/aicaves-black-icon.svg') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<body id="kt_body" class="app-blank">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<a href="/" class="d-block d-lg-none mx-auto py-20">
					<img alt="Logo" src="assets/media/logos/default.svg" class="theme-light-show h-25px" />
					<img alt="Logo" src="assets/media/logos/default-dark.svg" class="theme-dark-show h-25px" />
				</a>
				<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
					<div class="d-flex flex-column-fluid flex-column w-100 mw-450px">
						<div class="d-flex flex-stack py-2">
							<div class="me-2">
								<a href="/login" class="btn btn-icon bg-light rounded-circle">
									<i class="ki-outline ki-black-left fs-2 text-gray-800"></i>
								</a>
							</div>
							<div class="m-0">
								<span class="text-gray-400 fw-bold fs-5 me-2" data-kt-translate="sign-up-head-desc">Already a member ?</span>
								<a href="/login" class="link-primary fw-bold fs-5" data-kt-translate="sign-up-head-link">Sign In</a>
							</div>
						</div>
						<div class="py-20">
							<form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="/" action="{{url('register-user')}}" method="post">
								<div class="text-start mb-10">
									<h1 class="text-dark mb-3 fs-3x" data-kt-translate="sign-up-title">Create an Account</h1>
									<div class="text-gray-400 fw-semibold fs-6" data-kt-translate="general-desc">Empowering through expertise and innovation</div>
								</div>
								<div class="row fv-row mb-7">
									<div class="col-xl-6">
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="First Name" name="first_name" autocomplete="off" data-kt-translate="sign-up-input-first-name" />
									</div>
									<div class="col-xl-6">
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Last Name" name="last_name" autocomplete="off" data-kt-translate="sign-up-input-last-name" />
									</div>
								</div>
								<div class="fv-row mb-10">
									<input class="form-control form-control-lg form-control-solid" type="email" placeholder="Email" name="email" autocomplete="off" data-kt-translate="sign-up-input-email" />
								</div>
								<div class="fv-row mb-10" data-kt-password-meter="true">
									<div class="mb-1">
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="Password" name="password" autocomplete="off" data-kt-translate="sign-up-input-password" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="ki-outline ki-eye-slash fs-2"></i>
												<i class="ki-outline ki-eye fs-2 d-none"></i>
											</span>
										</div>
										<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
										</div>
									</div>
									<div class="text-muted" data-kt-translate="sign-up-hint">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
								</div>
								<div class="fv-row mb-10">
									<input class="form-control form-control-lg form-control-solid" type="password" placeholder="Confirm Password" name="confirm-password" autocomplete="off" data-kt-translate="sign-up-input-confirm-password" />
								</div>
								<div class="d-flex flex-stack">
									<button id="kt_sign_up_submit" class="btn btn-primary" data-kt-translate="sign-up-submit">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat" style="background-image: url(assets/media/auth/bg11.png)"></div>
			</div>
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/js/custom/authentication/sign-up/general.js"></script>
		<script src="assets/js/custom/authentication/sign-in/i18n.js"></script>
	</body>
</html>