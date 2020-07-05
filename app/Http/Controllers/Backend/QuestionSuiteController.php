<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Backend\Role as Role;
use App\Models\Backend\User as User;
use App\Models\Backend\Permission;
use App\Models\Backend\Question_suite;
use App\Models\Backend\Role_permission as RolePermission;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionSuiteRequest;
use Illuminate\Support\Facades\Auth;


class QuestionSuiteController extends BaseController
{
    private $pathView = 'admin.pages.questionsuite';
    private $controllerName = 'questionsuite';
    private $nameInVN       = 'Bộ đề';
    private $model;

    public function __construct()
    {
        $this->model = new Question_suite();
        view()->share([
            'controllerName' => $this->controllerName,
            'nameInVN'       => $this->nameInVN
        ]);
    }

    public function index(Request $request,Question_suite $Question_suite)
    {
        // Auth()->user()->can('index');
        // dd(Auth()->user());
        $this->authorize('index', $Question_suite);
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

    public function form(Request $request,Question_suite $Question_suite){
        $this->authorize('add', $Question_suite);
        $items = [];
        // echo '<pre>';
        // print_r($permissions);
        // echo '<pre>';
        // die;
        if($request->id){
            $this->authorize('form', $Question_suite);
            $params['id'] = $request->id;
            $items = $this->model->getItem($params,['task' => 'get-item']);
        }
        return view($this->pathView . '.form',[
            'items' => $items
        ]);
    }

    public function save(Request $request){
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

    public function changestatus(Request $request,Question_suite $Question_suite){
        $this->authorize('form', $Question_suite);
        $status = $request->status;
        $id = $request->id;
        $params['id']     = $id;
        $params['status'] = ($status == 0) ? 1 : 0;
        $items = $this->model->saveItem($params,['task' => 'update-item']);
        $notify = "Chuyển trạng thái ". $this->nameInVN." thành công!";
        // return redirect()->route($this->controllerName)->with("practice_notify", $notify);
        return redirect()->back()->with("practice_notify", $notify);
    }

    public function delete(Request $request,Question_suite $Question_suite){
        $this->authorize('delete', $Question_suite);
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

