<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 16:51
 */

namespace GatherProduct;

use GatherProduct\Kernel\Support\Str;
use function Couchbase\defaultDecoder;

/**
 * Class Factory.
 *
 * @method static \GatherProduct\Collect\Application            collect(array $config)
 * @method static \GatherProduct\User\Application               user(array $config)
 * @method static \GatherProduct\Order\Application              order(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return \GatherProduct\Kernel\ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = Str::studly($name);
        $application = "\\GatherProduct\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}