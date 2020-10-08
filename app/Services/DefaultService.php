<?php

namespace App\Services;

use App\Traits\Audit;
use App\Traits\Pagination;
use Illuminate\Support\Facades\DB;

abstract class DefaultService implements ServiceInterface
{
    use Audit;
    use Pagination;

    public function __construct()
    {
        $this->results = ['error' => null, 'code' => null, 'message' => null, 'data' => null];
    }

    abstract protected function process($data);


    public function execute($inputData)
    {
        $timeStart = microtime(true);
        DB::beginTransaction();
        try {
            $this->process($inputData);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            $this->results['error'] = $ex;
            $this->results['code'] = FAILURE_CODE;
            $this->results['message'] = $ex->getFile() . " " . $ex->getLine() . ": " . $ex->getMessage();
        }

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $micro = $diff - $sec;
        $this->results['request_time'] = round($micro * 1000, 4) . " ms";

        return $this->results;
    }
}
