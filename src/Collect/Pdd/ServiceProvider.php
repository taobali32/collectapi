<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:04
 */

namespace GatherProduct\Collect\Pdd;

use Pimple\Container;
use Pimple\ServiceProviderInterface;


class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['pdd'] = function ($app) {
            return new Client($app);
        };
    }
}