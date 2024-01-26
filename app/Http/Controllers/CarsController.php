<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Helpers\GlobalHelper;

class CarsController extends Controller
{

    public function getCars(Request $request){
       
       try{
            $cars = Cars::orderBy('id', 'DESC');

            if($request->brand_name != null){
                $cars->where("brand_name", "like", "%" . $request->brand_name. "%");
            }

            if($request->model != null){
                $cars->where("model", "like", "%" . $request->model. "%");
            }

            if($request->is_available != null){
                $cars->where("is_available", $request->is_available);
            }

            if($request->id != null){
                $cars->where("id", $request->id);
            }

            $cars = $cars->get();
            return [
                'status' => 200,
                'message' => true,
                'data' => $cars
            ];
       }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
       }
    }

    public function createCars(Request $request){
       
        try{

            $car = new Cars();
            $isAvailable = 1;
            $car->fill($request->all());

            if($request->id != null){
                $car = $car::find($request->id);
            }

            $car->brand_name = $request->brand_name;
            $car->model = $request->model;
            $car->plat_number = $request->plat_number;
            $car->price_rent = $request->price_rent;
            $car->is_available = $isAvailable;
            $car->save();
          
            return [
                'status' => 200,
                'message' => true,
                'data' => $car
            ];
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
       
    }

    public function availableCar(Request $request){
        try{
            $isAvailable = 1;
            $cars = Cars::where('is_available', $isAvailable)->orderBy('id', 'DESC')->get();
            return [
                'status' => 200,
                'message' => true,
                'data' => $cars
            ];
       }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
       }
    }
}
