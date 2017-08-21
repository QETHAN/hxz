<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\User as UserModel;

class Index extends Controller
{
    protected $beforeActionList = [
      'checkIfInWeixin'
    ];

    protected function checkIfInWeixin() 
    {
      $useragent = $_SERVER['HTTP_USER_AGENT'];  
      if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false ){  
          echo " 非微信浏览器禁止访问";
          exit;  
      }
    }

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
