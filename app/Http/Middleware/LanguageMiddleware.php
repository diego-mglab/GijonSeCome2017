<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
use App\Idioma;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $languages = [];

    public function __construct(){
        $idiomas = Idioma::where('activado','1')->select('codigo')->get();
        foreach($idiomas as $idioma) {
            $this->languages[] = $idioma->codigo;
        }
    }

    public function handle($request, Closure $next)
    {
        if(Session::has('idioma') && in_array(Session::get('idioma'), $this->languages))
            App::setLocale(Session::get('idioma'));
        return $next($request);
    }
}
