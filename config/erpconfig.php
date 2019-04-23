<?php
return [
    'SystemInfo'=>[
        'name'=>'deERP',
        'version'=>'1.0.12',
        'about me'=>'这是一份毕业设计ERP系统的原型'
    ],
    'CompanyInfo'=>[
        'name'=>'', //公司名称
        'telephone'=>'',//老板电话
        'address'=>'',//地址
        'phone'=>''//固话
     ],
    'GoodsTO'=>[],
    'IdPrefix'=>[//id前缀
    'staff_id'=>'ST-',
    'sup_client_id'=>'SCI-',
    'product_id'=>'PI-',
    'warehouse_id'=>'WI-',
    ],
    'functions'=>[

    ],
    'sample'=>[
        'templete'=> RESOURCES.'/public/',
        'code'=> RESOURCES.'/code/',
        'excel'=> RESOURCES.'/excel/',
        'header'=> RESOURCES.'/header/'
    ]
];