<?php
include_once 'header.php';
$date = new iDate();
?>

	<main class="content">
		<div class="container-fluid p-0">

			<div class="row mb-2 mb-xl-3">
				<div class="col-auto d-none d-sm-block">
					<h3>تقویم
						<strong>محتوا</strong>
					</h3>
				</div>

				<div class="col-auto ml-auto text-right mt-n1">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
							<li class="breadcrumb-item">
								<a href="https://penobit.com">پنوبیت</a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo url(); ?>">پنیفای</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">تقویم محتوا</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="calendar">
				<div class="calendar-inner">
					<?php $requestedDate = sprintf('%d-%d-%d', isset($_GET['year']) && !empty($_GET['year']) ? $_GET['year'] : $date->persian_date(time(), 'Y'), isset($_GET['month']) && !empty($_GET['month']) ? $_GET['month'] : $date->persian_date(time(), 'm'), isset($_GET['day']) && !empty($_GET['day']) ? $_GET['day'] : $date->persian_date(time(), 'd'));
                $year = $date->persian_date($requestedDate, 'Y');
                $month = $date->persian_date($requestedDate, 'm');
                $monthName = $date->persian_date($requestedDate, 'M');
                $nextMonth = 12 < (isset($_GET['month']) && !empty($_GET['month']) ? $_GET['month'] : $date->persian_date(time(), 'm')) + 1 ? 1 : (isset($_GET['month']) && !empty($_GET['month']) ? $_GET['month'] : $date->persian_date(time(), 'm')) + 1;
                $lastMonth = 1 > (isset($_GET['month']) && !empty($_GET['month']) ? $_GET['month'] : $date->persian_date(time(), 'm')) - 1 ? 12 : (isset($_GET['month']) && !empty($_GET['month']) ? $_GET['month'] : $date->persian_date(time(), 'm')) - 1;
                ?>
					<div class="month">
						<ul>
							<li class="next">
								<a href="<?php echo '/panel/calendar?month='.$nextMonth; ?>">&#10094;</a>
							</li>
							<li class="prev">
								<a href="<?php echo '/panel/calendar?month='.$lastMonth; ?>">&#10095;</a>
							</li>
							<li>
								<?php echo $monthName; ?>
								<br>
								<span style="font-size:18px">
									<?php echo $year; ?>
								</span>
							</li>
						</ul>
					</div>

					<ul class="weekdays">
						<li>شنبه</li>
						<li>یک شنبه</li>
						<li>دو شنبه</li>
						<li>سه شنبه</li>
						<li>چهار شنبه</li>
						<li>پنج شنبه</li>
						<li>جمعه</li>
					</ul>

					<div class="days">
						<?php
                    $currentMotnStartDate = $date->persian_date($requestedDate, 'Y-m-1');
                    $weekDayOffset = $date->persian_date($currentMotnStartDate, 'N');
					$today = $date->persian_date($requestedDate, 'd');
					$lastMonthLastDay = $month - 1 <= 6 ? 31 : 30;
					$disableds = [];
                    for ($i = 0; $i < $weekDayOffset; ++$i) {
						$disabledDayNumber = $lastMonthLastDay - $i;
                        $disableds[] = "<a href=\"/panel/calendar?month=$lastMonth\" class=\"disabled\"><span class=\"day-number\">{$disabledDayNumber}</span></a>";
					}
					echo join('', array_reverse($disableds));
                    foreach (range(1, 6 >= $month ? 31 : 30) as $day) {
						$thisDate = sprintf('%s-%s-%s', $year, $month, $day);
						$weekdayName = $date->persian_date($thisDate, 'D');
                        $class = $schedules = '';
                        if ($day == $today) {
                            $class = 'day active';
						}else{
							$class = "day";
						}
						if($day === 3 || $day === 18){
							$schedules = '<div class="calendar-schedules">
								<span class="total-schedules">'.rand(1, $day).' پست</span>
								<div class="schedule-data">
									<span>
										<strong>ارسال شده: <small>4</small></strong>
										<strong>زمانبندی شده: <small>3</small></strong>
										<strong>خطا: <small>1</small></strong>
									</span>
								</div>
							</div>';
						}
						
                        echo "<a class=\"$class\"><span class=\"day-number\">{$day}</span><span class=\"weekday-name\">{$weekdayName}</span>{$schedules}</a>";
                    }
                    ?>
					</div>
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
									<td>
										<span class="badge bg-success">انجام شده</span>
									</td>
									<td class="d-none d-md-table-cell">لورم ایپسوم</td>
								</tr>
								<tr>
									<td>استوری</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-danger">لغو شده</span>
									</td>
									<td class="d-none d-md-table-cell">فاقد کپشن</td>
								</tr>
								<tr>
									<td>پست</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-success">انجام شده</span>
									</td>
									<td class="d-none d-md-table-cell">لورم ایپسوم</td>
								</tr>
								<tr>
									<td>پست</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-warning">در حال انجام </span>
									</td>
									<td class="d-none d-md-table-cell">لورم ایپسوم</td>
								</tr>
								<tr>
									<td>پست</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-success">Done</span>
									</td>
									<td class="d-none d-md-table-cell">لورم ایپسوم</td>
								</tr>
								<tr>
									<td>پست</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-success">Done</span>
									</td>
									<td class="d-none d-md-table-cell">لورم ایپسوم</td>
								</tr>
								<tr>
									<td>پست اسلایدی</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-success">Done</span>
									</td>
									<td class="d-none d-md-table-cell">لورم ایپسوم</td>
								</tr>
								<tr>
									<td>پست اسلایدی</td>
									<td class="d-none d-xl-table-cell">01/01/2020</td>
									<td class="d-none d-xl-table-cell">31/06/2020</td>
									<td>
										<span class="badge bg-warning">In progress</span>
									</td>
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
	</main>
	<?php include_once 'footer.php'; ?>