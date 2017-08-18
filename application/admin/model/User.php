<?php

namespace app\admin\model;

use think\Model;

class User extends Model
{
  protected $table = 'hxz_user';

   //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
    }

  public function setup()
  { 
      $this->number = "";
      $this->name = "";
      $this->sex = 1;
      $this->minzu = "";
      $this->birthday = "";
      $this->height = "";
      $this->jiguan = "";
      $this->address = "";
      $this->xueli = "";
      $this->school = "";
      $this->danwei = "";
      $this->job = "";
      $this->status = "";
      $this->shouru = "";
      $this->zhufang = "";
      $this->phone = "";
      $this->qq = "";
      $this->wechat = "";
      $this->hobby = "";
      $this->xuanyan = "";
      $this->yaoqiu = "";
  }
}