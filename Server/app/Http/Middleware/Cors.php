<?php
namespace App\Http\Middleware;
use Closure;
class Cors
{
  public function handle($request, Closure $next)
  {
    return $next($request)
       //Url a la que se le dará acceso en las peticiones
      ->header("Access-Control-Allow-Origin", "http://localhost:8000")
      ->header("Access-Control-Allow-Origin", "http://localhost:8090")
      //Métodos que a los que se da acceso
      ->header("Access-Control-Allow-Methods", "GET, POST, PUT, PATCH, DELETE")
      //Headers de la petición
      ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");
  }
}
