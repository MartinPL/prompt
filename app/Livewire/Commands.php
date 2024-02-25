<?php

namespace App\Livewire;

use Livewire\Attributes\Session;
use Native\Laravel\Facades\Window;

class Commands extends \Livewire\Component
{
    use \App\Items;

    #[Session]
    public $selected = 0;

    #[\Livewire\Attributes\Computed]
    public function commands()
    {
        return \App\Extensions::list()
            ->map(fn ($extension) => $extension->commands)
            ->flatten()
            ->filter(fn ($command) => $command->mode == 'view' && $command->enabled);
    }

    public function enter()
    {
        $command = $this->commands->index($this->selected);

        if ($command->execute) {
            ($command->execute)($this);
        }

        if ($command->route) {
            $this->redirect($command->route);
        }
    }

    public function escape()
    {
        if ($this->query == '') {
            Window::close('main'); // https://github.com/NativePHP/laravel/pull/144
        } else {
            $this->reset('query');
        }
    }

    public function render()
    {
        return view('livewire.commands');
    }
}
