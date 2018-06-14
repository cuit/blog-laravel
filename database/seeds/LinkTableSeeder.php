<?php

use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=>'成都信息工程大学',
                'description'=>'成都信息大学官网',
                'order'=>1,
                'url'=>'http://www.cuit.edu.cn'
            ],[
                'name'=>'百度',
                'description'=>'百度运营机构',
                'order'=>2,
                'url'=>'http://www.baidu.com'
            ]
        ];
        DB::table('link')->insert($data);
    }
}
