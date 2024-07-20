<?php
namespace App\Utils;

use Illuminate\Support\Facades\Log;
use ReflectionClass;

class LogHelper {
    public static function logError($object,\Exception $e) {
        $reflector = new ReflectionClass($object);
        $className = $reflector->getShortName();
        $trace = debug_backtrace();
        $methodName = $trace[1]['function'];

        Log::error("{$className}@{$methodName}: " . $e->getMessage());
    }
}
