<?php

// controller to create new membership to a specific restaurant, when user fill in name, phone, email then create a new customer and a new membership

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\restaurant;

use function Laravel\Prompts\error;

// 

class MembershipController extends Controller
{

    public function create($restaurant_id)
    {
        // Validate that the restaurant_id is provided in the request
        // if validation fails, error_log to the console
        if (!$restaurant_id) {
            error_log('Validation failed: restaurant_id is required');
            return redirect()->route('memberships.create')->with('error', 'Restaurant ID is required.');
        }

        error_log('Restaurant ID: ' . $restaurant_id);
        // Fetch the specific restaurant by its ID
        $restaurant = Restaurant::findOrFail($restaurant_id);
        error_log('Restaurant: ' . json_encode($restaurant));

        // Render the Inertia.js component for creating a new membership
        return Inertia::render('memberships/signup', [
            'restaurant' => $restaurant, // Pass the restaurant details to the frontend
        ]);
    }



    public function store(Request $request, $restaurant_id)
    {

        error_log('Request data: ' . json_encode($request->all()));
        error_log('Restaurant ID: ' . $restaurant_id);
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);


        // Fetch the specific restaurant by its ID
        $restaurant = Restaurant::findOrFail($restaurant_id);
        error_log('Restaurant: ' . json_encode($restaurant));

        // Check if the customer already exists
        $existingCustomer = Customer::where('phone', $request->phone)
            ->orWhere('email', $request->email)
            ->first();
            
        error_log('Existing customer: ' . json_encode($existingCustomer));

        if ($existingCustomer) {
            // If the customer already exists, create a new membership for the existing customer
            Membership::create([
                'customer_id' => $existingCustomer->id,
                'restaurant_id' => $request->restaurant_id,
            ]);

            // Redirect back to the signup page with a success message
            return redirect()->route('/', ['restaurant_id' => $restaurant_id])
                ->with('success', 'Membership created successfully.');
        }
        // If the customer does not exist, create a new customer


        // Create a new customer
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        error_log('New customer created: ' . json_encode($customer));

        // Create a new membership for the customer
        Membership::create([
            'customer_id' => $customer->id,
            'restaurant_id' => $request->restaurant_id,
        ]);

        // Redirect back to the signup page with a success message
        // Redirect back to the signup page with a success message
        return redirect()->route('memberships.create', ['restaurant_id' => $restaurant_id])
            ->with('success', 'Membership created successfully.');
    }

    public function show($id)
    {
        return view('todos.show', compact('id'));
    }

    public function edit($id)
    {
        return view('todos.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return view('todos.update', compact('id'));
    }

    public function destroy($id)
    {
        return view('todos.destroy', compact('id'));
    }

    public function index()
    {
        // Render the Inertia.js component for listing memberships
        return Inertia::render('Memberships/Index', [
            'memberships' => Membership::with('customer', 'restaurant')->get(), // Fetch all memberships with related customer and restaurant data
        ]);
    }

    // show membership by restaurant
    public function showMembershipByRestaurant($restaurantId)
    {
        // Fetch memberships for the specified restaurant
        $memberships = Membership::with('customer')
            ->where('restaurant_id', $restaurantId)
            ->get();

        // Render the Inertia.js component for showing memberships by restaurant
        return Inertia::render('Memberships/ShowByRestaurant', [
            'memberships' => $memberships,
            'restaurant' => Restaurant::find($restaurantId), // Fetch the restaurant details
        ]);
    }
    // show membership by customer
    public function showMembershipByCustomer($customerId)
    {
        // Fetch memberships for the specified customer
        $memberships = Membership::with('restaurant')
            ->where('customer_id', $customerId)
            ->get();

        // Render the Inertia.js component for showing memberships by customer
        return Inertia::render('Memberships/ShowByCustomer', [
            'memberships' => $memberships,
            'customer' => Customer::find($customerId), // Fetch the customer details
        ]);
    }
}
