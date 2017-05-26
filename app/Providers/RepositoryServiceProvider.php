<?php

namespace Aizxin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\PermissionRepository::class, \Aizxin\Repositories\Eloquent\PermissionRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\RoleRepository::class, \Aizxin\Repositories\Eloquent\RoleRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\AdRepository::class, \Aizxin\Repositories\Eloquent\AdRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\AreaRepository::class, \Aizxin\Repositories\Eloquent\AreaRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\ArticleCategoryRepository::class, \Aizxin\Repositories\Eloquent\ArticleCategoryRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\ArticleRepository::class, \Aizxin\Repositories\Eloquent\ArticleRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\CheatCategoryRepository::class, \Aizxin\Repositories\Eloquent\CheatCategoryRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\CheatRepository::class, \Aizxin\Repositories\Eloquent\CheatRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\CityRepository::class, \Aizxin\Repositories\Eloquent\CityRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\CoachRepository::class, \Aizxin\Repositories\Eloquent\CoachRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\MemberRepository::class, \Aizxin\Repositories\Eloquent\MemberRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\PurchaseRepository::class, \Aizxin\Repositories\Eloquent\PurchaseRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\QuestionCategoryRepository::class, \Aizxin\Repositories\Eloquent\QuestionCategoryRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\QuestionRepository::class, \Aizxin\Repositories\Eloquent\QuestionRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\SchoolCommentRepository::class, \Aizxin\Repositories\Eloquent\SchoolCommentRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\SchoolRepository::class, \Aizxin\Repositories\Eloquent\SchoolRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\UserRepository::class, \Aizxin\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\WaypointCategoryRepository::class, \Aizxin\Repositories\Eloquent\WaypointCategoryRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\WaypointRepository::class, \Aizxin\Repositories\Eloquent\WaypointRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\CoachCommentRepository::class, \Aizxin\Repositories\Eloquent\CoachCommentRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\MemberApplyRepository::class, \Aizxin\Repositories\Eloquent\MemberApplyRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\MemberApproveRepository::class, \Aizxin\Repositories\Eloquent\MemberApproveRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\SchoolApproveRepository::class, \Aizxin\Repositories\Eloquent\SchoolApproveRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\CoachApproveRepository::class, \Aizxin\Repositories\Eloquent\CoachApproveRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\OrderRepository::class, \Aizxin\Repositories\Eloquent\OrderRepositoryEloquent::class);
        $this->Aizxin->bind(\Aizxin\Repositories\Contracts\OrderPayRepository::class, \Aizxin\Repositories\Eloquent\OrderPayRepositoryEloquent::class);
        //:end-bindings:
    }
}
