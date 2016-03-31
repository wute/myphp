<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/19/2016
 * Time: 7:13 PM
 */

namespace Admin\Controller;
/*
获取名人信息类
*/

class CelebrityController
{
    public function celebrity(){
        $data = M('celebrity');
        $cid = I('post.cid');
        if(empty($cid)){
            dataShow(404,'数据获取失败');
        }else{
            if($cid==0){
                $result = $data->select();
            }else{
                $condition['cid'] = $cid;
                $result = $data->where($condition)->select();
            }
            if($result){
                dataShow(200,'名人数据获取成功',$result);
            }else{
                dataShow(404,'数据获取失败');
            }
        }
    }
}