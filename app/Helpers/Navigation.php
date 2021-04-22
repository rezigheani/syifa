<?php


namespace App\Helpers;


use Illuminate\Support\Arr;

class Navigation
{

    /**
     * Menu
     * Roles => [route name => label menu]
     */
    static protected $menus = [
        'default' => [
            'dashboard' => 'dashboard'
        ],
        'super-admin' => [
            'user.list'=>'users',
        ],
        'general' => [
        ]
    ];
    static public function get()
    {
        $data = auth()->user()->getRoleNames()->toArray();
        $result = [];
        foreach (self::$menus as $key => $item){
            $isAccessible = array_search($key,$data);
            if ($isAccessible >= -1 || $key === "default"){
                $result = Arr::collapse([$result,$item]);
            }
        }
        return $result;
    }
}
