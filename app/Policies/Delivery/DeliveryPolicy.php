<?php

namespace App\Policies\Delivery;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Delivery $delivery)
    {
        //

        return $delivery->hasAbility('delivery.viewAll');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Delivery $delivery)
    {
        //
        return $delivery->hasAbility('delivery.view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Delivery $delivery)
    {
        //
    }

    public function deliveryUser(Delivery $delivery)
    {
        return $delivery->hasAbility('delivery.deliveryUser');
    }

    public function assignDelivery(Delivery $delivery)
    {
        return $delivery->hasAbility('delivery.assign');
    }
}
