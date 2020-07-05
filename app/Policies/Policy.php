<?php

namespace App\Policies;

class Policy
{
    public function FindPolicy($user,$site,$actionAccepted){
        $permissions = $user->roles->permission;
        if(count($permissions) > 0){
            foreach($permissions as $per){
                if($per['scope'] == $site){
                    $permissionActions = $per->Permission_detail->toArray(); // view,add,form
                    foreach($permissionActions as $item){
                        if($item['action'] == $actionAccepted){
                            return $user->id;
                        }
                    }
                }
             }
        }else{
            // return 1;
        }
    }
}
