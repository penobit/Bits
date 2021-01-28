<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">
        <a class="sidebar-brand text-center font-titr" href="/">
            <span class="align-middle">پنیــفای</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item<?= $page =='index' ? ' active' : '';?>">
                <a class="sidebar-link" href="<?php echo url('panel'); ?>">
                    <i class="align-middle" data-feather="sliders"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">پیشخوان</span>
                </a>
            </li>

            <li class="sidebar-header">پست ها</li>
            <li class="sidebar-item<?= $page =='publish' ? ' active' : '';?>">
                <a class="sidebar-link" href="<?php echo url('panel/publish'); ?>">
                    <i class="align-middle" data-feather="plus-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">انتشار پست</span>
                </a>
            </li>

            <li class="sidebar-item<?= $page =='media' ? ' active' : '';?>">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="paperclip"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">رسانه ها</span>
                </a>
            </li>

            <li class="sidebar-item<?= $page =='calendar' ? ' active' : '';?>">
                <a class="sidebar-link" href="<?php echo url('panel/calendar'); ?>">
                    <i class="align-middle" data-feather="calendar"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">تقویم محتوا</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="file-text"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">کپشن ها</span>
                </a>
            </li>

            <li class="sidebar-header">حساب ها</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="users"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">حساب های کاربری</span>
                </a>
            </li>

            <li class="sidebar-header">امکانات خودکار</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="thumbs-up"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">لایک خودکار</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="message-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">کامنت خودکار</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="user-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">دنبال کردن خودکار</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="user-minus"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">آنفالو خودکار</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="message-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">دایرکت خودکار</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="star"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">خوش آمد گویی خودکار</span>
                </a>
            </li>
            <li class="sidebar-header">ابزار ها</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="hash"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">تولید کننده هشتگ</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo url('panel/media'); ?>">
                    <i class="align-middle" data-feather="trending-up"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">آمار پیشرفته</span>
                </a>
            </li>

            <li class="sidebar-header">پنیفای</li>
            <li class="sidebar-item<?= $page =='settings' ? ' active' : '';?>">
                <a class="sidebar-link" href="<?php echo url('panel/settings'); ?>">
                    <i class="align-middle" data-feather="settings"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">تنظیمات</span>
                </a>
            </li>

            <li class="sidebar-item<?= $page =='profile' ? ' active' : '';?>">
                <a class="sidebar-link" href="<?php echo url('panel/profile'); ?>">
                    <i class="align-middle" data-feather="user"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">پروفایل</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-target="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="align-middle">اشتراک پنیفای</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-alerts.html">صورتحساب‌ها</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-buttons.html">ارتقاء حساب</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-cards.html">پشتیبانی</a>
                    </li>
                </ul>
            </li>


        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary btn-block">Upgrade to Pro</a>
            </div>
        </div>
    </div>
</nav>