<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="پنل مدیریت شبکه اجتماعی پنوبیت، به صورت خودکار شبکه های اجتماعی خود را رشد دهید. زمانبندی پست ها، ارسال خودکار پست، لایک و کامنت خودکار">
	<meta name="author" content="Penobit">
	<meta name="keywords" content="penobit, penify, penosocial, پنوبیت,پنوسوشال,پنیفای,مدیریت اینستاگرام,ربات اینستاگرام,رشد اینستاگرام,زمانبندی پست ها, ارسال خودکار پست, لایک و کامنت خودکار,لایک خودکار, کامنت خودکار, دایرکت خودکار,زمان بندی پست ها, زمانبندی پست ها,ارسال خودکار پست">

	<link rel="shortcut icon" href="/app/views/panel/img/icons/icon-48x48.png" />

	<title>ورود - پنل مدیریت شبکه اجتماعی پنوبیت</title>

	<link href="/app/views/panel/css/app.rtl.min.css" rel="stylesheet">
	<link href="/assets/fonts/fonts.css" rel="stylesheet">


</head>

<body data-theme="default" data-layout="fluid" data-sidebar="left">
	<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">پنل مدیریت شبکه اجتماعی پنوبیت</h1>
							<p class="lead">
								برای ادامه به حساب کاربری خود وارد شوید
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="/app/views/panel/img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132"
										/>
									</div>
									<form>
										<div class="mb-3">
											<label class="form-label">نام کاربری</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="نام کاربری / شماره تلفن / ایمیل" />
										</div>
										<div class="mb-3">
											<label class="form-label">رمز عبور</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="رمز عبور" />
											<small>
												<a href="<?php echo url('auth/forget-password'); ?>">رمز خود را فراموش کردید؟</a>
											</small>
										</div>
										<div class="text-center mt-3">
											<!-- <a href="/app/views/panel/index.html" class="btn btn-lg btn-primary">ورود</a> -->
											<button type="submit" class="btn btn-lg btn-primary">ورود</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
	<script src="js/login.js"></script>
</body>

</html>