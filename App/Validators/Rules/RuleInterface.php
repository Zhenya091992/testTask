<?php

namespace App\Validators\Rules;

use App\Request;

interface RuleInterface
{
    public function validate(Request $request);
}
