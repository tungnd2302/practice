<?php
	namespace App\Models\Backend;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

/**
	 * summary
	 */
	class Role extends Model
	{
	    public $timestamps = false;
	    public $table 	   = 'role';
        protected $fillable = [
            'name', 'status', 'createdby','created_at','update_at'
        ];

	    public function getAllItems($params = null, $options = null)
	    {
	    	if($options['task'] == 'get-all-items'){
	    		return self::paginate(5);
            }

            if($options['task'] == 'count-status'){
                $buttonChangeStatus = config('myapp.template.buttonChangeStatus');
                $totalStatus = [];
                $sumStatus  = 0;
                foreach($buttonChangeStatus as $key => $value){
                    $totalStatus[$key] = $this->where('status',$key)->count();
                    $sumStatus += $totalStatus[$key];
                }
                // $totalStatus['çountStatus'] = $sumStatus;

                return $totalStatus;
            }
        }

        public function saveItem($params = null, $options = null)
        {
            if($options['task'] == 'save-item'){
               date_default_timezone_set("Asia/Bangkok");
               $params['created'] = date('Y-m-d H:i:s',time());
               $params['createdby'] = Auth::user()->fullname;
               $this->insert($params);
            }

            if($options['task'] == 'update-item'){
                $query = $this->where('id',$params['id']);
                array_shift($params);
                $query->update($params);
            }
        }

        public function getItem($params = null, $options = null){
            if($options['task'] == 'get-item'){
                return $this->where('id',$params['id'])->first()->toArray();
            }
        }

	}


?>
