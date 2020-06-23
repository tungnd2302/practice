<?php 
	namespace App\Models\Backend;

	/**
	 * summary
	 */
	class Role
	{
	    public $timestamps = false;
	    public $table 	   = 'role';

	    public function getAllItems($params = null, $options = null)
	    {
	    	if($options['task'] == 'get-all-items'){
	    		$this->get();
	    	}
	    }
	}
	
	
?>