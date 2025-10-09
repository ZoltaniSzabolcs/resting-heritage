<?php

namespace App\Http\Controllers;

use App\Filters\PersonsFilter;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Grave;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PersonController extends Controller
{
    /**
     * Display a paginated listing of the persons.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page');
        $perPage = $perPage ?? 10;

        $personsQuery = Person::query();
        $this->applySearch($personsQuery, $request->search);

        return Inertia::render('Persons/index', [
            'persons' => PersonResource::collection(
                $personsQuery->paginate($perPage)),
            'search' => $request->search ?? '',
        ]);
    }

    protected function applySearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'ilike', "%{$search}%")
                    ->orWhere('last_name', 'ilike', "%{$search}%")
                    ->orWhereRaw("concat(first_name, ' ', last_name) ilike ?", ["%{$search}%"])
                    ->orWhereRaw("concat(last_name, ' ', first_name) ilike ?", ["%{$search}%"])
                    ->orWhereRaw("initials ilike ?", ["%{$search}%"]);
            });
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $grave = Grave::findOrFail($request->get('graveId'));

        return Inertia::render('Persons/Create', [
            'grave' => $grave,
        ]);
    }

    /**
     * Store a newly created person in storage.
     */
    public function store(StorePersonRequest $request)
    {
        Person::create($request->validated());
        return redirect()->route('persons.index');
    }

    /**
     * Display the specified person.
     */
    public function show(Person $person)
    {
        $grave = Grave::find($person->grave_id);

        if ($grave) {
            $grave->increment('view_count');
            $grave->last_viewed_at = now();
            $grave->save();
        }

        return Inertia::render('Persons/Show', [
            'person' => PersonResource::make($person)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        return inertia('Persons/Edit', [
            'person' => PersonResource::make($person),
        ]);
    }

    /**
     * Update the specified person.
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());
        return redirect()->route('persons.index');
    }

    /**
     * Remove the specified person.
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('persons.index');
    }
}
