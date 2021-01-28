<?php
include_once 'header.php';
?>

<main class="content">
	<div class="container-fluid p-0">

		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3>انتشار <strong>پست</strong></h3>
			</div>

			<div class="col-auto ml-auto text-right mt-n1">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
					<li class="breadcrumb-item"><a href="https://penobit.com">پنوبیت</a></li>
						<li class="breadcrumb-item"><a href="<?php echo url(); ?>">پنیفای</a></li>
						<li class="breadcrumb-item active" aria-current="page">انتشار پست</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-8 col-xxl-9 d-flex">
				<div class="card flex-fill">
					<div class="card-header">

						<h5 class="card-title mb-0">صف ارسال پست</h5>
					</div>
					<table class="table table-hover my-0">
						<thead>
							<tr>
								<th>نوع پست</th>
								<th class="d-none d-xl-table-cell">تاریخ ایجاد</th>
								<th class="d-none d-xl-table-cell">تاریخ انتشار</th>
								<th>نتیجه</th>
								<th class="d-none d-md-table-cell">کپشن</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>پست اسلایدی</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-success">انجام شده</span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
							<tr>
								<td>استوری</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-danger">لغو شده</span></td>
								<td class="d-none d-md-table-cell">فاقد کپشن</td>
							</tr>
							<tr>
								<td>پست</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-success">انجام شده</span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
							<tr>
								<td>پست</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-warning">در حال انجام </span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
							<tr>
								<td>پست</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-success">Done</span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
							<tr>
								<td>پست</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-success">Done</span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
							<tr>
								<td>پست اسلایدی</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-success">Done</span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
							<tr>
								<td>پست اسلایدی</td>
								<td class="d-none d-xl-table-cell">01/01/2020</td>
								<td class="d-none d-xl-table-cell">31/06/2020</td>
								<td><span class="badge bg-warning">In progress</span></td>
								<td class="d-none d-md-table-cell">لورم ایپسوم</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-12 col-lg-4 col-xxl-3 d-flex">
				<div class="card flex-fill w-100">
					<div class="card-header">

						<h5 class="card-title mb-0">گزارش پست های ارسالی به صورت ماهانه</h5>
					</div>
					<div class="card-body d-flex w-100">
						<div class="align-self-center chart chart-lg">
							<canvas id="chartjs-dashboard-bar"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>
<?php include_once 'footer.php'; ?>