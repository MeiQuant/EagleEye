<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Exceptions\ProgramException;


class RuleController extends Controller
{

    public function index()
    {
       throw new ProgramException('我是错误信息');
    }


    public function create()
    {

    }



    public function store(Request $request)
    {

        $platformId = $request->input('platform_id', 0);
        $code = $request->input('code', '');
        $hashId = $request->input('hash_id', 0); //hash_id对应页面是个下拉框
        Rule::create(
            [
                'platform_id' => $platformId,
                'code' => $code,
                'hash_id' => $hashId
            ]
        );

        //默认输出正常,异常走统一的异常处理类

        return response()->json(
            [
                'status' => true,
                'message' => '添加成功'
            ]
        );
    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
