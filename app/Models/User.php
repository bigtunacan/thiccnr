<?php

namespace App\Models;

class User
{
  public function fullName()
  {
    if(isset($this->last_name)) {
      return $this->first_name . ' ' . $this->last_name;
    } else {
      return $this->first_name;
    }
  }

  public function getFormattedBalance()
  {
    if($this->balance == 0) {
      return 'Zero funds';
    }

    return '$' . number_format($this->balance, 2);
  }
}
