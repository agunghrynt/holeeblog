<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

class SlugGenerator extends Component
{
    public $title;
    public $slug;

    public function generateSlug(){
        $this->slug = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.slug-generator');
    }
}
