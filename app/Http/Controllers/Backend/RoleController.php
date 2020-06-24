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
    private $model;

    public function __construct()
    {
        $this->model = new Role();
        view()->share(['controllerName' => $this->controllerName ]);
    }

    public function index()
    {
    	$model  = new Role();
        $items  = $model->getAllItems(null,['task' => 'get-all-items']);
        $status = $model->countItem(null,['task' => 'count-status']);
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
            $items = $this->model->saveItem($params,['task' => 'update-item']);
            $notify = "Cập nhật phần tử thành công!";
        }else{
            $params['name'] = $request->name;
            $params['status'] = $request->status;
            $items = $this->model->saveItem($params,['task' => 'save-item']);
            $notify = "Tạo phần tử thành công!";
        }
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }

    public function changestatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        $params['id']     = $id;
        $params['status'] = ($status == 0) ? 1 : 0;
        $items = $this->model->saveItem($params,['task' => 'update-item']);
        $notify = "Chuyển trạng thái thành công!";
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }

    public function delete(Request $request){
        $id = $request->id;
        $params['id']     = $id;
        $items = $this->model->deteleItem($params,['task' => 'delete-item']);
        $notify = "Xóa phần tử thành công!";
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }


}

