<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $post;
    public $comments;

    public function __construct($post, $comments)
    {
        return ([$this->post = $post, $this->comments = $comments]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-show');
    }
}
