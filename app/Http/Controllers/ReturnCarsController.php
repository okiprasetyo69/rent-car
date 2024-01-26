<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Helpers\GlobalHelper;
use App\Models\BorrowCars;
use App\Models\Cars;
use App\Models\ReturnCars;

class ReturnCarsController extends Controller
{
    public function getReturnCars(Request $request){
        try{

            $data = ReturnCars::with('cars')->orderBy('id', 'DESC')->get();
            
            return [
                'status' => 200,
                'message' => true,
                'data' => $data
            ];
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function returnCar(Request $request){
        try{

            $returnCar = new ReturnCars();
            $car = new Cars();
            $borrowCar = new BorrowCars();
            $returnCar->fill($request->all());
           
            $isAvailable = 1;

            if($request->car_id != null){
                $car = $car::where("id", $request->car_id)->first();
                $borrowCar = $borrowCar::where("car_id", $request->car_id)->first();
            }
            $car->is_available = $isAvailable;

            $returnCar->user_id = $request->user_id;
            $returnCar->car_id = $request->car_id;
            $returnCar->return_date = date('Y-m-d');
            $returnCar->total_day_rent = $request->total_day_rent;
            $returnCar->total_price_rent = $request->total_price_rent;

            $returnCar->save();
            $car->save();
            $borrowCar->delete();

            return [
                'status' => 200,
                'message' => true,
                'data' => $returnCar
            ];

        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }
}
