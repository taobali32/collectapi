<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:04
 */

namespace GatherProduct\User\Jd;

use Pimple\Container;
use Pimple\ServiceProviderInterface;


class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['jdUserClient'] = function ($app) {
            return new Client($app);
        };
    }
}