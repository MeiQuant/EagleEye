<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Exceptions\ProgramException;
use App\Platform;
use DB;
use App\BaseProduct;



class ProductController extends Controller
{

    public function index()
    {
        return BaseProduct::select(
            array(
                'id',
                'name',
                'interest',
                'total_profits as return',
                'total_invest_amounts as volume'
            )
        )->paginate();
    }


    public function getPlatformDetail(Request $request)
    {
        $id = (int)$request->input('id');
        $platform = BasePlatform::select(array('id', 'name', 'interest', 'total_profits as return',
            'total_invest_amounts as volume', 'total_invest_persons as users'))->find($id);

        $volumeData = array();
        $userData = array();
        $data = $platform->toArray();
        foreach ($platform->volumeData->toArray() as $value) {
            $volumeData[] = [
                'date' => date('Y/m/d', strtotime($value['data_created_at'])),
                'volume' => $value['data_total_invest_amounts']
            ];

            $userData[] = [
                'date' => date('Y/m/d', strtotime($value['data_created_at'])),
                'users' => $value['data_total_invest_persons']
            ];
        }


        //渲染数据

        $result = array();

        $result['id'] = $data['id'];
        $result['name'] = $data['name'];
        $result['interest'] = $data['interest'];
        $result['volume'] = $data['volume'];
        $result['users'] = $data['users'];
        $result['volumeData'] = $volumeData;
        $result['userData'] = $userData;
        $result['product_data'] = $platform->productData->toArray();


        print_r($result);


    }
}
