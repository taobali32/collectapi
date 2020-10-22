<?php
/**
 * 淘客商品采集
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 17:03
 */

namespace GatherProduct\Collect\TaoKe;

use GatherProduct\Kernel\Support\BaseClient;
use function Couchbase\defaultDecoder;

class Client extends BaseClient
{
    protected $api_url = 'http://v2.api.haodanku.com/';


    protected $cateList = [
        'api_list' => [
            // 超级分类
            'super_cate' => 'super_classify',
            // 猜你喜欢
            'recommed' => 'get_similar_info',
            // 搜索页面
            'hot_key' => 'hot_key',
            // 搜索
            'search' => 'get_keyword_items',
            // 类型筛选页面（无关键词）
            'search_no_words' => 'column',
            // 商品详情
            'goods_info' => 'item_detail',
            // 爆款推荐
            'hot_recomm' => 'sales_list',
            // 大牌秒杀
            'brand' => 'brand',
            // 商品列表（入库）
            'import_goods' => 'itemlist',
        ],
    ];


    /**
     * Url(https://open.21ds.cn/index/index/openapi/id/50.shtml?ptype=1)
     * 淘客9.9商品
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/20
     * Time: 14:10
     */
    public function import9点9($param = [])
    {
        $url = 'http://v2.api.haodanku.com/low_price_Pinkage_data/apikey/';

        $url .= '/' .$param['apkey'] . '/type/2/min_id/' . $param['min_id'];
        $response = json_to_array($this->http()->request('GET', $url)->getBody()->getContents());

        return $response;
    }

    //  导入分类
    public function importCate($param = [])
    {
        $merge = array_merge([
            'super_classify', //  分类列表
            'apikey',
            ''  //  apikey  好单库
        ],$param);

        $url = $this->api_url . implode('/', $merge);

        $response = $this->http()->request('GET', $url)->getBody()->getContents();

        $response = json_to_array( $response );

        if (isset($response['code']) && $response['code'] == 1) {
            return $response['general_classify'];
        }

        throw new \Exception($response['msg'],$response['code']);
    }

    /**
     * 导入商品Url(https://www.haodanku.com/Openapi/api_detail?id=13)
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/14
     * Time: 10:51
     */
    public function importProduct($param = [])
    {
//        $param = [
//            'itemlist',
//            'apikey', $config['api_key'],
//            'back', 500,
//            'nav', 3,
//            'min_id', $min_id
//        ];

        $url = $this->api_url . implode('/', $param);

        $response = $this->http()->request('GET', $url)->getBody()->getContents();

        return json_to_array( $response );
    }

    //  拉取新品
    public function importNewProduct($param = [])
    {
        $url = $this->api_url . implode('/', $param);

        $response = $this->http()->request('GET', $url)->getBody()->getContents();

        return json_to_array( $response );
    }

    //  更新商品
    public function updateProduct($param = [])
    {
        $url = $this->api_url . implode('/', $param);

        $response = $this->http()->request('GET', $url)->getBody()->getContents();

        return json_to_array( $response );
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