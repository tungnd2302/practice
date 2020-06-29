<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;

use App\Models\Backend\Permission as AppModel;
use App\Models\Backend\User;
use App\Models\Backend\Role;

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
    //    echo '<pre>';
    //    print_r($items);
    //    echo '</pre>';

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
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';
        // die;
        if($request->id){
            $params['id'] = $request->id;
            $items = $this->model->getItem($params,['task' => 'get-item']);
        }
        return view($this->pathView . '.form',[
            'items' => $items,
            'roles' => $roles,
            'users' => $users
        ]);
    }

    public function save(PermissionRequest $request){
        if($request->id){
            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }
            $items = $this->model->saveItem($params,['task' => 'update-item']);
            $notify = "Cập nhật ". $this->nameInVN." thành công!";
        }else{
            $fields = $request->all();
            foreach($fields as $key => $field){
                $params[$key] = $field;
            }
            $items = $this->model->saveItem($params,['task' => 'save-item']);
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

    public function adddetail(Request $request){
        return view($this->pathView . '.adddetail');
    } 

    public function saveedit(Request $request){
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';

    }


}

