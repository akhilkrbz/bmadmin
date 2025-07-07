<?php

namespace App\traits;

trait Common
{
    public function getCurrentDate()
    {
        return date('Y-m-d');
    }

    public function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    public function formatDate($format, $date)
    {
        return date($format, strtotime($date));
    }
}
