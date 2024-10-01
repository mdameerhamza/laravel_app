<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Storyblock extends Component
{
    public $storyblok,$data, $slug;

    public function render($slug = 'house')
    {

        $storyblok = new \Storyblok\Client('eBMjUBCjtvMfspq89pCWdwtt');
        $storyblok->editMode();
        $data = $storyblok->getStoryBySlug($slug)->getBody();

        return view('livewire.storyblock', ['story' => (object)$data['story']]);
    }


}
