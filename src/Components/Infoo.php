<?php

namespace Fgx\Components;

use Illuminate\View\Component;

class Infoo extends Component
{
    public $id;
    public $info;
    public $class;
    public $atts;


    public function __construct(
        $id = null,
        $info = null,
        $class = null,
        $atts = [],
    ) {
        $this->id = $id;
        $this->info = $info;
        $this->class = $class;
        $this->atts = $atts;
    }

    public function render()
    {
        return view('fgx::components.info');
    }
}