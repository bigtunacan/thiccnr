<?php

# NOTE: This is for example purposes only...
namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class IsSameAs extends AbstractRule
{
  protected $comparison;

  public function __construct($comparison)
  {
    $this->comparison = $comparison;
  }

  public function validate($input)
  {
    return $input === $this->comparison;
  }
}
