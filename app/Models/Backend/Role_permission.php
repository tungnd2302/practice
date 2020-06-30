<?php

namespace App\Models\Backend;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Role_permission extends Authenticatable
{
    use Notifiable;
    protected $table = 'role_permission';
    public $timestamps = false;
    protected $fillable = [
        'role_id', 'permission_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    private $fieldSearchAccepted = ['id','fullname','username'];
    private $fieldSaveNotAccepted = ['_token', 'name', 'status', 'createdby','created_at','update_at','id_permission'];
    protected $primaryKey = 'id';

    public function getAllItems($params = null, $options = null)
	    {
            if($options['task'] == 'get-all-items'){
                $query = $this->select('fullname','users.id as id','users.status','users.created','username','name as rolename','role.status as rolestatus')
                              ->leftjoin('role','users.roleid','=','role.id');
                if($params['status'] !== null){
                    $query->where('users.status',$params['status']);
                }

                if($params['fieldSearch'] !== ''){
                    if($params['fieldSearch'] == 'all'){
                        $query->where(function($query) use ($params){
                            foreach($this->fieldSearchAccepted as $column){
                                $query->orWhere('users.'.$column, 'LIKE',  "%{$params['contentSearch']}%" );
                            }
                        });
                    }elseif(in_array($params['fieldSearch'], $this->fieldSearchAccepted)){
                        $query->where('users.'.$params['fieldSearch'], 'LIKE',  "%{$params['contentSearch']}%" );
                    }
                }
                return $query->paginate(10);
            }
        }

    public function countItem($params = null, $options = null)
    {
        if($options['task'] == 'count-status'){
            $query = $this->select(self::raw('count(users.status) as count,users.status'));
            if($params['fieldSearch'] !== ''){
                if($params['fieldSearch'] == 'all'){
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere('users.'.$column, 'LIKE',  "%{$params['contentSearch']}%" );
                        }
                    });
                }elseif(in_array($params['fieldSearch'], $this->fieldSearchAccepted)){
                    $query->where('users.'.$params['fieldSearch'], 'LIKE',  "%{$params['contentSearch']}%" );
                }
            }
            $statusGroup = $query->groupBy('status')->get()->toArray();
            return $statusGroup;
        }
    }
    //->select(DB::raw('count(*) as user_count, status'))

    public function saveItem($params = null, $options = null)
    {
        if($options['task'] == 'save-item'){
            date_default_timezone_set("Asia/Bangkok");
            foreach($params as $key => $item){
                if(in_array($key,$this->fieldSaveNotAccepted)){
                    unset($params[$key]);
                }
            }
            echo '<pre>';
            print_r($params);
            echo '<pre>';

            $this->insert($params);
        }

        if($options['task'] == 'update-item'){
            foreach($params as $key => $item){
                if(in_array($key,$this->fieldSaveNotAccepted)){
                    unset($params[$key]);
                }
            }
            $query = $this->where('id',$params['id']);
            array_shift($params);
            $query->update($params);
        }
    }

    public function getItem($params = null, $options = null){
        if($options['task'] == 'get-item'){
            // return self::find($params['id'])->first();
            $items['info']['user'] =  self::find($params['id'])->where('id',$params['id'])->first()->toArray();
            $roleid = $items['info']['user']['roleid'];
            if($roleid < 0){
                return $items['info'];
            }
            $items['info']['role'] =  self::find($params['id'])->roles()->where('id',$roleid)->first()->toArray();
            return $items['info'];
        }

        if($options['task'] == 'get-active-item'){
            return $this->select('id','username')->where('status',1)->pluck('username', 'id')->toArray();
        }
        // return self::find($params['id'])->roles()->first();
    }

    public function deteleItem($params = null, $options = null){
        if($options['task'] == 'delete-item'){
            $this->where('id',$params['id'])->delete();
        }
    }

    public function roles()
    {
        return $this->belongsTo('App\Models\Backend\Role','roleid','id');
    }

}
