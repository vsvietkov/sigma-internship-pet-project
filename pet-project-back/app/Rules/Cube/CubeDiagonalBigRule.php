<?php

namespace App\Rules\Cube;

use App\Components\Shapes\Cube;
use App\Rules\BaseRule;

class CubeDiagonalBigRule extends BaseRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $cube = null;
        if (request()->input('side')) {
            $this->relatedValue = 'side';
            $cube = new Cube(floatval(request()->input('side')));
        } else if (request()->input('Cube_diagonalSmall')) {
            $this->relatedValue = 'small diagonal';
            $cube = new Cube(null, floatval(request()->input('Cube_diagonalSmall')));
        } else if (request()->input('Cube_area')) {
            $this->relatedValue = 'area';
            $cube = new Cube(null, null, null, floatval(request()->input('Cube_area')));
        } else if (request()->input('Cube_volume')) {
            $this->relatedValue = 'volume';
            $cube = new Cube(null, null, null, null, floatval(request()->input('Cube_volume')));
        }

        return is_null($cube) || floatval($value) === $cube->calculateDiagonalBig();
    }
}
