<?php

namespace App\Http\Controllers;

use App\Filters\PersonsFilter;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a paginated listing of the persons.
     */
    public function index(Request $request)
    {
        $filter = new PersonsFilter();
        $filterItems = $filter->transform($request);

        $perPage = $request->query('per_page') ?? 15;

        return PersonResource::collection(Person::where($filterItems)->paginate($perPage)->appends($request->query()));
    }

    /**
     * Store a newly created person in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grave_id' => 'nullable|exists:graves,id',
            'full_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'death_place' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'occupation' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        return response()->json(Person::create($validated), 201);
    }

    /**
     * Display the specified person.
     */
    public function show(Person $person)
    {
        return new PersonResource($person);
    }

    /**
     * Update the specified person.
     */
    public function update(Request $request, string $id)
    {
        $person = Person::findOrFail($id);

        $validated = $request->validate([
            'grave_id' => 'nullable|exists:graves,id',
            'full_name' => 'sometimes|required|string|max:255',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'death_place' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'occupation' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        $person->update($validated);

        return response()->json($person);
    }

    /**
     * Remove the specified person.
     */
    public function destroy(string $id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->noContent();
    }
}
