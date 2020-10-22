<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 18:12
 */

namespace GatherProduct\Kernel\Events;

use GatherProduct\Kernel\ServiceContainer;

class ApplicationInitialized
{
    /**
     * @var \GatherProduct\Kernel\ServiceContainer
     */
    public $app;

    /**
     * @param \GatherProduct\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }
}