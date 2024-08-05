<?php

namespace App\Http\Controllers;

use App\Models\Families;
use App\Models\Parents;
use App\Models\Children;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function bulkStore(Request $request)
    {
        $data = $request->validate([
            'families' => 'required|array',
            'families.*.name' => 'required|string',
            'families.*.parents' => 'sometimes|array',
            'families.*.parents.*.name' => 'required_with:families.*.parents|string',
            'families.*.children' => 'sometimes|array',
            'families.*.children.*.name' => 'required_with:families.*.children|string',
        ]);

        $createdFamilies = [];

        foreach ($data['families'] as $orgData) {
            $families = Families::create([
                'name' =>$orgData['name']
            ]);

            if (isset($orgData['parents'])) {
                foreach ($orgData['parents'] as $parentsData) {
                    $families->parents()->create($parentsData);
                }
            }

            if (isset($orgData['children'])) {
                foreach ($orgData['children'] as $childrenData) {
                    $families->children()->create($childrenData);
                }
            }

            $createdFamilies[] = $families;
        }

        return response()->json(['status' => 'success', 'families' => $createdFamilies], 201);
    }
}
