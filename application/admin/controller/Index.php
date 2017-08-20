<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Validate;
use app\admin\model\User as UserModel;


class Index extends Controller
{
    public function index()
    {
      // 查询状态为1的用户数据 并且每页显示10条数据
      $users = Db::name('user')->paginate(15);
      // 获取分页显示
      $page = $users->render();
      // 模板变量赋值
      $this->assign('users', $users);
      $this->assign('page', $page);
      // 渲染模板输出
      return $this->fetch();
    }

    public function addUser()
    {
      Session::delete('token');
      $user = new UserModel;
      $user->setup();
      $this->assign('data', $user->toArray());
      return $this->fetch();
    }

    public function editUser($id)
    {
      $user = UserModel::get($id);
      $this->assign('data', $user);
      return $this->fetch();
    }

    public function updateUser($id)
    {
      // 上传图片处理
      // 获取表单上传文件 例如上传了001.jpg
      $file = request()->file('photo');
      
      if ($file) {
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            // echo $info->getExtension();
            // // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getSaveName();
            // // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename(); 
            $_POST['photo'] = $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return $this->error('图片上传失败！');
        }
      }
      

      $user = new UserModel;
      // 过滤post数组中的非数据表字段数据
      $user->save($_POST,['id' => $id]);

      return $this->success('修改成功！', '/admin666', '', 1);
    }

    public function createUser()
    {   

      $rules = [
        'name' => 'require|max:25'
      ];

      $msg = [
        'name.require' => '姓名不能为空'
      ];

      $validate = new Validate($rules, $msg);

      if(!$validate->check(input('post.'))) {
        $this->assign('error', $validate->getError());
        $this->assign('data', input('post.'));
        return $this->fetch('addUser');
      }

      if(Session::get('token') == md5(implode(',', $_POST))) {
        return '不要重复提交';
      }

      Session::set('token', md5(implode(',', $_POST)));
// dump($_POST);
// return;

      // 上传图片处理
      // 获取表单上传文件 例如上传了001.jpg
      $file = request()->file('photo');
      
      if($file) {
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            // echo $info->getExtension();
            // // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getSaveName();
            // // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename(); 
            $_POST['photo'] = $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return $this->error('图片上传失败！');
        }
      } else {
        $_POST['photo'] = "";
      }
      
      // 保存数据
      $user = new UserModel($_POST);
      

      try {
        $user->save();
      } catch(\Exception $e) {
        $this->error('添加失败！');
      }
      
      $this->success('添加成功！', '/admin666/user/add', '', 1);

    }


}
