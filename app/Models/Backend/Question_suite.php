<?php
	namespace App\Models\Backend;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

/**
	 * summary
	 */
	class Question_suite extends Model
	{
	    public $timestamps = false;
	    public $table 	   = 'question_suite';
        protected $fillable = [
            'name', 'status', 'createdby','created_at','update_at'
        ];
        private $fieldSearchAccepted = ['id','name','description'];
        private $fieldSaveNotAccepted = ['_token'];

	    public function getAllItems($params = null, $options = null)
	    {
            if($options['task'] == 'get-all-items'){
                $query = $this->select('name','id','status','created','level','description');
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
                $id = $this->insertGetId($params);
                return $id;
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
            if($options['task'] == 'get-active-item'){
                return $this->where('status',1)->get()->toArray();
            }

            if($options['task'] == 'get-name-permission'){
              return self::find($params['id'])->Permission()->pluck('permission.id')->toArray();
            }

            if($options['task'] == 'get-info-item'){
                return $this->where('id',$params['id'])->first();
            }

            //get-name-permission
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

        public function Users()
        {
            return $this->hasMany('App\Models\Backend\Role\User','roleid','id');
        }

        public function Permission()
        {
            return $this->belongsToMany('App\Models\Backend\Permission','App\Models\Backend\Role_permission','role_id','permission_id');
        }

	}


?>
