<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;
use Symfony\Component\HttpFoundation\Response;

class CanAccessProfile
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check() && !Auth::user()?->profile?->canAccessProfile()) {
      Toast::danger('Your profile is not completed');
      return redirect()->route('profile');
    }
    return $next($request);
  }
}
