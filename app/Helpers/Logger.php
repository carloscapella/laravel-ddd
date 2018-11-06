<?php
/**
 * File Logger.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Helpers;


use Illuminate\Support\Facades\Log;

class Logger
{

    public static function error(OperationStatus $opStatus): void
    {
        Log::error($opStatus->exceptionMessage . PHP_EOL . $opStatus->exceptionStackTrace);
    }
}
