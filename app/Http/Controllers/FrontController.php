<?php

namespace App\Http\Controllers;

use App\BusinessLayer\CustomerBusinessLayer;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FrontController extends Controller
{
    private $customerBusinessLayer;
    public function __construct()
    {
        $this->customerBusinessLayer = new CustomerBusinessLayer();
    }
    public function index()
    {
        if ($this->checkSess()) {
            $allCustomer = $this->customerBusinessLayer->getAllCustomer();
            $params = [
                'title' => 'Circularity Coach Database',
                'customer' => $allCustomer,
            ];

            return view('front.pages.home.index', $params);
        } else {
            return redirect('/login');
        }
    }

    public function login()
    {
        $params = [
            'title' => 'Login',
        ];
        return view('front.pages.login.index', $params);
    }

    public function submitLogin(Request $request)
    {
        $userId = $request->input('userid');
        $password = $request->input('password');
        if ($userId == env('APP_DASHBOARD_USERNAME', 'administrator')) {
            if ($password == env('APP_DASHBOARD_PASSWORD', 'admin@1234')) {
                $request->session()->put('username', 'Administrator');
                $request->session()->put('isLogin', 'true');
                return redirect('/');
            } else {
                session()->flash('errmsg', 'Wrong Password.');
                return redirect('/login');
            }
        } else {
            session()->flash('errmsg', 'Wrong Username.');
            return redirect('/login');
        }
    }

    public function checkSess()
    {
        $isActiveSession = false;
        if (session('isLogin') == 'true') {
            $isActiveSession = true;
        }
        return $isActiveSession;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
