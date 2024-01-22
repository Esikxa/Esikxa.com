<?php

namespace App\Helpers;

use Carbon\Carbon;

class CommonHelper
{
    public static function dateFormat($date, $format = 6)
    {
        if ($date == '0000-00-00' || $date == '0000-00-00 00:00:00' || $date == null) {
            return 'N.A.';
        }
        $format = empty($format) ? ConstantHelper::DEFAULT_DATE_FORMAT : $format;
        switch ($format) {
            case "1":
                return Carbon::parse($date)->format('l, F jS, Y');
            case "2":
                return Carbon::parse($date);
            case "3":
                return Carbon::parse($date)->format('D jS M Y g:ia');
            case "4":
                return Carbon::parse($date)->format('D j M Y');
            case "5":
                return Carbon::parse($date)->format('M j, Y g:i a');
            case "6":
                return Carbon::parse($date)->format('d M, Y');
            case "7":
                return Carbon::parse($date)->format('M j, Y');
            case "8":
                return Carbon::parse($date)->format('g:i A');
            case "9":
                return Carbon::parse($date)->format('Y');
            case "10":
                return Carbon::parse($date)->format('m/d');
            case "11":
                return Carbon::parse($date)->format('Y/m/d');
            case "12":
                return Carbon::parse($date)->format('M j, Y');
            case 13:
                return Carbon::parse($date)->format('d');
            case 14:
                return Carbon::parse($date)->format('m');
            case 15:
                return Carbon::parse($date)->format('M');
            case 16:
                return Carbon::parse($date)->format('Y-m-d');
            case 17:
                return Carbon::parse($date)->format('Y-m-d H:i:s');
            case 18:
                return Carbon::parse($date)->format('YmdHis');
            case 19:
                return Carbon::parse($date)->format('Ymd');
            case 20:
                return Carbon::parse($date)->diffForHumans();
            case 21:
                return Carbon::parse($date)->format('M j, Y | g:ia');
            default:
                return substr($date, 0, 10);
        }
    }
    public static function shortText($string, $limit = null)
    {
        $limit = empty($limit) ? 60 : $limit;
        if (strlen($string) < $limit) {
            $string = strip_tags($string);
        } else {
            $text = strip_tags($string);
            $cutText = substr($text, 0, $limit);
            $lastSpace = strrpos($cutText, " ");
            $shortText = substr($cutText, 0, $lastSpace);
            $string = $shortText . '...';
        }
        return $string = strip_tags($string);
    }
    public static function requestTutorStatus($status)
    {
        switch ($status) {
            case ConstantHelper::REQUEST_TUTOR_PENDING:
                return 'PENDING';
            case ConstantHelper::REQUEST_TUTOR_ADMIN_APPROVED:
                return 'ADMIN APPROVED';
            case ConstantHelper::REQUEST_TUTOR_ADMIN_CANCELLED:
                return 'ADMIN CANCELLED';
            case ConstantHelper::REQUEST_TUTOR_TEACHER_APPROVED:
                return 'TEACHER APPROVED';
            case ConstantHelper::REQUEST_TUTOR_TEACHER_CANCELLED:
                return 'TEACHER CANCELLED';
            case ConstantHelper::REQUEST_TUTOR_ONGOING:
                return 'ONGOING';
            case ConstantHelper::REQUEST_TUTOR_COMPLETED:
                return 'COMPLETED';
            case ConstantHelper::REQUEST_TUTOR_STUDENT_CANCELLED:
                return 'STUDENT CANCELLED';
            default:
                return 'PENDING';
        }
    }
}
