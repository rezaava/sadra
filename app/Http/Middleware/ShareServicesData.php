<?php

namespace App\Http\Middleware;

use App\Models\ServiceCategory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ShareServicesData
{
    public function handle(Request $request, Closure $next): Response
    {
        $categories = ServiceCategory::with([
            'services.items'
        ])
            ->orderBy('id')
            ->get();

        view()->share('headerServices', $categories);

        return $next($request);
    }
}