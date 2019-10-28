<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Utils\JSONResponse;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, JSONResponse;

    public function modifyDate($value = "")
    {
        return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    
    public function fullDateModify($var = "")
    {
        $newDate = explode(" ", $var);
        $date = Carbon::createFromFormat('d/m/Y', $newDate[0])->format('Y-m-d');
        $time = Carbon::createFromTimeString($newDate[1])->format('H:i:s');
        $fullDate = Carbon::parse($date.$time)->toDateTimeString();
        return $fullDate;
    }
}
