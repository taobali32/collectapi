<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/13
 * Time: 9:47
 */

namespace GatherProduct\Kernel\Support;

use GuzzleHttp\Client;

class BaseClient
{
    public function http(){
        return new Client();
    }

    /**
     * 拼多多签名
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/15
     * Time: 17:23
     */
    public function pddSign()
    {
        $param = func_get_args()[0];

        ksort($param);    //  排序

        $client_secret = func_get_args()[1];

        $str = '';      //  拼接的字符串
        foreach ($param as $k => $v) $str .= $k . $v;
        $sign = strtoupper(md5($client_secret. $str . $client_secret));    //  生成签名    MD5加密转大写
        return $sign;
    }
}