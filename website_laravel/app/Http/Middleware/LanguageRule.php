<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $array_language = [
            'vn', 'en', 'de'
        ];

        $language = ($request->route()->parameters())['language'];
        //dd($language);

        $flag = 0;
        foreach($array_language as $language_item){
            if($language_item == $language){
                $flag = 1;
                return $next($request);
            }
        }
        
        if($flag == 0){
            return redirect('/tin-tuc');
        }
    }
}
