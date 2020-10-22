<?php
/**
 * 京东商品采集
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:03
 */

namespace GatherProduct\Collect\Jd;

use GatherProduct\Kernel\Support\BaseClient;
use function Couchbase\defaultDecoder;

class Client extends BaseClient
{
    //  好单库 x
    protected $api_url = 'http://api.web.21ds.cn/jingdong/getItemCateInfo?';


    //  京推推  http://www.jingtuitui.com/api_item?id=25
    protected $cate_jing_tuitui_api_url = 'http://japi.jingtuitui.com/api/get_super_category';


    //  京推推商品列表
    protected $product_jing_tuitui_api_url = 'http://japi.jingtuitui.com/api/get_goods_list';

    //  京推推更新商品列表
    protected $product_jingtuitui_update_api_url = 'http://japi.jingtuitui.com/api/get_goods_update';

    //  商品转链
    protected $product_tran_url = 'http://japi.jingtuitui.com/api/get_goods_link';

    /**
     * 导入分类
     * Url(http://www.jingtuitui.com/api_item?id=25)
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/14
     * Time: 10:28
     */
    public function importCate($param = [])
    {
        $response = $this->http()->request('POST',$this->cate_jing_tuitui_api_url,[
            'json' => $param,
        ])->getBody()->getContents();


//        $param = [
//            'appid'     =>  '',    //  您在京推推申请的appid
//            'appkey'    =>  '',   //  您在京推推申请的appkey
//        ];
        $response = json_to_array( $response );

        if ($response['return'] == 0){
            return  $response['result']['data'];
        }

        throw new \Exception($response['result'],$response['return']);
    }


    /**
     * 转链(http://www.jingtuitui.com/api_item?id=14)
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/15
     * Time: 14:37
     */
    public function productTransUrl($param = [])
    {
        $response = $this->http()->request('POST',$this->product_tran_url,[
            'json' => $param,
        ])->getBody()->getContents();

//        $param = [
//            'appid'     =>  '', //  您在京推推申请的appid
//            'appkey'    =>  '', //  您在京推推申请的key
//            'page'      =>  '', //  分页获取数据 默认1 最多获取到50页
//            'num'       =>  ''  //  单页面显示条数(最大100条最少10条)
//            'gid'       =>  ''  //  商品id
//        ];

        $response = json_to_array( $response );

        if ($response['return'] == 0){
            return  $response['result']['link'];
        }

        throw new \Exception($response['result'],$response['return']);
    }

    //  导入商品
    public function importProduct($param = [])
    {
        $response = $this->http()->request('POST',$this->product_jing_tuitui_api_url,[
            'json' => $param,
        ])->getBody()->getContents();

//        $param = [
//            'appid'     =>  '', //  您在京推推申请的appid
//            'appkey'    =>  '', //  您在京推推申请的key
//            'page'      =>  '', //  分页获取数据 默认1 最多获取到50页
//            'num'       =>  ''  //  单页面显示条数(最大100条最少10条)
//        ];

        $response = json_to_array( $response );

        if ($response['return'] == 0){
            return  $response['result']['data'];
        }

        throw new \Exception($response['result'],$response['return']);
    }

    //  更新商品
    public function updateProduct($param = [])
    {
        $response = $this->http()->request('POST',$this->product_jingtuitui_update_api_url,[
            'json' => $param,
        ])->getBody()->getContents();

//        $param = [
//            'appid'     =>  '', //  您在京推推申请的appid
//            'appkey'    =>  '', //  您在京推推申请的key
//            'page'      =>  '', //  分页获取数据 默认1 最多获取到50页
//            'num'       =>  ''  //  单页面显示条数(最大100条最少10条)
//        ];

        $response = json_to_array( $response );

        if ($response['return'] == 0){
            return  $response['result']['data'];
        }

        throw new \Exception($response['result'],$response['return']);
    }


    //  下架失效商品
    public function downProduct($param = [])
    {
        $url = $this->api_url . implode('/', $param);

        $response = $this->http()->request('GET', $url)->getBody()->getContents();

        return json_to_array( $response );
    }


    //  导入聚划算商品
    public function importJuTaoGoods($param = [])
    {
        $url = $this->api_url . implode('/', $param);

        $response = $this->http()->request('GET', $url)->getBody()->getContents();

        return json_to_array( $response );
    }

}