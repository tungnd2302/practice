<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller as BaseController;
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

    public function index(Request $request,User $user)
    {
        $this->authorize('index', $user);
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

    public function form(Request $request,User $user){
        $this->authorize('add', $user);
        $item = [];
        $roleModel = new Role();
        $roles = $roleModel->findItem(null,['task' => 'get-items-active']);
        // echo '<pre>';
        // print_r($roles);
        // echo '</pre>';
        // die;
        if($request->id){
            $this->authorize('form', $user);
            $params['id'] = $request->id;
            $item = $this->model->getItem($params,['task' => 'get-item']);
            // echo '<pre>';
            // print_r($item);
            // echo '</pre>';
            // die;
        }

        return view($this->pathView . '.form',[
            'item' => $item,
            'roles' => $roles
        ]);
    }

    public function save(UserRequest $request){
        if($request->id){
            // echo '<pre>';
            // print_r($request->id);
            // echo '</pre>';
            // die;
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

    public function changestatus(Request $request,User $user){
        $this->authorize('form', $user);
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

    public function delete(Request $request,User $user){
        $this->authorize('form', $user);
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

