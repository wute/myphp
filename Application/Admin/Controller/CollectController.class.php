<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/19/2016
 * Time: 3:41 PM
 */

namespace Admin\Controller;
/*
收藏操作类
type用户账号种类，0为手机，1为邮箱
aid用户id
page页号，默认为0
pageSize页数据内容大小，默认为10
mobile用户手机号
email用户邮箱号
*/

class CollectController
{
    public function collect(){
        $Collection = M('collection');
        $User = M('user');
        $type = I('post.type',0);
        $aid = I('post.aid','');
        $page = I('post.page',0);
        $pageSize = I('post.pageSize',10);
        if($type == 0){
            $mobile = I('post.mobile','');
            if($mobile){
                if(empty($aid)){
                    $this->getCollectByMobile($Collection,$User,$mobile,$page,$pageSize);
                }else{
                    $this->saveCollectByMobile($Collection,$User,$mobile,$aid);
                }
            }else{
                dataShow(404,'参数不合法');
            }
        }elseif($type == 1){
            $email = I('post.email','');
            if($email){
                if(empty($aid)){
                    $this->getCollectByEmail($Collection,$User,$email,$page,$pageSize);
                }else{
                    $this->saveCollectByEmail($Collection,$User,$email,$aid);
                }
            }else{
                dataShow(404,'参数不合法');
            }
        }else{
            dataShow(404,'参数不合法');
        }
    }
    private function getCollectByMobile($Collection,$User,$mobile,$page,$pageSize){//通过手机号来查找用户的收藏列表
        $condition['mobile'] = $mobile;
        $result = $User->where($condition)->getField('uid');
        if($result){
            $realCondition['uid'] = $result;
            $collectResult = $Collection->where($realCondition)->page($page,$pageSize)->select();
            if($realCondition){
                dataShow(200,'数据获取成功',$collectResult);
            }else{
                dataShow(400,'数据获取失败');
            }
        }else{
            dataShow(400,'数据获取失败');
        }
    }
    private function getCollectByEmail($Collection,$User,$email,$page,$pageSize){//通过邮箱号来查找用户的收藏列表
        $condition['email'] = $email;
        $uid = $User->where($condition)->getField('uid');
        if($uid){
            $realCondition['uid'] = $uid;
            $collectResult = $Collection->where($realCondition)->page($page,$pageSize)->select();
            if($realCondition){
                dataShow(200,'数据获取成功',$collectResult);
            }else{
                dataShow(400,'数据获取失败');
            }
        }else{
            dataShow(400,'数据获取失败');
        }
    }
    private function saveCollectByMobile($Collection,$User,$mobile,$aid){
        $condition['mobile'] = $mobile;
        $uid = $User->where($condition)->getField('uid');
        if($uid){
            $data['uid'] = $uid;
            $data['aid'] = $aid;
            $result = $Collection->add($data);
            if($result){
                dataShow(200,'数据添加成功');
            }else{
                dataShow(401,'数据添加失败');
            }
        }else{
            dataShow(400,'数据获取失败');
        }
    }
    private function saveCollectByEmail($Collection,$User,$email,$aid){
        $condition['email'] = $email;
        $uid = $User->where($condition)->getField('uid');
        if($uid){
            $data['uid'] = $uid;
            $data['aid'] = $aid;
            $result = $Collection->add($data);
            if($result){
                dataShow(200,'数据添加成功');
            }else{
                dataShow(401,'数据添加失败');
            }
        }else{
            dataShow(400,'数据获取失败');
        }
    }
}