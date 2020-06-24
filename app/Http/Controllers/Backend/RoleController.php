<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Backend\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;


class RoleController extends BaseController
{
    private $pathView = 'admin.pages.role';
    private $controllerName = 'role';

    public function __construct()
    {
        view()->share(['controllerName' => $this->controllerName ]);
    }

    public function index()
    {
    	$model  = new Role();
        $items  = $model->getAllItems(null,['task' => 'get-all-items']);
        $status = $model->getAllItems(null,['task' => 'count-status']);
        return view($this->pathView . '.index',[
            'items' => $items,
            'status' => $status
        ]);
    }

    public function form(Request $request){
        $items = [];
        if($request->id){
            $params['id'] = $request->id;
            $model = new Role();
            $items = $model->getItem($params,['task' => 'get-item']);
        }
        return view($this->pathView . '.form',['items' => $items]);
    }

    public function save(RoleRequest $request){
        if($request->id){
            $params['id'] = $request->id;
            $params['name'] = $request->name;
            $params['status'] = $request->status;
            $model = new Role();
            $items = $model->saveItem($params,['task' => 'update-item']);
        }else{
            $params['name'] = $request->name;
            $params['status'] = $request->status;
            $model = new Role();
            $items = $model->saveItem($params,['task' => 'save-item']);
        }
        return redirect()->route($this->controllerName);
    }

    public function changestatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        $params['id']     = $id;
        $params['status'] = ($status == 0) ? 1 : 0;
        $model = new Role();
        $items = $model->saveItem($params,['task' => 'update-item']);
        return redirect()->route($this->controllerName);
    }


}

