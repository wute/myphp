<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/24/2016
 * Time: 6:20 PM
 */

namespace Admin\Controller;
/*
type操作种类,0为添加评论，1为查看评论
uid用户id
aid文章id
commentInfo 评论内容
*/

class CommentController
{
    public function comment(){
        $Comment = M('comment');
        $type = I('post.type',0);
        $uid = I('post.uid');
        $aid = I('post.aid');
        $commentInfo = I('post.info');
        if($type == 0){
            if($uid&&$aid){
                $result = $this->saveComment($Comment,$uid,$aid,$commentInfo);
                if($result){
                    dataShow(200,'评论保存成功');
                }else{
                    dataShow(400,'评论保存失败');
                }
            }else{
                dataShow(404,'参数不合法');
            }
        }elseif($type == 1){
            if($aid){
                $result = $this->getComment($Comment,$aid);
                if($result){
                    dataShow(200,'评论获取成功',$result);
                }else{
                    dataShow(400,'评论获取失败');
                }
            }else{
                dataShow(404,'参数不合法');
            }

        }else{
            dataShow(404,'参数不合法');
        }
    }

    private function saveComment($Comment,$uid,$aid,$commentInfo){
        $data['uid'] = $uid;
        $data['aid'] = $aid;
        $data['com_content'] = $commentInfo;
        $result = $Comment->add($data);
        if($result){
            return $result;
        }else{
            return null;
        }
    }
    private function getComment($Comment,$aid){
        $condition['aid'] = $aid;
        $content = $Comment->where($condition)->select();
        if($content){
            return $content;
        }else{
            return null;
        }
    }
}