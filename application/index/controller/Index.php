<?php
namespace app\index\controller;

use app\common\ResultR;
use app\model\StaffLM;

class Index
{
    /**
     * 登陆校验
     * @param $name
     * @param $pwd
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getLogin($name,$pwd){
        $pwd = substr(md5($pwd),21,10);
        $map = [
            'username'=> $name,
            'password' => $pwd
        ];
        $res = StaffLM::with('StaffInfoM')->where($map)->select()->toArray();
        if($res){
            $res[0]['Organization']  = StaffLM::with('OrganizationM')->where(['belong'=>$res[0]['belong']])->select()->toArray()[0]['organization_m'];
            return ResultR::accessResult($res[0]);
        }
        return ResultR::errorResult('用户名或密码错误','no data');
    }

    /**
     * 设置用户密码
     * @param $name
     * @param $pwd
     * @return null
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function putSetPwd($name,$pwd)
    {
        $pwd = substr(md5($pwd),21,10);
        return (StaffLM::where('username',$name)->update(['password'=>$pwd]) > 0 )?ResultR::accessResult('ok'):ResultR::errorResult('未知错误','no data');
    }

    /**
     * 查询全部
     * @return null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getStaffLMS(){
        return $this->getStaffLM(1,1);
    }

    /**
     * 指定查询
     * @param $field
     * @param $name
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getStaffLM($field,$name)
    {
        $res = StaffLM::where($field,$name)->select()->toArray();
        return (isset($res))?ResultR::accessResult($res):ResultR::hintResult('没有数据','no data');
    }

    /**
     * 新建用户
     * @param $data
     * @return \think\response\Json
     */
    public function postStaffLM($data)
    {
        $res = StaffLM::create($data);
        return ($res > 0 )?ResultR::accessResult($res) : ResultR::hintResult('没有数据','no data');
    }

    /**
     * 删除用户
     * @param $status
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function deleteStaffLM($status,$name)
    {
        $res = StaffLM::where('username',$name)->update(['status'=>$status]);
        return ($res > 0 )?ResultR::accessResult($res):ResultR::hintResult('删除失败','');
    }

}
