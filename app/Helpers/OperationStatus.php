<?php
/**
 * File OperationStatus.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Helpers;


class OperationStatus
{
    public $status;
    public $recordsAffected;
    public $message;
    // Null when multiple records are selected
    public $operationID;
    public $httpStatusCode;
    // Collection when multiple records are selected
    public $entityObject;
    // Tracking exceptions
    public $exceptionMessage;
    public $exceptionStackTrace;

    /**
     * OperationStatus constructor.
     */
    public function __construct()
    {
    }


    /**
     * @param string $message
     * @param \Exception $ex
     * @return OperationStatus
     */
    public static function CreateFromException(string $message, \Exception $ex): OperationStatus
    {
        $opStatus = new OperationStatus();
        $opStatus->status = false;
        $opStatus->message = $message;

        if ($ex != null)
        {
            $opStatus->exceptionMessage = $ex->getMessage() ?? '';
            $opStatus->exceptionStackTrace = $ex->getTraceAsString() ?? '';
        }

        return $opStatus;
    }
}
