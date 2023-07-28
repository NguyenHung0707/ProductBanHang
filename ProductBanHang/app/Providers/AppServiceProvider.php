<?php

namespace App\Providers;


use App\Reponsitories\Blog\BlogReponsitory;
use App\Reponsitories\Blog\BlogReponsitoryInterface;
use App\Reponsitories\Brand\BrandReponsitory;
use App\Reponsitories\Brand\BrandReponsitoryInterface;
use App\Reponsitories\Order\OrderReponsitory;
use App\Reponsitories\Order\OrderReponsitoryInterface;
use App\Reponsitories\OrderDetail\OrderDetailReponsitory;
use App\Reponsitories\OrderDetail\OrderDetailReponsitoryInterface;
use App\Reponsitories\Product\ProductReponsitory;
use App\Reponsitories\Product\ProductReponsitoryInterface;
use App\Reponsitories\ProductCategory\ProductCategoryReponsitory;
use App\Reponsitories\ProductCategory\ProductCategoryReponsitoryInterface;
use App\Reponsitories\ProductComment\ProductCommentReponsitory;
use App\Reponsitories\ProductComment\ProductCommentReponsitoryInterface;
use App\Reponsitories\User\UserReponsitory;
use App\Reponsitories\User\UserReponsitoryInterface;
use App\Services\Blog\BlogService;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Brand\BrandService;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailService;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryService;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentService;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Product
        $this->app->singleton(
            ProductReponsitoryInterface::class,
            ProductReponsitory::class
        );
        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );


        //ProductComment
        $this->app->singleton(
            ProductCommentReponsitoryInterface::class,
            ProductCommentReponsitory::class
        );
        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );


        //Blog
        $this->app->singleton(
            BlogReponsitoryInterface::class,
            BlogReponsitory::class
        );
        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );

        //ProductCategory
        $this->app->singleton(
            ProductCategoryReponsitoryInterface::class,
            ProductCategoryReponsitory::class
        );
        $this->app->singleton(
            ProductCategoryServiceInterface::class,
            ProductCategoryService::class
        );

        //Brand
        $this->app->singleton(
            BrandReponsitoryInterface::class,
            BrandReponsitory::class
        );
        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );

        //User
        $this->app->singleton(
            UserReponsitoryInterface::class,
            UserReponsitory::class
        );
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );

        //Order
        $this->app->singleton(
            OrderReponsitoryInterface::class,
            OrderReponsitory::class
        );
        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );

        //Order Detail
        $this->app->singleton(
            OrderDetailReponsitoryInterface::class,
            OrderDetailReponsitory::class
        );
        $this->app->singleton(
            OrderDetailServiceInterface::class,
            OrderDetailService::class
        );



    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
