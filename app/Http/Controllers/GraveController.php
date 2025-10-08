<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGraveRequest;
use App\Http\Requests\UpdateGraveBoundaryRequest;
use App\Http\Requests\UpdateGraveRequest;
use App\Http\Resources\GraveResource;
use App\Models\Cemetery;
use App\Models\Grave;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GraveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $includePersons = $request->query('includePersons', false);
        $perPage = $request->query('per_page', 10);

        $query = Grave::query();
        $this->applySearch($query, $request->search);

        if ($includePersons) {
            $query->with('persons');
        }

        $graves = $query->paginate($perPage);

        return Inertia::render('Graves/index', [
            'graves' => GraveResource::collection($graves),
            'search' => $request->get('search', ''),
            'page' => $request->get('page', 1),
        ]);
    }

    protected function applySearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cemetery = Cemetery::findOrFail($request->get('cemeteryId'));

        return Inertia::render('Graves/Create', [
            'cemetery' => $cemetery,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGraveRequest $request)
    {
        Grave::create($request->validated());
        return redirect()->route('graves.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grave $grave)
    {
        return new GraveResource($grave);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grave $grave)
    {
        return inertia('Graves/Edit', [
            'grave' => GraveResource::make($grave),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editBoundary(Grave $grave)
    {
        return inertia('Graves/EditBoundary', [
            'grave' => $grave,
        ]);
    }

    public function updateBoundary(UpdateGraveBoundaryRequest $request, Grave $grave)
    {
        $grave->update($request->validated());
        return redirect()->route('graves.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGraveRequest $request, Grave $grave)
    {
        $grave->update($request->validated());
        return redirect()->route('graves.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grave $grave)
    {
        $grave->delete();
        return redirect()->route('graves.index');
    }
}
