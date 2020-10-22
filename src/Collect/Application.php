<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:01
 */

namespace GatherProduct\Collect;


use GatherProduct\Collect\Jd\ServiceProvider;
use GatherProduct\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \GatherProduct\Collect\TaoKe\Client              $taoke
 * @property \GatherProduct\Collect\Jd\Client                 $jd
 * @property \GatherProduct\Collect\Pdd\Client                $pdd

 *
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ServiceProvider::class,
        \GatherProduct\Collect\Pdd\ServiceProvider::class,
        \GatherProduct\Collect\TaoKe\ServiceProvider::class
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