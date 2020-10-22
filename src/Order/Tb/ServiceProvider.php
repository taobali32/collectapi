<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/20
 * Time: 15:21
 */

namespace GatherProduct\Order\Tb;
use Pimple\ServiceProviderInterface;
use Pimple\Container;


class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['tbOrder'] = function ($app) {
            return new Client($app);
        };
    }
}