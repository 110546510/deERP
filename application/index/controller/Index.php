<?php
namespace app\index\controller;

use app\common\ResultR;
use app\model\StaffLM;

class Index
{
    public function index($name,$pwd){
        $pwd = substr(md5($pwd),21,10);
        $res = StaffLM::with('StaffInfoM')->where('username',$name)->where('password',$pwd)->select()->toArray();
        if($res){
            $res[0]['Organization']  = StaffLM::with('OrganizationM')->where(['belong'=>$res[0]['belong']])->select()->toArray()[0]['organization_m'];
            return json(ResultR::accessResult($res[0]));
        }
        return json(ResultR::errorResult('用户名或密码错误','no data'));
    }

    public function setpwd($name,$pwd)
    {
        $pwd = substr(md5($pwd),21,10);
        return (StaffLM::where('username',$name)->update(['password'=>$pwd]) > 0 )?ResultR::accessResult('ok'):ResultR::errorResult('未知错误','no data');
    }

    public function all(){
        return ResultR::accessResult(StaffLM::all());
    }
}
