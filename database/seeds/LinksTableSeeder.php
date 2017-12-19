<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            [
                'link_name'=>'報班系統',
                'link_title'=>'14屆的報班系統',
                'link_url'=>'https://duty14.microsoftintern.org/',
                'link_order'=>1,
            ],
            [
                'link_name'=>'Laravel 官方網站',
                'link_title'=>'學習資源',
                'link_url'=>'https://d.laravel-china.org/docs/5.5/routing#required-parameters',
                'link_order'=>2,
            ]
        ];
        DB::table('links')->insert($data);
    }
}
