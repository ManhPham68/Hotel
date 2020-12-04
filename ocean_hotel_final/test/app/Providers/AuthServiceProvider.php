<?php

namespace App\Providers;

use App\Policies\BookingPolicy;
use App\Policies\FacilityPolicy;
use App\Policies\GuestPolicy;
use App\Policies\RoomPolicy;
use App\Policies\RoomTypePolicy;
use App\Policies\SliderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('list_room',[RoomPolicy::class,'view']);
        Gate::define('add_room',[RoomPolicy::class,'create']);
        Gate::define('edit_room',[RoomPolicy::class,'update']);
        Gate::define('delete_room',[RoomPolicy::class,'delete']);

        Gate::define('list_guest',[GuestPolicy::class,'view']);
        Gate::define('edit_guest',[GuestPolicy::class,'update']);
        Gate::define('delete_guest',[GuestPolicy::class,'delete']);

        Gate::define('list_booking',[BookingPolicy::class,'view']);
        Gate::define('add_booking',[BookingPolicy::class,'create']);
        Gate::define('edit_booking',[BookingPolicy::class,'update']);
        Gate::define('delete_booking',[BookingPolicy::class,'delete']);

        Gate::define('list_facility',[FacilityPolicy::class,'view']);
        Gate::define('add_facility',[FacilityPolicy::class,'create']);
        Gate::define('edit_facility',[FacilityPolicy::class,'update']);
        Gate::define('delete_facility',[FacilityPolicy::class,'delete']);

        Gate::define('list_RoomType',[RoomTypePolicy::class,'view']);
        Gate::define('add_RoomType',[RoomTypePolicy::class,'create']);
        Gate::define('edit_RoomType',[RoomTypePolicy::class,'update']);
        Gate::define('delete_RoomType',[RoomTypePolicy::class,'delete']);

        Gate::define('list_slider',[SliderPolicy::class,'view']);
        Gate::define('add_slider',[SliderPolicy::class,'create']);
        Gate::define('edit_slider',[SliderPolicy::class,'update']);
        Gate::define('delete_slider',[SliderPolicy::class,'delete']);

        Gate::define('list_RoomImage',function ($user){
           return $user->checkPermissions('RoomImage_list');
        });
        Gate::define('list_RoomFacility',function ($user){
           return $user->checkPermissions('RoomFacility_list');
        });

    }
}
