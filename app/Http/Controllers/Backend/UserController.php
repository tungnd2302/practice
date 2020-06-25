<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Backend\User;
use App\Models\Backend\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    private $pathView = 'admin.pages.user';
    private $controllerName = 'user';
    private $nameInVN       = 'Người dùng';
    private $model;

    public function __construct()
    {
        $this->model = new User();
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
        $roleModel = new Role();
        $roles = $roleModel->findItem(null,['task' => 'get-items-active']);
        if($request->id){
            $params['id'] = $request->id;
            $items = $this->model->getItem($params,['task' => 'get-item']);
        }
        // echo '<pre>';
        // print_r($items);
        // echo '<pre>';
        // die;
        return view($this->pathView . '.form',[
            'items' => $items,
            'roles' => $roles
        ]);
    }

    public function save(UserRequest $request){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die;
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

    public function view(Request $request){
        $params['id'] = $request->id;
        $items = $this->model->getItem($params,['task' => 'get-item']);
        return view($this->pathView . '.view',[
            'items' => $items
        ]);
    }

    public function delete(Request $request){
        $id = $request->id;

        if(Auth()->user()->id == $id){
            $notify = "Không thể xóa nhân viên này";
        }else{
            $params['id']     = $id;
            $items = $this->model->deteleItem($params,['task' => 'delete-item']);
            $notify = "Xóa ". $this->nameInVN." thành công!";
        }
        return redirect()->route($this->controllerName)->with("practice_notify", $notify);
    }


}

