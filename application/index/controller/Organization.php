<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-16
 * Time: 21:21
 */

namespace app\index\controller;

use app\model\OrganizationM;

class Organization
{
    public function base($who)
    {
        $map = [
            'who'=>$who,
            'status'=>'0'
        ];
        OrganizationM::where('who','0')->select();
    }

    public function postCorporateStructure()
    {
        
    }

    public function deleteCorporateStructure(){
        
    }

    public function putCorporateStructure()
    {
        
    }

}