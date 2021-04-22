<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Psy\Util\Str;

class Select extends Component
{
    public $name;
    public $option;
    public $value;
    public $multiple;
    public $ids;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $option, $value = "",$multiple=false)
    {
        //
        $this->name = $name;
        $this->option = $option;
        $this->value = $value;
        $this->multiple = $multiple;
        $this->ids = \Illuminate\Support\Str::random(10);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
