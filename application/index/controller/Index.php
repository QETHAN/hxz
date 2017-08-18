<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\User as UserModel;

class Index extends Controller
{
    public function index()
    {
      $users = UserModel::all();
      $this->assign('users', $users);
      return $this->fetch();
    }

    public function showUser($id)
    {
      $user = UserModel::get($id);
      $this->assign('user', $user);
      return $this->fetch();
    }
}
