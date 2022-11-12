<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Error extends Component
{
    public $fieldName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.error');
    }
}
