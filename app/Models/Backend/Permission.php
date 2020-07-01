<?php
	namespace App\Models\Backend;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

/**
	 * summary
	 */
	class Permission extends Model
	{
	    public $timestamps = false;
	    public $table 	   = 'permission';
        protected $fillable = [
            'name', 'status', 'createdby','created_at','update_at'
        ];
        private $fieldSearchAccepted = ['id','name'];
        private $fieldSaveNotAccepted = ['_token','action'];

	    public function getAllItems($params = null, $options = null)
	    {
            if($options['task'] == 'get-all-items'){
                $query = $this->select('name','id','status','created');
                if($params['status'] !== null){
                    $query->where('status',$params['status']);
                }

                if($params['fieldSearch'] !== ''){
                    if($params['fieldSearch'] == 'all'){
                        $query->where(function($query) use ($params){
                            foreach($this->fieldSearchAccepted as $column){
                                $query->orWhere($column, 'LIKE',  "%{$params['contentSearch']}%" );
                            }
                        });
                    }elseif(in_array($params['fieldSearch'], $this->fieldSearchAccepted)){
                        $query->where($params['fieldSearch'], 'LIKE',  "%{$params['contentSearch']}%" );
                    }
                }
                return $query->paginate(10);
            }
        }

        public function countItem($params = null, $options = null)
        {
            if($options['task'] == 'count-status'){
                $query = $this->select(self::raw('count(status) as count,status'));
                if($params['fieldSearch'] !== ''){
                    if($params['fieldSearch'] == 'all'){
                        $query->where(function($query) use ($params){
                            foreach($this->fieldSearchAccepted as $column){
                                $query->orWhere($column, 'LIKE',  "%{$params['contentSearch']}%" );
                            }
                        });
                    }elseif(in_array($params['fieldSearch'], $this->fieldSearchAccepted)){
                        $query->where($params['fieldSearch'], 'LIKE',  "%{$params['contentSearch']}%" );
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
                $params['created'] = date('Y-m-d H:i:s',time());
                $params['createdby'] = Auth::user()->fullname;
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
                return $this->where('id',$params['id'])->first()->toArray();
            }

            if($options['task'] == 'get-by-active-status'){
                return $this->select('id','name')->where('status',1)->pluck('name','id')->toArray();
            }

            if($options['task'] == 'get-name-permission'){
                echo '<pre>';
                print_r(self::find($params['id'])->Role_permission()->get());
                echo '</pre>';
                die;
            }


            // get-name-permission
        }

        public function deteleItem($params = null, $options = null){
            if($options['task'] == 'delete-item'){
                $this->where('id',$params['id'])->delete();
            }
        }

        public function findItem($params = null, $options = null){
            if($options['task'] == 'get-items-active'){
                return $this->select('id','name')
                            ->where('status',1)->pluck('name','id')
                            ->toArray();
            }
        }

        public function Role()
        {
            return $this->belongsToMany('App\Models\Backend\Role','App\Models\Backend\Role_permision','permission_id','role_id');
        }

        //'role_id','permission_id'

	}


?>
