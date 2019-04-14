<?php
namespace app\index\controller;

use app\model\StaffLM;

class Index
{
    public function index(){
//        echo \app\facade\Code::Qrcodes('','hello world!');
//        dump(StaffLM::where('status','<','2')->where(['username'=>'18038848740'])->select());
//        echo StaffLM::where('username','=','18038848740')->update(['status'=>'3']);
        $result = StaffLM::with('StaffInfoM')->where(['username'=>'18038848740'])->select();

        $res  = StaffLM::with('OrganizationM')->where(['belong'=>$result[0]['belong']])->select();
        $result[0]['Organization'] = $res[0]['organization_m'];
//        dump($res);
//        dump($result);
        $data['code'] = 2000;
        $data['data'] = $result->toArray()[0];
        dump($data);
    }
}
