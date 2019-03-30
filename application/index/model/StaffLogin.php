<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/14
 * Time: 9:39
 */

namespace app\index\model;

use think\Model;

class StaffLogin extends Base
{
    protected $name = 'staff_login';

    protected $hidden = ['password'];

    /**
     * 关联模型
     * @return \think\model\Relation
     */
    public function staff()
    {
        return $this->hasOne('staff','number','number');
    }

    /**
     * 登陆判断
     * @param $username
     * @param $pwd
     * @return string
     */
    public function loginStaff($username,$pwd)
    {
        $list = $this->with('staff')->where(['username'=>$username,'password'=>$pwd])->find();
        return $list ? $list->toArray():'no';
    }



    /**
     * 设置登陆信息
     * @param $username
     * @param array $data
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function setStaff($username,array $data)
    {
        return $this->where(['username'=>$username])->update($data);
    }

    /**
     * 删除用户（软删除）
     * @param $username
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delStaff($username)
    {
        return $this->where(['username'=>$username])->update(['status'=>'1']);
    }

    /**
     * 获取指定用户信息
     * @return array
     * @throws \think\Exception\DbException
     */
    public function getStaff($where = 1,$cloum = 1)
    {
        return $this->where([$where=>$cloum])->select();
    }

    /**
     * 获取员工信息
     * @param $username
     * @return string
     */
    public function getStaffInfo($username)
    {
        $list = $this->with('staff')->where(['username'=>$username,'status'=>'0'])->find();
        return $list ? $list->toArray():'no';
    }
}