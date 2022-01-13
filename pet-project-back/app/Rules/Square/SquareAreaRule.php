<?php

namespace App\Rules\Square;

use App\Components\Shapes\Square;
use App\Rules\BaseRule;

class SquareAreaRule extends BaseRule
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
        $square = null;
        if (request()->input('side')) {
            $this->relatedValue = 'side';
            $square = new Square(floatval(request()->input('side')));
        } else if (request()->input('Square_diagonal')) {
            $this->relatedValue = 'diagonal';
            $square = new Square(null, floatval(request()->input('Square_diagonal')));
        } else if (request()->input('Square_perimeter')) {
            $this->relatedValue = 'perimeter';
            $square = new Square(null, null, null, floatval(request()->input('Square_perimeter')));
        }

        return is_null($square) || floatval($value) === $square->calculateArea();
    }
}
