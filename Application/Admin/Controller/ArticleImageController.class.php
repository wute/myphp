<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/24/2016
 * Time: 4:30 PM
 */

namespace Admin\Controller;
/*
获取文章图片类
*/

class ArticleImageController
{
    public function articleImage(){
        $data = M('article_img');
        $aid = I('post.aid');
        if($aid){
            $condition['aid']=$aid;
            $result = $data->where($condition)->select();
            if($result){
                dataShow(200,'数据获取成功',$result);
            }else{
                dataShow(400,'数据获取失败或者数据为空');
            }
        }else{
            dataShow(404,'参数有误');
        }
    }
}