<?php

namespace App\Middleware;

use PDO;

class IpFilter
{

  protected $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function __invoke($request, $response, $next)
  {
    if(!$this->allowed($_SERVER['REMOTE_ADDR'])) {
      return $response->withStatus(401)->write('Denied');
    }

    // get IPs
    // check current ip is in list
    return $next($request, $response);
  }

  protected function allowed($ip) {
    $ips = $this->db->query("SELECT ip FROM blocked")->fetchAll(PDO::FETCH_COLUMN, 0);
    return !in_array($ip, $ips);
  }
}
