<?php

namespace App\Http\Controllers;

use App\Models\Families;
use App\Models\Parents;
use App\Models\Children;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function showRelations(Request $request, $name)
    {
        $perPage = $request->query('per_page', 10);
        $families = Families::where('name', $name)->first();

        if (!$families) {
            return response()->json(['message' => 'Family not found'], 404);
        }

        $relations = collect();

        $relations = $relations->merge($families->parents);
        $relations = $relations->merge($families->children);

        $sortedRelations = $relations->sortBy('name')->values();

        $paginated = $sortedRelations->forPage($request->query('page', 1), $perPage);

        return response()->json([
            'data' => $paginated,
            'total' => $sortedRelations->count(),
            'per_page' => $perPage,
            'current_page' => (int) $request->query('page', 1),
            'last_page' => ceil($sortedRelations->count() / $perPage)
        ]);
    }

}