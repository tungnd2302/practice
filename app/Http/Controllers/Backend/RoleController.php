<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Backend\Role;
use App\Models\Backend\Permission;
use App\Models\Backend\Role_permission as RolePermission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;


class RoleController extends BaseController
{
    private $pathView = 'admin.pages.role';
    private $controllerName = 'role';
    private $nameInVN       = 'Chức vụ';
    private $model;

    public function __construct()
    {
        $this->model = new Role();
        view()->share([
            'controllerName' => $this->controllerName,
            'nameInVN'       => $this->nameInVN
        ]);
    }

    public function index(Request $request)
    {
        $params['status'] = $request->status;
        $params['fieldSearch'] = $request->fieldSearch;
        $params['contentSearch'] =  $request->contentSearch;

        $items  = $this->model->getAllItems($params,['task' => 'get-all-items']);
        $status = $this->model->countItem($params,['task' => 'count-status']);
        return view($this->pathView . '.index',[
            'items' => $items,
            'status' => $status,
            'params' => $params,
        ]);
    }

    public function form(Request $request){
        $items = [];
        $model = new Permission();
        $permissions = $model->getItem(null,['task' => 'get-by-active-status']);
        // echo '<pre>';
        // print_r($permissions);
        // echo '<pre>';
        // die;
        if($request->id){
            $params['id'] = $request->id;
            $model = new Role();
            $permissions = $model->getItem($params,['task' => 'get-name-permission']);

            $items = $this->model->getItem($params,['task' => 'get-item']);
        }
        return view($this->pathView . '.form',[
            'items' => $items,
            'permissions' => $permissions
        ]);
    }

    public function save(RoleRequest $request){
        if($request->id){
            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }
            $items = $this->model->saveItem($params,['task' => 'update-item']);

            $model = new RolePermission();
            $model->deteleItem($params,['task' => 'delete-item-by-role-id']);
            foreach($fields['permission_id'] as $key => $field){
                $params['permission_id'] = $field;
                $params['role_id'] = $params['id'];
                $model->saveItem($params,['task' => 'save-item']);
            }

            $notify = "Cập nhật ". $this->nameInVN." thành công!";
        }else{
            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }

            $lastId = $this->model->saveItem($params,['task' => 'save-item']);
            $model = new RolePermission();
            foreach($fields['permission_id'] as $key => $field){
                $params['permission_id'] = $field;
                $params['role_id'] = $lastId;
                $model->saveItem($params,['task' => 'save-item']);
            }
            $notify = "Tạo ". $this->nameInVN." thành công!";
        }
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }

    public function changestatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        $params['id']     = $id;
        $params['status'] = ($status == 0) ? 1 : 0;
        $items = $this->model->saveItem($params,['task' => 'update-item']);
        $notify = "Chuyển trạng thái ". $this->nameInVN." thành công!";
        // return redirect()->route($this->controllerName)->with("practice_notify", $notify);
        return redirect()->back()->with("practice_notify", $notify);
    }

    public function delete(Request $request){
        $id = $request->id;
        $params['id']     = $id;
        $items = $this->model->deteleItem($params,['task' => 'delete-item']);
        $notify = "Xóa ". $this->nameInVN." thành công!";
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }


}

