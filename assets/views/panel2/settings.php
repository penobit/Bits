<?php include_once('header.php');?>
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">تنظیمات کاربری</h1>

		<div class="row">
			<div class="col-md-3 col-xl-2">

				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">تکمیل مشخصات فردی</h5>
					</div>

					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
							اطلاعات فردی
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
							رمز عبور
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
							حریم شخصی
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
							اطلاعیه ایمیل
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
							اطلاعیه پیامک
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
							ابزارها
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
							اطلاعات شما
						</a>
						<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
							حذف اکانت کاربری
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-9 col-xl-10">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="account" role="tabpanel">

						<div class="card">
							<div class="card-header">

								<h5 class="card-title mb-0">اطلاعات عمومی</h5>
							</div>
							<div class="card-body">
								<form>
									<div class="row">
										<div class="col-md-8">
											<div class="mb-3">
												<label class="form-label" for="inputUsername">نام کاربری</label>
												<input type="text" class="form-control" id="inputUsername" placeholder="نام کاربری">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputUsername">توضیحات</label>
												<textarea rows="2" class="form-control" id="inputBio" placeholder="در مورد علایق خود متنی بنویسید"></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="text-center">
												<img alt="Charles Hall" src="/app/views/panel/img/avatars/avatar.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128"
												/>
												<div class="mt-2">
													<span class="btn btn-primary">
														<i class="fas fa-upload"></i> بارگزاری</span>
												</div>
												<small>لطفاً اندازه تصویر جهت بارگزاری 128*128 پیکسل باشد و با پسوند .jpg</small>
											</div>
										</div>
									</div>

									<button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
								</form>

							</div>
						</div>

						<div class="card">
							<div class="card-header">

								<h5 class="card-title mb-0">مشخصات فردی</h5>
							</div>
							<div class="card-body">
								<form>
									<div class="row">
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputFirstName">نام</label>
											<input type="text" class="form-control" id="inputFirstName" placeholder="نام">
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputLastName">نام خانوادگی</label>
											<input type="text" class="form-control" id="inputLastName" placeholder="نام خانوادگی">
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputNationalCode">کد ملی</label>
											<input type="text" class="form-control" id="inputNationalCode" placeholder="کد ملی">
										</div>
									</div>

									<div class="row">
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputMobile">شماره تلفن همراه</label>
											<input type="tel" class="form-control" id="inputMobile" placeholder="شماره تلفن همراه">
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputPhone">شماره تلفن ثابت</label>
											<input type="tel" class="form-control" id="inputPhone" placeholder="شماره تلفن ثابت">
										</div>
										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputPhone2">شماره تلفن پشتیبان</label>
											<input type="tel" class="form-control" id="inputPhone2" placeholder="شماره تلفن پشتیبان">
										</div>
									</div>
									<div class="row">

										<div class="mb-3 col-md-4">
											<label class="form-label" for="inputState">استان</label>
											<select id="inputState" class="form-control">
												<option selected>انتخاب</option>
												<option>تهران</option>
												<option>البرز</option>
												<option>شیراز</option>
												<option>اصفهان</option>
												<option>تبریز</option>
												<option>قم</option>
											</select>
										</div>
										<div class="mb-3 col-md-6">
											<label class="form-label" for="inputCity">شهر</label>
											<input type="text" class="form-control" id="inputCity">
										</div>
										<div class="mb-3 col-md-2">
											<label class="form-label" for="inputZip">کد پستی</label>
											<input type="text" class="form-control" id="inputZip">
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label" for="inputAddress">آدرس</label>
										<input type="text" class="form-control" id="inputAddress" placeholder="تهران، خیابان یکم...">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputAddress2">آدرس جایگزین</label>
										<input type="text" class="form-control" id="inputAddress2" placeholder="تهران، خیابان یکم...">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputEmail4">ایمیل</label>
										<input type="email" class="form-control" id="inputEmail4" placeholder="ایمیل">
									</div>
									<button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
								</form>

							</div>
						</div>

					</div>
					<div class="tab-pane fade" id="password" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">رمز عبور</h5>

								<form>
									<div class="mb-3">
										<label class="form-label" for="inputPasswordCurrent">رمز فعلی</label>
										<input type="password" class="form-control" id="inputPasswordCurrent">
										<small>
											<a href="#">رمز عبور خود را فراموش کرده ام</a>
										</small>
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputPasswordNew">رمز جدید</label>
										<input type="password" class="form-control" id="inputPasswordNew">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputPasswordNew2">تایید رمز عبور</label>
										<input type="password" class="form-control" id="inputPasswordNew2">
									</div>
									<button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>

<?php include_once('footer.php');?>