<?php

namespace League\Glide\Manipulators;

use Intervention\Image\Image;

/**
 * @property string $trimbase
 * @property array $trimaway
 * @property string $trimtol
 * @property string $trimfea
 */
class Trim extends BaseManipulator
{
    /**
     * Perform trim image manipulation.
     * @param  Image $image The source image.
     * @return Image The manipulated image.
     */
    public function run(Image $image)
    {
        $image->trim(
            $this->getBase(),
            $this->getAway(),
            $this->getTolerance(),
            $this->getFeather()
        );

        return $image;
    }

    public function getBase()
    {
        if (!in_array($this->trimbase, ['top-left', 'bottom-right', 'transparent'], true)) {
            return 'top-left';
        }

        return $this->trimbase;
    }

    public function getAway()
    {
        $sides = array_filter(explode(',', $this->trimaway), function($side) {
            return in_array($side, ['top', 'bottom', 'left', 'right'], true);
        });

        return empty($sides) ? null : $sides;
    }

    public function getTolerance()
    {
        if (!is_numeric($this->trimtol)) {
            return;
        }

        if ($this->trimtol < 0 or $this->trimtol > 100) {
            return;
        }

        return (int) $this->trimtol;
    }

    public function getFeather()
    {
        if (!is_numeric($this->trimfea)) {
            return;
        }

        if ($this->trimfea < 0) {
            return;
        }

        return (int) $this->trimfea;
    }
}
