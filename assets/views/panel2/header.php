<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="AdminKit">
    <link rel="shortcut icon" href="/app/views/panel/img/icons/icon-48x48.png" />
    <title>پنل مدیریت شبکه اجتماعی پنوبیت</title>
    <link href="<?= url('app/views/panel/css/app.rtl.min.css');?>" rel="stylesheet">
    <link href="<?= url('assets/fonts/fonts.css');?>" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include_once 'sidebar.php'; ?>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                <img src="/app/views/panel/img/avatars/avatar.jpg" class="avatar img-fluid rounded mr-1" alt="Charles Hall" />
                                <span class="text-dark">پنوبیت</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#pages-profile.html">
                                    <i class="align-middle mr-1" data-feather="user"></i> حساب کاربری من</a>
                                <a class="dropdown-item" href="#">
                                    <i class="align-middle mr-1" data-feather="pie-chart"></i> گزارش</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#pages-settings.html">
                                    <i class="align-middle mr-1" data-feather="settings"></i> تنظیمات و حریم شخصی</a>
                                <a class="dropdown-item" href="#">
                                    <i class="align-middle mr-1" data-feather="help-circle"></i> مرکز خدمات</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">خروج از حساب کاربری</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 پیغام جدید
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">بروزرسانی تکمیل شد</div>
                                                <!-- <div class="text-muted small mt-1">Restart server 12 to complete the update.</div> -->
                                                <div class="text-muted small mt-1">30 دقیقه قبل</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">لورم ایپسوم</div>
                                                <div class="text-muted small mt-1">لورم ایپسوم متنی است ساختگی</div>
                                                <div class="text-muted small mt-1">2 ساعت قبل</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">ورود با شناسه 192.186.1.1</div>
                                                <div class="text-muted small mt-1">5 ساعت قبل</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">اتصال جدید</div>
                                                <!-- <div class="text-muted small mt-1">Christina accepted your request.</div> -->
                                                <div class="text-muted small mt-1">14 ساعت پیش</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">نمایش تمام اطلاعیه ها</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 پیام جدید
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="/app/views/panel/img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 pl-2">
                                                <div class="text-dark">امیر</div>
                                                <div class="text-muted small mt-1">لورم ایپسوم متنی است ساختگی</div>
                                                <div class="text-muted small mt-1">15 دقیقه قبل</div>
                                            </div>
                                        </div>
                                    </a>



                                    <div class="dropdown-menu-footer">
                                        <a href="#" class="text-muted">نمایش همه پیام ها</a>
                                    </div>
                                </div>
                        </li>

                    </ul>
                    </div>
                </div>
                <form class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="جستجو..." aria-label="Search">
                        <button class="btn" type="button">
                            <i class="align-middle" data-feather="search"></i>
                        </button>
                    </div>
                </form>
            </nav>