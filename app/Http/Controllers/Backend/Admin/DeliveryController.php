<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeliveryController extends Controller
{
    //
    public function index()
    {
        $deliveries = Delivery::all();
        return view('backend.Admin_Dashboard.delivery.index', compact('deliveries'));

    }

    public function create()
    {
        $roles = Role::all();
        $categories = Category::all();
        return view('backend.Admin_Dashboard.delivery.create', compact('categories', 'roles'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        // dd($data);
        $delivery = Delivery::create($data);

        if($request->roles) {
            $delivery->roles()->attach($request->roles);
        }

        return redirect()->route('admin.deliveries.index');

    }

    public function edit($id)
    {
        $roles = Role::all();
        $delivery = Delivery::findOrFail($id);


        $delivery_roles = $delivery->roles()->pluck('id')->toArray();


        $categories = Category::all();
        return view('backend.Admin_Dashboard.delivery.edit', compact('delivery', 'categories','roles','delivery_roles'));

    }
    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $data = $request->all();

        // Check if the 'roles' key exists in the request
        if (isset($data['roles'])) {
            // If 'roles' is not empty, sync the roles
            $delivery->roles()->sync($data['roles']);
        } else {
            // If 'roles' is not provided in the request, remove all roles
            $delivery->roles()->detach();
        }
        $data['password'] = $request->password ? Hash::make($request->password) : $delivery->password ;
        $delivery->update($data);
        return redirect()->route('admin.deliveries.index');
    }
}
