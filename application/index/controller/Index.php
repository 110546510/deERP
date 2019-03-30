<?php
namespace app\index\controller;

use app\index\model\Staff;
use app\index\model\StaffLogin;

class Index
{
    public function index()
    {
        $staff = new StaffLogin();
        dump($staff->loginStaff('2231','23123'));
//        dump($staff->getStaff());
    }


}