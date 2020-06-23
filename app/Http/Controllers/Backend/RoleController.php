<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Backend\Role;


class RoleController extends BaseController
{
    private $pathView = 'admin.pages.role';
    public function index(){
    	$model = new Role();
    	$items = $model->getAllItems(null,['task' => 'get-all-items']);
    	echo '<pre>';
    	print_r($items);
    	echo '</pre>';
    	die;
        return view($this->pathView . '.index');
    }
}

