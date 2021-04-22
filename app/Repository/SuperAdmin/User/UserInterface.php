<?php


namespace App\Repository\SuperAdmin\User;


use http\Env\Request;

interface UserInterface
{
    public function remove(Int $user_id);
    public function updateInformation(Int $user_id,Request $request);
}
