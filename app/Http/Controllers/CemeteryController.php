<?php

namespace App\Http\Controllers;

use App\Filters\CemeteryFilter;
use App\Http\Requests\StoreCemeteryRequest;
use App\Http\Requests\UpdateCemeteryRequest;
use App\Http\Resources\CemeteryResource;
use App\Http\Resources\PersonResource;
use App\Models\Cemetery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CemeteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page');
        $perPage = $perPage ?? 10;

        $cemeteriesQuery = Cemetery::query();
        $this->applySearch($cemeteriesQuery, $request->search);

        return Inertia::render('Cemeteries/index', [
            'cemeteries' => CemeteryResource::collection(
                $cemeteriesQuery->paginate($perPage)),
            'search' => $request->search ?? '',
        ]);
    }

    protected function applySearch($query, $search) {
        return $query->when($search, function($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Cemeteries/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCemeteryRequest $request)
    {
        Cemetery::create($request->validated());

        return redirect()->route('cemeteries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cemetery $cemetery)
    {
        return new PersonResource($cemetery);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cemetery $cemetery)
    {
        return inertia('Cemeteries/Edit', [
            'cemetery' => CemeteryResource::make($cemetery),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCemeteryRequest $request, Cemetery $cemetery)
    {
        $cemetery->update($request->validated());
        return redirect()->route('cemeteries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cemetery $cemetery)
    {
        $cemetery->delete();

        return redirect()->route('cemeteries.index');
    }
}
