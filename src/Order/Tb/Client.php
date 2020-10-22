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
        $url = 'http://api.web.21ds.cn/taoke/tbkOrderDetailsGet';

        $default = [
            'query_type' => 1,
            'order_scene' => 2,
            'start_time' => date('Y-m-d H:i:s', strtotime("-10 minute")),
            'end_time' => date('Y-m-d H:i:s'),
            'page_size' => 100,
            'page_no'   =>  1
        ];

        $param = array_merge($default, $param);

        return json_to_array($this->http()->request('GET',$url,[
            'query' => $param
        ])->getBody()->getContents());
    }

    /**
     * 导入退款订单(每分钟)
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/20
     * Time: 16:07
     */
    public function importMinuteRefundOrder($param = [])
    {
        $url = 'http://api.web.21ds.cn/taoke/tbkOrderDetailsGet?';

        $default = [
            'query_type' => 1, // 1：订单创建时间，2:订单付款时间，3:订单结算时间
            'tk_status' => 13,        // 12-付款，13-关闭，14-确认收货，3-结算成功;不传，表示所有状态
            'order_scene' => 2,
            'start_time' => date('Y-m-d H:i:s', strtotime("-5 minute")),
            'end_time' => date('Y-m-d H:i:s'),
            'page_size' => 50,
            'page_no'   =>  1
        ];

        $param = array_merge($default, $param);

        return json_to_array($this->http()->request('GET',$url,[
            'query' => $param
        ])->getBody()->getContents());
    }

    /**
     * 每隔5分钟结算订单
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/20
     * Time: 16:18
     */
    public function importTaoOrderCharge($param = [])
    {
        $default = [
            'page_size' =>  50,
            'query_type' => 3,        // 1：订单创建时间，2:订单付款时间，3:订单结算时间
            'tk_status' => 3,        // 12-付款，13-关闭，14-确认收货，3-结算成功;不传，表示所有状态
            'start_time' => date('Y-m-d H:i:s', strtotime("-5 minute")),
            'end_time' => date('Y-m-d H:i:s'),
            'order_scene' => 2,
        ];

        $url = 'http://api.web.21ds.cn/taoke/tbkOrderDetailsGet?';

        $param = array_merge($default, $param);

        return json_to_array($this->http()->request('GET',$url,[
            'query' => $param
        ])->getBody()->getContents());
    }
}