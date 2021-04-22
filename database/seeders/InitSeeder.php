<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Role
        $general = Role::updateOrCreate(['name' => 'general']);
        $superadmin = Role::updateOrCreate(['name' => 'super-admin']);


        $user = \App\Models\User::updateOrcreate([
            'email' => 'superadmin@gmail.com'], [
            'name' => 'Super-Admin User',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($superadmin);
        $user = \App\Models\User::updateOrCreate([
            'email' => 'general@gmail.com'], [
            'name' => 'General User',
            'email' => 'general@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($general);
    }
}
