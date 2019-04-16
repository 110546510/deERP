<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-16
 * Time: 21:21
 */

namespace app\index\controller;

use app\model\OrganizationM;

class CorporateStructure
{
    public function getCorporateStructureAll()
    {
        OrganizationM::where('who','0')->where('','')->select();
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