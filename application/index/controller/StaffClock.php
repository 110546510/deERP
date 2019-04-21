<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 23:40
 */

namespace app\index\controller;

use app\common\ResultR;
use app\model\ StaffClockM;


class StaffClock
{
    public function setStaffClock()
    {
        return StaffClockM::where()->select();
    }

    public function lookStaffClock()
    {
        return StaffClockM::where()->update();
    }

    public function getStaffClock()
    {

    }

    public function postStaffClock()
    {

    }

    public function putStaffClock()
    {

    }

    public function deleteStaffClock()
    {

    }
}