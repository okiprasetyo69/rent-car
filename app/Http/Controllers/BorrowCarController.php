<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Helpers\GlobalHelper;
use App\Models\BorrowCars;
use App\Models\Cars;

class BorrowCarController extends Controller
{
    public function getBorrowCars(Request $request){
        try{
            $userId = auth()->user()->id;
            $borrowCars = BorrowCars::with('cars')->where('user_id', $userId)->orderBy('id', 'DESC');
            if($request->car_id != null){
                $borrowCars->where('car_id', $request->car_id);
            }
            $borrowCars = $borrowCars->get();
            return [
                'status' => 200,
                'message' => true,
                'data' => $borrowCars
            ];
       }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
       }
    }

    public function borrowCar(Request $request){
        try{
            $borrowCar = new BorrowCars();
            $car = new Cars(); 
            
            $borrowCar->user_id = $request->user_id;
            $borrowCar->car_id = $request->car_id;
            $borrowCar->start_date = $request->start_date;
            $borrowCar->end_date = $request->end_date;

            $borrowCar->save();

            $car = $car::find($request->car_id);
            if($car != null){
                $car->is_available = 0;
            }

            $car->save();

            return [
                'status' => 200,
                'message' => true,
                'data' => $borrowCar
            ];
            
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }
}
