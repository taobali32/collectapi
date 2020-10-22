<?php
/**
 * desc xxx
 *
 * Created by PhpStorm.
 * User: lwl
 * Date: 2020/10/12
 * Time: 19:08
 */

namespace GatherProduct\User\TaoKe;

use GatherProduct\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    protected $api_url = 'http://api.web.21ds.cn/';

    protected $auth_user = 'taoke/getTbkPublisherInfo';

    /**
     * 每分钟导入用户
     *
     * Created by PhpStorm.
     * User: lwl
     * Date: 2020/10/15
     * Time: 14:52
     */
    public function importUser($param = [])
    {
        $merge = array_merge([
            'apkey' =>  '',
            'info_type' =>  1,
            'relation_app'  =>  'common',
            'tbname'    =>  '',
            'page_size' =>  100
        ],$param);

        $url = $this->api_url . $this->auth_user . '?';

        $response = $this->http()->request('GET', $url, [
            'query' => $merge
        ])->getBody()->getContents();

        $response = json_to_array( $response );

        if ($response['code'] == 200 && isset($response['data']['inviter_list'])) {
            return isset($response['data']['inviter_list']['map_data']) ? $response['data']['inviter_list']['map_data'] : [];
        }

        throw new \Exception($response['msg'],$response['code']);
    }
}