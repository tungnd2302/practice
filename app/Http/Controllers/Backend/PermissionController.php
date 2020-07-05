<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;

use App\Models\Backend\Permission as AppModel;
use App\Models\Backend\User;
use App\Models\Backend\Role;
use App\Models\Backend\Permission_detail as PermissionDetail;
use App\Models\Backend\Role_permission as RolePermission;


class PermissionController extends BaseController
{
    private $pathView = 'admin.pages.permission';
    private $controllerName = 'permission';
    private $nameInVN       = 'Quyền';
    private $model;

    public function __construct()
    {
        $this->model = new AppModel();
        view()->share([
            'controllerName' => $this->controllerName,
            'nameInVN'       => $this->nameInVN
        ]);
    }

    public function index(Request $request,AppModel $permission)
    {
        $this->authorize('index', $permission);
        $params['status'] = $request->status;
        $params['fieldSearch'] = $request->fieldSearch;
        $params['contentSearch'] =  $request->contentSearch;

        $items  = $this->model->getAllItems($params,['task' => 'get-all-items']);
        $status = $this->model->countItem($params,['task' => 'count-status']);
        // echo '<pre>';
        // print_r($items[0]->Permission_detail->toArray());
        // echo '</pre>';
        // die;
        return view($this->pathView . '.index',[
            'items' => $items,
            'status' => $status,
            'params' => $params,
        ]);
    }

    public function form(Request $request,AppModel $permission){

        $items = [];
        $userModel = new User();
        $users = $userModel->getItem(null,['task' => 'get-active-item']);
        $roleModel = new Role();
        $roles = $roleModel->getItem(null,['task' => 'get-active-item']);
        $actionsModel = [];
        if($request->id){
            $this->authorize('form', $permission);
            $params['id'] = $request->id;
            // die();
            $items = $this->model->getItem($params,['task' => 'get-item']);
            $model = new PermissionDetail();
            $actionsModel = $model->getItem($params,['task' => 'get-action-item']);
        }else{
            $this->authorize('add', $permission);
        }
        return view($this->pathView . '.form',[
            'items' => $items,
            'roles' => $roles,
            'users' => $users,
            'actionsModel' => $actionsModel
        ]);
    }

    public function save(PermissionRequest $request){
        if($request->id)
        {
            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }

            $model = new PermissionDetail();
            $model->deteleItem($params,['task' => 'delete-action-item-by-id-permission']);
            if(isset($fields['action'])){
                foreach($fields['action'] as $action){
                    $params['action'] = $action;
                    $params['id_permission'] = $params['id'];
                    $model->saveItem($params,['task' => 'save-item']);
                }
            }

            $this->model->saveItem($params,['task' => 'update-item']);
            $notify = "Cập nhật ". $this->nameInVN." thành công!";

        }
        else
        {

            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }
            $id_permission = $this->model->saveItem($params,['task' => 'save-item']);

            $model = new PermissionDetail();
            if(isset($fields['action'])){
                foreach($fields['action'] as $action){
                    $params['action'] = $action;
                    $params['id_permission'] = $id_permission;
                    $model->saveItem($params,['task' => 'save-item']);
                }
            }
            $notify = "Tạo ". $this->nameInVN." thành công!";

        }
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }

    public function changestatus(Request $request,AppModel $permission){
        $this->authorize('form', $permission);
        $status = $request->status;
        $id = $request->id;
        $params['id']     = $id;
        $params['status'] = ($status == 0) ? 1 : 0;
        $items = $this->model->saveItem($params,['task' => 'update-item']);
        $notify = "Chuyển trạng thái ". $this->nameInVN." thành công!";
        // return redirect()->route($this->controllerName)->with("practice_notify", $notify);
        return redirect()->back()->with("practice_notify", $notify);
    }

    public function delete(Request $request,AppModel $permission){
        $this->authorize('delete', $permission);
        $id = $request->id;
        $params['id']     = $id;
        $items = $this->model->deteleItem($params,['task' => 'delete-item']);
        // Xóa ở permission_detail
        $modelDetail = new PermissionDetail();
        $modelDetail->deteleItem($params,['task' => 'delete-action-item-by-id-permission']);
        // Xóa ở role_permission
        $modelDetail = new RolePermission();
        $modelDetail->deteleItem($params,['task' => 'delete-action-item-by-permission-id']);

        $notify = "Xóa ". $this->nameInVN." thành công!";
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }


}

