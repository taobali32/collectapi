<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/20
 * Time: 15:21
 */

namespace GatherProduct\Order\Jd;

use GatherProduct\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    public function handle()
    {
        echo 'jd order';
    }


}