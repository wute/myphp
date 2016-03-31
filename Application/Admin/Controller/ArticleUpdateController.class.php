<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/2016
 * Time: 1:13 PM
 */

namespace Admin\Controller;
/*
更新文章控制器
*/

class ArticleUpdateController
{
   public function articleUpdate(){
       $Article = M('article');
       $aid = I('post.aid');
       $change = I('post.change');
       if($aid&&$change){
           $BaseData = $this->getData($Article,$aid);
           $baseData = $BaseData[1];
           if($baseData){
               $result = $this->saveData($Article,$baseData,$change,$aid);
               if($result){
                   dataShow(200,'数据保存成功');
               }else{
                   dataShow(400,'数据库错误或者数据没有改变');
               }
           }else{
               dataShow(400,'数据库错误');
           }
       }else{
           dataShow(404,'参数不合法');
       }
   }
    private function getData($Article,$aid){
        $condition['aid'] = $aid;
        $result = $Article->where($condition)->getField('view_num,like_num,awd_num,col_num,com_num');
        if($result){
            return $result;
        }else{
            return null;
        }
    }
    private function saveData($Article,$baseData,$change,$aid){
        foreach ($change as $key=>$value) {
            $baseData[$key] = intval($baseData[$key])+intval($value);
        }
        $condition['cid']=$aid;
        $result = $Article ->where($condition)->save($baseData);
        return $result;
    }
}