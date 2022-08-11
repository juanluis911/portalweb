<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('garantias', function () {
    return datatables()
            ->query(DB::table('garantias'))
            ->toJson();
});

Route::get('ventas', function (Request $request) {
    // return datatables()
    //         ->query(DB::table('ventas'))
    //         ->get()
    //         ->toJson();
    if(request()->ajax())
    {
        if(!empty($request->from_date))
        {
        $data = DB::table('ventas')
            ->whereBetween('order_date', array($request->from_date, $request->to_date))
            ->get();
        }
        else
        {
        $data = DB::table('ventas')
            ->get();
        }
        return datatables()->of($data)->make(true);
    }
});


