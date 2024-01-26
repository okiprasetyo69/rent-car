<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Items;
use App\Models\Transactions;

class HomeController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('layout.home');
    }

    // Admin Page
    public function adminDashboardPage(){
        return view('user.admin.index');
    }
    public function managementCarPage(){
        return view('user.admin.management_car');
    }
    // Consumer Page
    public function borrowCarPage(){
        return view('user.admin.borrow_car');
    }
    public function returnCarPage(){
        return view('user.admin.return_car');
    }
    // Register Page
    public function registerUser(){
        return view('user.register_user');
    }
}
