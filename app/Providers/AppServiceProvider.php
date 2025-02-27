<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\WebsiteInfo;
use Illuminate\Pagination\Paginator;

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
        $websiteInfo = WebsiteInfo::findOrFail(1); // Lấy dữ liệu từ CSDL
        view()->share('websiteInfo', $websiteInfo);

        Paginator::useBootstrap(); // Kích hoạt giao diện Bootstrap

    }
}
