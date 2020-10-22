<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/13
 * Time: 16:00
 */

namespace GatherProduct\User\Jd;


use GatherProduct\Kernel\Exceptions\Exception;
use GatherProduct\Kernel\Support\BaseClient;
use function Couchbase\defaultDecoder;

class Client extends BaseClient
{
    protected $api_url = 'http://api.web.21ds.cn/jingdong/createUnionPosition';

    /**
     * 创建推广位
     * Url(https://open.21ds.cn/index/index/openapi/id/57.shtml?ptype=2)
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/19
     * Time: 10:05
     */
    public function auth($param = [])
    {
//        $p = [
//            'apkey' =>  '',
//            'key_id'    =>  '',   //  联盟调用key，会员中心京东授权列表页获取,喵有券授权管理 jd联盟里面授权了账号信息后自动生成
//            'unionType' =>  '',
//            'type'  =>  '',
//            'spaceNameList' =>  '',
//            'siteId'    =>  ''
//        ];

        $response = json_to_array($this->http()->request('GET',$this->api_url,[
            'query' =>  $param
        ])->getBody()->getContents());

        if ($response['code'] == -1){
            throw new Exception($response['data']['message'],$response['code']);
        }

        return  $response;
    }

    public function importUser($param = [])
    {
        $url = 'http://api.web.21ds.cn/jingdong/getUnionPosition';

        $result = json_to_array($this->http()->request('GET',$url,[
            'query' =>  $param
        ])->getBody()->getContents());

        return $result;
    }
}