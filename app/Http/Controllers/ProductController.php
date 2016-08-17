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

    public function index(Request $request)
    {
        $callback = $request->input('callback');
        $result = BaseProduct::select(
            array(
                'id',
                'name',
                'interest',
                'total_profits as return',
                'total_invest_amounts as volume'
            )
        )->paginate();

        if (empty($callback)) {
            return json_encode($result);
        } else {
            return json_encode($callback . '(' . $result . ')');
        }

    }


    public function getProductDetail(Request $request)
    {
        $id = (int)$request->input('id');
        $callback = $request->input('callback');
        $platform = BaseProduct::select(array('id', 'name', 'platform_id as platformId', 'interest',
            'total_profits as return',
            'total_invest_amounts as volume'))->find($id);

        $volumeData = array();
        $data = $platform->toArray();
        foreach ($platform->volumeData->toArray() as $value) {
            $volumeData[] = [
                'date' => date('Y/m/d', strtotime($value['data_created_at'])),
                'volume' => $value['data_total_invest_amounts']
            ];
        }


        //渲染数据

        $result = array();

        $result['id'] = $data['id'];
        $result['name'] = $data['name'];
        $result['interest'] = $data['interest'];
        $result['platformId'] = $data['platformId'];
        $result['return'] = $data['return'];
        $result['volume'] = $data['volume'];
        $result['volumeData'] = $volumeData;

        if (empty($callback)) {
            return json_encode($result);
        } else {
            return json_encode($callback . '(' . $result . ')');
        }



    }
}
