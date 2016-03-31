<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/2016
 * Time: 3:18 PM
 */

namespace Admin\Controller;
/**
 * Class signIn
 * @package Admin\Controller
 * 签到类
 */

class signInController
{
   public function signIn(){
      $Register = M('register');
      $uid = I('get.uid');
      if($uid){
         $condition['uid'] = $uid;
         $signInfo = $Register->where($condition)->select();
         $now = date("Y-m-d");
         $lastTime = date('Y-m-d',strtotime($signInfo[0]['lasttime']));
         if( $lastTime == $now){
            dataShow(400,'今天已经签过到了');
         }elseif($lastTime == date("Y-m-d",strtotime('-1 day'))){
            $reg_num['reg_sum'] = intval($signInfo[0]['reg_sum'])+1;
            $result = $Register->where($condition)->save($reg_num);
            if($result){
               dataShow(200,'签到成功',$reg_num);
            }else{
               dataShow(401,'签到失败');
            }
         }else{
            $reg_num['reg_sum'] = 1;
            $result = $Register->where($condition)->save($reg_num);
            if($result){
               dataShow(200,'签到成功',$reg_num);
            }else{
               dataShow(401,'签到失败');
            }
         }
      }else{
         dataShow(404,'参数不合法');
      }
   }
   public function getSign(){
      $Register = M('register');
      $uid = I('get.uid');
      if($uid){
         $condition['uid'] = $uid;
         $signInfo = $Register->where($condition)->select();
         $reg_sum['reg_sum'] = $signInfo[0]['reg_sum'];
         if($signInfo){
            dataShow(200,'获取签到成功',$reg_sum);
         }
      }else{
         dataShow(404,'参数不合法');
      }
   }
}