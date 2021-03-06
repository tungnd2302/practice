<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Backend\Role as Role;
use App\Models\Backend\User as User;
use App\Models\Backend\Permission;
use App\Models\Backend\Role_permission as RolePermission;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;


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

    public function index(Request $request,Role $role)
    {
        // Auth()->user()->can('index');
        // dd(Auth()->user());
        $this->authorize('index', $role);
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

    public function form(Request $request,Role $role){
        $this->authorize('add', $role);
        $items = [];
        $model = new Permission();
        $permissions = $model->getItem(null,['task' => 'get-by-active-status']);
        $permissions_selected = [];
        // echo '<pre>';
        // print_r($permissions);
        // echo '<pre>';
        // die;
        if($request->id){
            $this->authorize('form', $role);
            $params['id'] = $request->id;
            $model = new Role();
            $permissions_selected = $model->getItem($params,['task' => 'get-name-permission']);
            $items = $this->model->getItem($params,['task' => 'get-item']);
        }
        return view($this->pathView . '.form',[
            'items' => $items,
            'permissions' => $permissions,
            'permissions_selected' => $permissions_selected
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
            if(isset($fields['permission_id'])){
                foreach($fields['permission_id'] as $key => $field){
                    $params['permission_id'] = $field;
                    $params['role_id'] = $params['id'];
                    $model->saveItem($params,['task' => 'save-item']);
                }
            }

            $notify = "Cập nhật ". $this->nameInVN." thành công!";
        }else{
            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }

            $lastId = $this->model->saveItem($params,['task' => 'save-item']);
            $model = new RolePermission();
            if(isset($fields['permission_id'])){
                foreach($fields['permission_id'] as $key => $field){
                    $params['permission_id'] = $field;
                    $params['role_id'] = $lastId;
                    $model->saveItem($params,['task' => 'save-item']);
                }
            }
            $notify = "Tạo ". $this->nameInVN." thành công!";
        }
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }

    public function changestatus(Request $request,Role $role){
        $this->authorize('form', $role);
        $status = $request->status;
        $id = $request->id;
        $params['id']     = $id;
        $params['status'] = ($status == 0) ? 1 : 0;
        $items = $this->model->saveItem($params,['task' => 'update-item']);
        $notify = "Chuyển trạng thái ". $this->nameInVN." thành công!";
        // return redirect()->route($this->controllerName)->with("practice_notify", $notify);
        return redirect()->back()->with("practice_notify", $notify);
    }

    public function delete(Request $request,Role $role){
        $this->authorize('delete', $role);
        $id = $request->id;
        $params['id']     = $id;
        $items = $this->model->deteleItem($params,['task' => 'delete-item']);
        $notify = "Xóa ". $this->nameInVN." thành công!";
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }

    public function view(Request $request){
        $params['id'] = $request->id;
        $item = $this->model->getItem($params,['task' => 'get-info-item']);
        $modelUser = new User;
        $users =  $modelUser->getItem($params,['task' => 'get-users-in-role']);
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';
        // die;
        return view($this->pathView . '.view',[
            'item' => $item,
            'users' => $users
        ]);
    }


}

