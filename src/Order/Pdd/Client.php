<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/20
 * Time: 15:21
 */

namespace GatherProduct\Order\Pdd;

use GatherProduct\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    /**
     * 每分钟导入订单
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/20
     * Time: 15:39
     */
    public function importMinuteOrder($param = [])
    {
        $param = array_merge($param,[
            'page_size' =>  100
        ]);

        dd($param);
    }
}