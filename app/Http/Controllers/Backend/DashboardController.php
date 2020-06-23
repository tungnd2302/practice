<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    private $pathView = 'admin.pages';
    public function index(){
        return view($this->pathView . '.dashboard');
    }
}

