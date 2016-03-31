<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/17/2016
 * Time: 10:13 PM
 */

namespace Admin\Controller;


class RegisterController
{
    public function register(){
        $register = M('login');
        $password = I('post.password','');
        $type = I('post.type',0);
        $mobile = I('post.mobile','');
        $email = I('post.email','');
        $ip = clientIP();
        if($type == 0){//用手机号注册
            if(!empty($mobile)&&!empty($password)){
                $result = $register->where('mobile='.$mobile)->select();
                if($result){
                    dataShow(408,'该手机号已经被注册');
                }else{
                    $data['mobile'] = $mobile;
                    $data['password'] = $password;
                    $data['IP'] = $ip;
                    $rs = $register->add($data);
                    if($rs){
                        dataShow(200,'注册成功');
                    }else{
                        dataShow(404,'注册失败');
                    }
                }
            }else{
                dataShow(404,'账号或者密码为空');
            }
        }elseif($type == 1){
            if(!empty($email)&&!empty($password)){
                $condition['email'] = $email;
                $result = $register->where($condition)->select();
                if($result){
                    dataShow(408,'该邮箱号已经被注册');
                }else{
                    $data['email'] = $email;
                    $data['password'] = $password;
                    $data['IP'] = $ip;
                    $rs = $register->add($data);
                    dump($rs);
                    if($rs){
                        dataShow(200,'注册成功');
                    }else{
                        dataShow(404,'注册失败');
                    }
                }
            }else{
                dataShow(404,'账号或者密码为空');
            }
        }else{
            dataShow(400,'类型有误');
        }
    }
}