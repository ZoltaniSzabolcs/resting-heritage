<?php

namespace App\Http\Controllers;

use App\Http\Resources\GraveResource;
use App\Models\Grave;
use Illuminate\Http\Request;

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

        if ($includePersons) {
            $query->with('persons');
        }

        $graves = $query->paginate($perPage);

        return GraveResource::collection($graves);
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
    public function store(Request $request)
    {
        return Grave::create($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grave $grave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grave $grave)
    {
        //
    }
}
