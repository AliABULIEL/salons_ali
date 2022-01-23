<?php

namespace App\Images;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->orientate()->fit(500, 736);
    }
}
