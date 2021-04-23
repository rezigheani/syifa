<?php


namespace App\Repository\SuperAdmin\User;


use App\Models\Profile;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public $defaultPassword = "password";

    public function remove(int $user_id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($user_id);
            if ($user) {
                // remove profile
                $profile = Profile::where('user_id', $user_id)->first();
                if ($profile){
                    $profile->delete();
                }
                // remove user
                $data_user = $user;
                $user->syncRoles([]);
                $user->delete();
                DB::commit();
                return $data_user;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return false;

        }
    }

    public function updateInformation(int $user_id, Request $request)
    {
    }

    public function resetPassword(int $user_id)
    {
        DB::beginTransaction();
        try {

            $user = User::find($user_id);
            if ($user) {
                $user->update(['password' => Hash::make($this->defaultPassword)]);
                DB::commit();
                return $user;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            return false;
        }

    }
}
