<?php
	namespace App\Models\Backend;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

/**
	 * summary
	 */
	class Permission_detail extends Model
	{
	    public $timestamps = false;
	    public $table 	   = 'permission_detail';
        protected $fillable = [
            'id_permission', 'scope', 'action',
        ];
        private $fieldSearchAccepted = ['id','action'];
        private $fieldSaveNotAccepted = ['_token'];


        public function saveItem($params = null, $options = null)
        {
            if($options['task'] == 'save-item'){
                foreach($params as $key => $item){
                    if(in_array($key,$this->fieldSaveNotAccepted)){
                        unset($params[$key]);
                    }
                }
                $this->insert($params);
            }
        }

        public function getItem($params = null, $options = null){
            if($options['task'] == 'get-item'){
                return $this->where('id',$params['id'])->first()->toArray();
            }
            if($options['task'] == 'get-active-item'){
                return $this->where('status',1)->get()->toArray();
            }

            if($options['task'] == 'get-action-item'){
                return $this->where('id_permission',$params['id_permission'])->get()->toArray();
            }
        }

        public function deteleItem($params = null, $options = null){
            if($options['task'] == 'delete-item'){
                $this->where('id',$params['id'])->delete();
            }
            if($options['task'] == 'delete-action-item'){
                $this->where('id_permission',$params['id_permission'])->delete();
            }
            if($options['task'] == 'delete-action-item-by-id-permission'){
                $this->where('id_permission',$params['id'])->delete();
            }
        }
	}


?>
