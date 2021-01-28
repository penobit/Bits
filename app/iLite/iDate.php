<?php
class iDate {
    private $timestamp;
    private $type;

    public function __construct($time = null, $type = null) {
        $this->set_time($time);
        $this->set_type($type);
    }

    public function set_type($type = null) {
        if (!$type) {
            return;
        }
        $this->type = $type ?: get_option('datetime_format');

        return $this;
    }

    public function create_timestamp($time = null) {
        empty($time) and $time = $this->timestamp;
        if (empty($time)) {
            $time = time();
        } elseif ($time and !is_numeric($time)) {
            if (substr($time, 0, 1) == '1') {
                $time = $this->to_gregorian($time);
            }
            $time = strtotime($time);
        }

        return $time;
    }

    public function set_time($time = null) {
        $time = $this->create_timestamp($time);
        $this->timestamp = $time;

        return $this;
    }

    public function english_date($time = null, $type = null) {
        $time = $this->create_timestamp($time);
        $type = $this->type ?: ($type ?: get_option('datetime_format'));

        return date($type, $time);
    }

    public function date($time = null, $type = null) {
        $this->set_time($time);
        $this->set_type($type);

        $time = $this->timestamp;
        $type = $this->type;

        switch (get_language()) {
            case 'fa':
                $date = $this->persian_date($time, $type);

                break;
            default:
                $date = date($type, $time);

                break;
        }

        return $date;
    }

    public function persian_month($month) {
        switch ($month) {
            case '1':return 'فروردین';
            break;
            case '2':return 'اردیبهشت';
            break;
            case '3':return 'خرداد';
            break;
            case '4':return 'تیر';
            break;
            case '5':return 'مرداد';
            break;
            case '6':return 'شهریور';
            break;
            case '7':return 'مهر';
            break;
            case '8':return 'آبان';
            break;
            case '9':return 'آذر';
            break;
            case '10':return 'دی';
            break;
            case '11':return 'بهمن';
            break;
            case '12':return 'اسفند';
            break;
        }

        return false;
    }

    public function persian_weekday($enDay) {
        switch ($enDay) {
            case 'Saturday':return 'شنبه';
            break;
            case 'Sunday':return 'یکشنبه';
            break;
            case 'Monday':return 'دوشنبه';
            break;
            case 'Tuesday':return 'سه‌شنبه';
            break;
            case 'Wednesday':return 'چهار‌شنبه';
            break;
            case 'Thursday':return 'پنج‌شنبه';
            break;
            case 'Friday':return 'جمعه';
            break;
        }

        return false;
    }

    public function persian_weekday_number($enDay) {
        switch ($enDay) {
            case 'Saturday':return '0';
            break;
            case 'Sunday':return '1';
            break;
            case 'Monday':return '2';
            break;
            case 'Tuesday':return '3';
            break;
            case 'Wednesday':return '4';
            break;
            case 'Thursday':return '5';
            break;
            case 'Friday':return '6';
            break;
        }

        return false;
    }

    public function persian_date($time = null, $type = null) {
        $this->set_time($time);
        $this->set_type($type);
        $time = $this->timestamp;
        $type = $this->type ?: ($type ?: get_option('datetime_format'));
        $date = date('Y-m-d', $time);
        [$g_y, $g_m, $g_d] = explode(substr($date, 4, 1), $date);
        $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        $gy = $g_y - 1600;
        $gm = $g_m - 1;
        $gd = $g_d - 1;
        $g_day_no = 365 * $gy + $this->divide($gy + 3, 4) - $this->divide($gy + 99, 100) + $this->divide($gy + 399, 400);
        for ($i = 0; $i < $gm; ++$i) {
            $g_day_no += $g_days_in_month[$i];
        }
        if (1 < $gm && ((0 == $gy % 4 && 0 != $gy % 100) || (0 == $gy % 400))) {
            ++$g_day_no;
        }
        $g_day_no += $gd;
        $j_day_no = $g_day_no - 79;
        $j_np = $this->divide($j_day_no, 12053);
        $j_day_no = $j_day_no % 12053;
        $jy = 979 + 33 * $j_np + 4 * $this->divide($j_day_no, 1461);
        $j_day_no %= 1461;
        if (366 <= $j_day_no) {
            $jy += $this->divide($j_day_no - 1, 365);
            $j_day_no = ($j_day_no - 1) % 365;
        }
        for ($i = 0; 11 > $i && $j_day_no >= $j_days_in_month[$i]; ++$i) {
            $j_day_no -= $j_days_in_month[$i];
        }
        $jm = $i + 1;
        $jd = $j_day_no + 1;
        $hour = date('H', $time);
        $minute = date('i', $time);
        $second = date('s', $time);
        $weekDay = date('l', $time);
        // $weekDayNumber = date('N', $time);

        return str_replace(['Y', 'y', 'm', 'd', 'H', 'i', 's', 'M', 'F', 'l', 'D', 'N'], [$jy, substr($jy, 2), $jm, $jd, $hour, $minute, $second, $this->persian_month($jm), $this->persian_month($jm), $this->persian_weekday($weekDay), $this->persian_weekday($weekDay), $this->persian_weekday_number($weekDay)], $type);
    }

    public function to_gregorian($persian_date = null) {
        $persian_date = 1 == substr($persian_date, 0, 1) ? $persian_date : $this->persian_date(time(), 'Y-m-d');
        $persian_date = explode(' ', $persian_date);
        $expl = explode(substr($persian_date[0] ?? '', 4, 1), $persian_date[0] ?? '') ?: '-';
        if ($persian_date[1] ?? '') {
            $clock = explode(':', $persian_date[1] ?? '');
            [$hour, $minute, $second] = $clock;
        }
        $hour = $hour ?? date('H', time());
        $minute = $minute ?? date('i', time());
        $second = $second ?? date('s', time());
        if ($persian_date[2] ?? '') {
            $extra = $persian_date[2] ?? '';
        }
        [$j_y, $j_m, $j_d] = $expl;
        $j_m = $j_m ?? 1;
        $j_d = $j_d ?? 1;
        $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        $jy = $j_y - 979;
        $jm = $j_m - 1;
        $jd = $j_d - 1;
        $j_day_no = 365 * $jy + $this->Divide($jy, 33) * 8 + $this->Divide($jy % 33 + 3, 4);
        for ($i = 0; $i < $jm; ++$i) {
            $j_day_no += $j_days_in_month[$i];
        }
        $j_day_no += $jd;
        $g_day_no = $j_day_no + 79;
        $gy = 1600 + 400 * $this->Divide($g_day_no, 146097);
        $g_day_no = $g_day_no % 146097;
        $leap = true;
        if (36525 <= $g_day_no) {
            --$g_day_no;
            $gy += 100 * $this->Divide($g_day_no, 36524);
            $g_day_no = $g_day_no % 36524;
            if (365 <= $g_day_no) {
                ++$g_day_no;
            } else {
                $leap = false;
            }
        }
        $gy += 4 * $this->Divide($g_day_no, 1461);
        $g_day_no %= 1461;
        if (366 <= $g_day_no) {
            $leap = false;
            --$g_day_no;
            $gy += $this->Divide($g_day_no, 365);
            $g_day_no = $g_day_no % 365;
        }
        for ($i = 0; $g_days_in_month[$i] + (1 == $i && $leap) <= $g_day_no; ++$i) {
            $g_day_no -= $g_days_in_month[$i] + (1 == $i && $leap);
        }
        $gm = $i + 1;
        $gd = $g_day_no + 1;
        $timee = "{$gy}-{$gm}-{$gd} {$hour}:{$minute}:{$second}";
        if (isset($extra)) {
            $timee .= " {$extra}";
        }

        return $timee;
    }

    private function divide($a, $b) {
        return (int) ($a / $b);
    }
}