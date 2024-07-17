<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

class SlugGenerator extends Component
{
    public $makeData;
    public $name;
    public $title;
    public $slug;

    public function mount($makeData) {
        $this->makeData = $makeData;
    }

    public function generateSlugTitle(){
        $this->slug = Str::slug($this->title);
    }

    public function generateSlugName(){
        $this->slug = Str::slug($this->name);
    }

    public function render()
    {
        return view('livewire.slug-generator');
    }
}