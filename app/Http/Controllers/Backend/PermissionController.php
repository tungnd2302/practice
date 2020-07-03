<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;

use App\Models\Backend\Permission as AppModel;
use App\Models\Backend\User;
use App\Models\Backend\Role;
use App\Models\Backend\Permission_detail as PermissionDetail;


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

    public function index(Request $request)
    {
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

    public function form(Request $request){
        $items = [];
        $userModel = new User();
        $users = $userModel->getItem(null,['task' => 'get-active-item']);
        $roleModel = new Role();
        $roles = $roleModel->getItem(null,['task' => 'get-active-item']);
        $actionsModel = [];
        if($request->id){
            $params['id'] = $request->id;
            $items = $this->model->getItem($params,['task' => 'get-item']);
            $model = new PermissionDetail();
            $actionsModel = $model->getItem($params,['task' => 'get-action-item']);
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
            foreach($fields['action'] as $action){
                $params['action'] = $action;
                $params['id_permission'] = $params['id'];
                $model->saveItem($params,['task' => 'save-item']);
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
            foreach($fields['action'] as $action){
                $params['action'] = $action;
                $params['id_permission'] = $id_permission;
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
        $model = new PermissionDetail();
        $model->deteleItem($params,['task' => 'delete-action-item-by-id-permission']);
        $notify = "Xóa ". $this->nameInVN." thành công!";
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }


}

