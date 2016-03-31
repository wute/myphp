<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/19/2016
 * Time: 3:16 PM
 */

namespace Admin\Controller;
/*
type是操作种类，1是取热门文章，2是取推荐文章，3是取关注文章
page数据页
pageSize一页数据多少条
*/

class ArticleController
{
    public function article(){
        $data = M('article');
        $type = I('get.type',0);
        $page = I('get.page',0);
        $pageSize = I('get.pageSize',10);
        if($type == 0){
            $this->getArticle1($data,$page,$pageSize);
        }elseif($type == 1){
            $this->getArticle2($data,$page,$pageSize);
        }elseif($type == 2){
            $this->getArticle3($data,$page,$pageSize);
        }else{
            dataShow(404,'参数有误');
        }
    }
    private function getArticle1($data,$page,$pageSize){//热门文章
        $result = $data->order('like_num desc')->page($page,$pageSize)->select();
        if($result){
            dataShow(200,'数据请求成功',$result);
        }else{
            dataShow(400,'操作失败');
        }
    }
    private function getArticle2($data,$page,$pageSize){//推荐文章
        $result = $data->order('awd_num desc')->page($page,$pageSize)->select();
        if($result){
            dataShow(200,'数据请求成功',$result);
        }else{
            dataShow(400,'操作失败');
        }
    }
    private function getArticle3($data,$page,$pageSize){//关注
    }
}