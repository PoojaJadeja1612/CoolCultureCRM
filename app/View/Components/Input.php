<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{

    public $label;
    public $type;
    public $name;
    public $class;
    public $id;
    public $placeholder;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $type, $name, $class = null, $id = null, $placeholder = null, $required = false)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->class = $class;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->required = $required;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
