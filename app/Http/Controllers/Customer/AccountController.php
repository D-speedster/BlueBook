<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display the customer account dashboard
     */
    public function index()
    {
        return view('account.index');
    }
}
