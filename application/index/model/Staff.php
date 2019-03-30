<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/14
 * Time: 10:10
 */

namespace app\index\model;


class Staff extends Base
{
    protected $name = 'staff';

    protected $hidden = ['number'];

    /**
     * 条件获取员工信息
     * @param $where
     * @param $colum
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getStaffInfo($where,$colum)
    {
        return $this->where([$where => $colum])->select()->toArray();
    }

    /**
     * 新增数据
     * @param $data
     * @return false|int
     */
    public function newStaffInfo($data)
    {
        return $this->save($data);
    }
    
    /**
     * 修改员工信息
     * @param $user
     * @param $data
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function setStaffInfo($user,$data)
    {
        return $this->where(['number'=>$user])->update($data);
    }
}