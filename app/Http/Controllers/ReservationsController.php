<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationsRequest;
use App\Http\Requests\UpdateReservationsRequest;
use App\Models\Customer;
use App\Models\Reservations;
use Illuminate\Database\Eloquent\Collection;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        $reservations = Reservations::with('customer')->get();
        return $reservations;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationsRequest $request)
    {
        $customer = Customer::where('name', strtolower($request->get('name')))->where('last_names', strtolower($request->get('last_names')))->first();

        if (is_null($customer)) {
            $customer = new Customer();
            $customer->name = strtolower($request->get('name'));
            $customer->last_names = strtolower($request->get('last_names'));

            $customer->save();

            $reservation = new Reservations();
            $reservation->customer_id = $customer->id;
            $reservation->id_place = $request->get('id_place');
            $reservation->fecha = $request->get('fecha');
            $reservation->hora = $request->get('hora');
            $reservation->save();

        } else {

            $reservation = Reservations::where('customer_id', $customer->id)
                ->where('id_place', $request->get('id_place'))
                ->where('fecha', $request->get('fecha'))
                ->where('hora', $request->get('hora'))->count();


            if ($reservation > 0) {
                return response()->json(['status' => false, 'message' => 'You already have a reservation with these parameters']);
            }

            $reservation = new Reservations();
            $reservation->customer_id = $customer->id;
            $reservation->id_place = $request->get('id_place');
            $reservation->fecha = $request->get('fecha');
            $reservation->hora = $request->get('hora');
            $reservation->save();
        }

        return response()->json(['status' => true, 'message' => 'Reservation added.']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Reservations $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservations $reservations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationsRequest $request, Reservations $reservations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservations $reservations)
    {
        //
    }
}
