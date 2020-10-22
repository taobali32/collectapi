<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/13
 * Time: 16:00
 */

namespace GatherProduct\User\Pdd;


use GatherProduct\Kernel\Exceptions\Exception;
use GatherProduct\Kernel\Support\BaseClient;
use function Couchbase\defaultDecoder;

class Client extends BaseClient
{
    protected $api_url = 'http://api.web.21ds.cn/pinduoduo/createPid';

    public function pub($param = [],$key)
    {
        $url = 'http://gw-api.pinduoduo.com/api/router';

        $param['p_id_list'] = array_to_json($param['p_id_list']);

        $param = array_merge($param,[
           'type'   =>  'pdd.ddk.rp.prom.url.generate',
            'timestamp' =>  time(),
            'channel_type'  =>  10
        ]);

        $param['sign'] = $this->pddSign($param,$key);

        $response = json_to_array($this->http()->request('POST',$url,[
            'json' =>  $param
        ])->getBody()->getContents());

        var_dump($response); die;
    }

    /**
     * 创建推广位
     * Url(https://open.21ds.cn/index/index/openapi/id/16.shtml?ptype=3)
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/19
     * Time: 10:05
     */
    public function auth($param = [])
    {
//        $param = [
//            'apkey' =>  '',
//            'pdname'    => '',
//            'number'    =>  '',
//        ];
        $response = json_to_array($this->http()->request('GET',$this->api_url,[
            'query' =>  $param
        ])->getBody()->getContents());

        if ($response['code'] == 200){
            return $response['data']['p_id_list'];
        }

        throw new Exception($response['msg'],$response['code']);
    }

    public function importUser($param = [])
    {
        $url = 'http://api.web.21ds.cn/pinduoduo/getPidList';

        $result = json_to_array($this->http()->request('GET',$url,[
            'query' =>  $param
        ])->getBody()->getContents());

        return $result;
    }
}