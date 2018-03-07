<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatsHelper
{
    public function convertToDate($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->toDateString();
    }

    public function convertToDateForSearch($date)
    {
        $date = Carbon::createFromFormat('m-d-Y', $date)->toDateString();
        return Carbon::parse($date);
    }
}