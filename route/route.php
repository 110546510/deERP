<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//
//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');

//Route::post('/','index/postPwd')->allowCrossDomain();


//Route::miss(function (){
//    return 404;
//});
Route::controller('staff','index/index')->allowCrossDomain();
Route::controller('organization','index/organization')->allowCrossDomain();
Route::controller('staffinfo','index/StaffInfo')->allowCrossDomain();

return [

];