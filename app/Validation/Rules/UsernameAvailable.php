<?php

# NOTE: This is for example purposes only...
namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class UsernameAvailable extends AbstractRule
{
  public function validate($input)
  {
    return $input === $this->comparison;
  }
}
