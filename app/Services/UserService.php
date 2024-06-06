<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function Role($user_id, $user_role){
        $roles = [];
        if(!$user_id || !$user_role){
            return false;
        }else{

            $user = User::find($user_id);
            if($user){

                foreach($user->roles as $userRole){
                    $roles[] = $userRole->role;
                }

                if(in_array($user_role, $roles, true)){
                    return true;
                }
            }

        }
        return false;
    }
}
