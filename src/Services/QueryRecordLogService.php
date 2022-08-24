<?php

namespace Cirelramos\Logs\Services;

use Cirelramos\Logs\Facades\LogConsoleFacade;
use DateTime;
use Exception;
use Illuminate\Support\Str;

/**
 *
 */
class QueryRecordLogService
{

    /**
     * @param $query
     * @param $parametersBindings
     * @return void
     * @throws Exception
     */
    public static function execute($query, $parametersBindings)
    {
        if (config('logs.query_log_is_active') === false) {
            return;
        }
        if ($query !== null) {
            $queryActive = request()->header("XH5xcpfecS7HtsEV7BsP90IJ3aA4axV");
            if ($queryActive != null) {
                $contains = Str::contains($query, "select");
                if ($contains === false) {
                    $bindings = array_map(static function ($value) {
                        if ($value instanceof DateTime) {
                            return $value->format('Y-m-d H:i:s');
                        }
                        return $value;
                    }, $parametersBindings);

                    $sql          = $query;
                    $queryBinding = "";
                    foreach ($bindings as $binding) {
                        $queryBinding .= $binding . ', ';
                        $value        = is_numeric($binding) ? $binding : "'$binding'";
                        $sql          = preg_replace('/\?/', $value, $sql, 1);
                    }
                    $queryActive = request()->header("XH5xcpfecS7HtsEV7BsP90IJ3aA4axV");
                    $extraValues = [
                        'query_active' => $queryActive,
                    ];
                    $sql = Str::replace(array("\r", "\n"), " ", $sql);
                    LogConsoleFacade::full()->log('query complete: ' . $sql, $extraValues);
                    throw new Exception("disable query");
                }
            }
        }

    }
}
