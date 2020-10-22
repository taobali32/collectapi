<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:01
 */

namespace GatherProduct\User;

use GatherProduct\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \GatherProduct\User\TaoKe\Client              $taokeUserClient
 * @property \GatherProduct\User\Jd\Client                 $jdUserClient
 * @property \GatherProduct\User\Pdd\Client                $pddUserClient
 *
 */
class Application extends ServiceContainer
{
    protected $providers = [
        \GatherProduct\User\TaoKe\ServiceProvider::class,
        \GatherProduct\User\Jd\ServiceProvider::class,
        \GatherProduct\User\Pdd\ServiceProvider::class
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