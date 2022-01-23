<?php

namespace Averotech\Posts;

use Laravel\Nova\Card;

class Posts extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'posts';
    }

    public function content($posts)
    {
        return $this->withMeta(['content' => $posts]);
    }
}
