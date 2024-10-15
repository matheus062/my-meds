<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Lembrete extends Component
{
    public $lembretes;

    public function __construct($lembretes)
    {
        $this->lembretes = $lembretes;
    }

    public function render()
    {
        return view('components.lembrete');
    }
}
