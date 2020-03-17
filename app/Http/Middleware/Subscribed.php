<?php

namespace App\Http\Middleware;

use Closure;
use App\PaypalSubscription;

class Subscribed
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
        if ($request->user()->role_id == 2) {


            switch ($request->user()->payment_method_id) {
                case 1:
                    
                    if ($request->user() && ! $request->user()->subscribed('main')) {
                        // This user is not a paying customer...
                        return redirect()->route('billing');
                    }
                    break;
                
                case 2:
                    $subscription = PaypalSubscription::where('user_id',$request->user()->id)->latest()->first();
                    
                    if (!$subscription || $subscription->paypal_status != "Active") {
                        // This user is not a paying customer...
                        $dateNow = \Carbon\Carbon::now();

                        if($subscription->ends_at != null && $dateNow <= $subscription->ends_at)
                        {
                            return $next($request);
                        }

                        return redirect()->route('billing');

                    }

                    break;

                case null:
                    
                    return redirect()->route('billing');
                    
                    break;

                
            }
            
            
        }

        return $next($request);
    }
}
