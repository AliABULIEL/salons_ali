<?php

namespace App\Images;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->orientate()->fit(500 * 1.5, 736 * 1.5);
    }
}
