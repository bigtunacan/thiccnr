<?php

# NOTE: This is for example purposes only...
namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class IsSameAsException extends ValidationException
{
  public static $defaultTemplates = [
    self::MODE_DEFAULT => [
      self::STANDARD => '{{name}} must be {{comparison}}',
    ],
    self::MODE_NEGATIVE => [
      self::STANDARD => '{{name}} must not be {{comparison}}',
    ]
  ];
}
