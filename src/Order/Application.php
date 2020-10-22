<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:01
 */

namespace GatherProduct\Order;
use GatherProduct\Kernel\ServiceContainer;


/**
 * Class Application.
 *
 * @property \GatherProduct\Order\Tb\Client              $tbOrder
 * @property \GatherProduct\Order\Jd\Client              $jdOrder
 * @property \GatherProduct\Order\Pdd\Client             $pddOrder
 *
 */
class Application extends ServiceContainer
{
    protected $providers = [
        \GatherProduct\Order\Tb\ServiceProvider::class,
        \GatherProduct\Order\Jd\ServiceProvider::class,
        \GatherProduct\Order\Pdd\ServiceProvider::class,
    ];

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this['base'], $name], $arguments);
    }
}