<?php

namespace App\Http\Controllers;


use Excel;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class PageController extends Controller
{
    /**
     * 欢迎
     */
    public function index()
    {
        return view('welcome');
    }
    /**
     * 地图展示
     */
    public function map()
    {
        $filename = '目录.xlsx';
        $filePath = 'storage/app/public/' . $filename;
        $reader = Excel::load($filePath);//要开始导入文件，可以使用->load($filename)。回调是可选的。
        $reader = $reader->getSheet(0);//得到Excel的第一页内容，如下图3
        $listall = $reader->toArray();
        $list=array_splice($listall,1);

        return view('map',['lists' => $list]);
    }


}
