<?php

namespace App\Providers;

use App\Models\Option;
use App\Models\Complain;
use App\Models\NotificationComplain;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\NotificationComplainReply;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();


        view()->composer('components.navbar-admin', function ($view) {
            $unread_complains_notification = NotificationComplain::where(['is_read' => 0, 'admin_id' => Auth::guard('admin')->user()->id])->limit(5)->orderBy('id', 'DESC')->get();
            $unread_complains_notification_count = NotificationComplain::where(['is_read' => 0, 'admin_id' => Auth::guard('admin')->user()->id])->count();

            $view->with('unread_complains', $unread_complains_notification);
            $view->with('unread_complains_count', $unread_complains_notification_count);    
            
        });


        view()->composer('components.navbar', function($view) {
        
            $unread_complains_reply_notifications = NotificationComplainReply::where(['is_read' => 0, 'user_id' => auth()->user()->id])->limit(5)->orderBy('id', 'DESC')->get();
            $unread_complains_reply_notifications_count = NotificationComplainReply::where(['is_read' => 0, 'user_id' => auth()->user()->id])->count();
            $view->with('unread_complain_replies', $unread_complains_reply_notifications);
            $view->with('unread_complain_replies_count', $unread_complains_reply_notifications_count);
            
        });


        view()->composer('components.sidebar', function($view){
            
            $option = Option::select('value')->where(['name' => 'site_title'])->first();   
            $siteTitle =  $option['value'];
            $view->with('siteTitle', $siteTitle);
        });

        view()->composer('components.sidebar-admin', function($view){
            
            $option = Option::select('value')->where(['name' => 'site_title'])->first();   
            $siteTitle =  $option['value'];
            $view->with('siteTitle', $siteTitle);
        });


    }
}
