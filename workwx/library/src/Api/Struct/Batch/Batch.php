<?php

namespace addons\workwx\library\src\Api\Struct\Batch;

use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Utils;

class Batch
{

    /**
     * @param $batchJobArgs
     *
     * @throws ParameterError
     */
    static public function CheckBatchJobArgs($batchJobArgs)
    {
        Utils::checkNotEmptyStr($batchJobArgs->media_id, "media_id");
    }

    /**
     * @param $arr
     *
     * @return BatchJobResult
     */
    static public function Array2BatchJobResult($arr)
    {
        $batchJobResult = new BatchJobResult();

        $batchJobResult->status = utils::arrayGet($arr, "status");
        $batchJobResult->type = utils::arrayGet($arr, "type");
        $batchJobResult->total = utils::arrayGet($arr, "total");
        $batchJobResult->percentage = utils::arrayGet($arr, "percentage");
        $batchJobResult->result = utils::arrayGet($arr, "result");

        return $batchJobResult;
    }

    /**
     * @param $batchJobResult
     *
     * @return bool
     */
    static public function IsJobFinished($batchJobResult)
    {
        return !is_null($batchJobResult->status) && $batchJobResult->status == BatchJobResult::STATUS_FINISHED;
    }
} // class Batch