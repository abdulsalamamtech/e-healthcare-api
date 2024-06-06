<?php

namespace App\Helpers;

use App\Models\User;

class UserRoleHelper
{
    public function checkRole($user_id, $find_role){

        $rolesHierarchy = [
            'super-admin' => ['super-admin', 'admin', 'partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'admin' => ['admin', 'partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'partnerships' => ['partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'pharmacies' => ['pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'hospitals' => ['hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'doctors' => ['doctors', 'medical-officers', 'patients', 'emergencies'],
            'medical-officers' => ['medical-officers', 'patients', 'emergencies'],
            'patients' => ['patients', 'emergencies'],
            'emergencies' => ['patients', 'emergencies'],
        ];

        if(!$user_id || !$find_role){ return false; }
        $user = User::find($user_id);
        if(!$user){ return false; }

        if(!count($user->roles)){
            return false;
        }else{
            $roles = [];
            foreach($user->roles as $userRole){
                $roles[] = $userRole->role;
            }

            $all_roles = array_unique($roles);
            foreach($all_roles as $all){
                if(in_array($find_role, $rolesHierarchy[$all], true)){
                    return true;
                }
            }
            return false;
        }
    }

}
