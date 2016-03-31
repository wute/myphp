<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/16/2016
 * Time: 3:29 PM
 */

namespace Admin\Controller;

class LoginController
{
    public function login()
    {
        $loginData = M('login');
        $userInfo = M('user');
        $type = I('post.type',0);
        $mobile = I('post.mobile','');
        $email = I('post.email','');
        $password = I('post.password');
        if($type == 0 ){
            if(!empty($mobile)){
                $condition['mobile'] = $mobile;
                $result = $loginData->where($condition)->getField('uid,password');//获取主键和密码
                if($result[key($result)]==$password){
                    $userInformation = $userInfo->where('uid='.key($result))->select();
                    dataShow(200,'登陆成功',$userInformation);
                }else{
                    dataShow(404,'账号或者密码不正确');
                }
            }else{
                dataShow(404,'账号或者密码不正确');
            }
        }elseif($type==1){
            if(!empty($email)){
                $condition['email'] = $email;
                $result = $loginData->where($condition)->getField('uid,password');//获取主键和密码
                if($result[key($result[1])]==$password){
                    $userInformation = $userInfo->where('uid='.key($result))->select();
                    dataShow(200,'登陆成功',$userInformation);
                }else{
                    dataShow(404,'账号或者密码不正确');
                }
            }else{
                dataShow(404,'账号或者密码不正确');
            }
        }else{
            dataShow(400,'类型有误');
        }
    }
}