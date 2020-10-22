<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/15
 * Time: 16:20
 */

namespace GatherProduct\Collect\Pdd;


use GatherProduct\Kernel\Support\BaseClient;
use function Couchbase\defaultDecoder;

class Client extends BaseClient
{
    protected $url = 'http://api.web.21ds.cn/pinduoduo/getPddOpts';

    protected $product_url = 'http://gw-api.pinduoduo.com/api/router';


    /**
     * 导入分类(Url:https://open.21ds.cn/index/index/openapi/id/60.shtml?ptype=3)
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/15
     * Time: 16:21
     */
    public function importCate($param = [])
    {
        $url = $this->url . '?apkey=' . $param['apkey'] . '&parent_opt_id=' . $param['parent_opt_id'];
        $response = $this->http()->request('GET',$url)->getBody()->getContents();

//        $param = [
//            'apkey'     =>  '',    //  	用户中心 - 系统设置 - 平台设置 中查看APKEY密钥 (点击进入)（*必要）
//            'parent_opt_id'    =>  '',   //  值=0时为顶点opt_id,通过树顶级节点获取opt树
//        ];
        $response = json_to_array( $response );

        if ($response['code'] == 200){
            return  $response['data'];
        }

        throw new \Exception($response['msg'],$response['code']);
    }


    /**
     * 导入商品(Url:http://gw-api.pinduoduo.com/api/router)
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/15
     * Time: 17:17
     */
    public function importProduct($param = [],$secret)
    {
        $param['sign'] = $this->pddSign($param,$secret);
        $response = $this->http()->request('POST',$this->product_url,[
            'json' => $param,
        ])->getBody()->getContents();

//        $param = [
//            'client_id'    =>  '',
//            'type'     =>  'pdd.ddk.goods.search',
//            'data_type' =>  'JSON',
//            'timestamp'      =>  Helper::getMillisecond(),
//        ];

        $response = json_to_array( $response );


        if (isset($response['error_response'])){
            throw new \Exception($response['error_response']['error_msg'],$response['error_response']['sub_code']);
        }

        if(isset($response['goods_search_response'])) {
            return  $response['goods_search_response'];
        }

        return  [];
    }

    /**
     * 商品详情
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/15
     * Time: 18:01
     */
    public function productDetail($productId,$client_id,$secret)
    {
        $p  = [
            'type'  =>  'pdd.ddk.goods.detail',
            'client_id' =>  $client_id,
            'timestamp' =>  time(),
            'data_type' =>  'JSON',
            'goods_id_list' => array_to_json([$productId])
        ];

        $p['sign'] = $this->pddSign($p,$secret);


        $response = $this->http()->request('POST',$this->product_url,[
            'json' => $p,
        ])->getBody()->getContents();

        $response = json_to_array( $response );

        if(isset($response['goods_detail_response']['goods_details'][0])) {
            return $response['goods_detail_response']['goods_details'][0];
        }

        if (isset($response['error_response'])){
            throw new \Exception($response['error_response']['error_msg'],$response['error_response']['sub_code']);
        }

        return  [];
    }
}