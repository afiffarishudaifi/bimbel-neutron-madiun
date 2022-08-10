<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecureHeaderMiddleware
{
    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];
    public function handle($request, Closure $next)
    {
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        $response = $next($request);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Strict-Transport-Security', 'max-age:31536000; includeSubDomains');
        $response->headers->set('Content-Security-Policy', "default-src 'self' https://www.google.com/ https://www.google.com/maps https://www.google.com/maps/embed https://maps.gstatic.com/ https://maps.gstatic.com/*; font-src 'self' fonts.gstatic.com/ maxcdn.bootstrapcdn.com/font-awesome/ data:; style-src 'self' fonts.googleapis.com/ maxcdn.bootstrapcdn.com/ 'unsafe-inline'; script-src * data: https://ssl.gstatic.com 'unsafe-inline' 'unsafe-eval';");
        return $response;
    }
    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}
