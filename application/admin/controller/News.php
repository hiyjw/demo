<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class News extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = DB::table('news')->select();

        return $this->fetch('news/index',['title'=>'新闻列表','data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $this->assign('title','发表新闻');
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        header("Content-Type:text/html;charset=utf8");
        $rs = input("post.");
        $data = Db::table('news')->insert($rs);
//        var_dump($rs);exit;
        if($data){
            $this->success('发表成功','news/index');
        }else{
            $this->error('发表失败');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = Db::table('news')->where('id',$id)->find();
        /*var_dump($data);
        die;*/
        $this->assign('data',$data);
        $this->assign('title','新闻修改页面');
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = input('post.');
        $rs = Db::table('news')->where('id',$id)->update($data);
        if($rs){
            $this->success('修改成功','news/index');
        }else{
            $this->error('修改失败');
        }

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $data = Db::table('news')->delete($id);
        if($data){
            return true;
        }else{
            return false;
        }
    }
}
