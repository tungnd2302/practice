<?php

namespace App\Policies;

use App\Models\Backend\User;

class RolePolicy
{

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){}

    public function index(User $user){
        $permissions = $user->roles->permission;
        echo '<pre>';
        print_r($permissions->toArray());
        echo '<pre>';
        die;
        foreach($permissions as $per){
            echo '<pre>';
            print_r($per->Permission_detail->toArray());
            echo '<pre>';
        }
        die;
    }
}
