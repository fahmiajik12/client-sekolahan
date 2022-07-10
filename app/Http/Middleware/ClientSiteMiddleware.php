<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Http;
use Closure;

class ClientSiteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('tokenUser')) {
            session()->put('tokenUser',null);
        }
        $response = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT").'/api/cek-token');
        $dataResponse = json_decode($response);
        //dd($response);
        if ($dataResponse) {
            session()->put('userLogged',$dataResponse->data);

            return $next($request);
        } else {
            session()->put('userLogged',null);

            return redirect()->route('login')->with('danger','Silahkan login terlebih dahulu!');
        }
    }
}