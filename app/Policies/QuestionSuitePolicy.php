<?php

namespace App\Policies;

use App\Policies\Policy;
use App\Models\Backend\User;

class QuestionSuitePolicy extends Policy
{

    protected $site = 'questionSuite'; // scope
    public function __construct(){}

    public function index(User $user){
        return $this->FindPolicy($user,$this->site,'view');
    }

    public function add(User $user){
        return $this->FindPolicy($user,$this->site,'add');
    }

    public function form(User $user){
        return $this->FindPolicy($user,$this->site,'form');
    }

    public function delete(User $user){
        return $this->FindPolicy($user,$this->site,'view');
    }
}
