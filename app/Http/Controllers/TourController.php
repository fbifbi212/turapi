<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // burdaki içerik start_date tur başlama tarihi ise alttaki where ona göre değiştirmemiz gerekecektir
        // ama bu  tura katılım tarihleri arası ise end_date olarak kalmalı.
        if ($user->isAdmin()) {
            $toursQuery = Tour::query();
            if ($startDate && $endDate) {
                $toursQuery->where('end_date', '>=', $startDate)
                    ->where('end_date', '<=', $endDate)
                    ->get();
            }
            $tours = $toursQuery->get();
        } else {
            $toursQuery = Tour::where('user_id', $user->id);
            if ($startDate && $endDate) {
                $toursQuery->where('end_date', '>=', $startDate)
                    ->where('end_date', '<=', $endDate)
                    ->get();
            }
            $tours = $toursQuery->get();
        }

        return response()->json(['tours' => $tours]);
    }
    public function indexAll(Request $request)
    {

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');


        $toursQuery = Tour::query();
        if ($startDate && $endDate) {
            $toursQuery->where('end_date', '>=', $startDate)
                ->where('end_date', '<=', $endDate)
                ->get();
        }
        $tours = $toursQuery->get();


        return response()->json(['tours' => $tours]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric',
        ]);

        $tour = $user->tours()->create($validatedData);

        return response()->json(['tour' => $tour], 201);
    }

    public function show(Tour $tour)
    {
        return response()->json(['tour' => $tour]);
    }

    public function update(Request $request, Tour $tour)
    {


        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'location' => 'string',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'price' => 'numeric',
        ]);
        $tour->update($validatedData);
        return response()->json(['tour' => $tour], 200);
    }

    public function destroy(Tour $tour)
    {

        $tour->delete();
        return response()->json(null, 204);
    }
}
