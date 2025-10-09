<?php

namespace App\Http\Controllers;

use App\Models\Grave;

class DashboardController extends Controller
{
    public function heatmapData()
    {
        $data = Grave::whereNotNull('location')
            ->select('name', 'view_count', 'location')
            ->get()
            ->map(function ($grave) {
                return [
                    'name' => $grave->name,
                    'view_count' => $grave->view_count,
                    'coordinates' => [
                        'lat' => $grave->location->getLatitude(),
                        'lng' => $grave->location->getLongitude(),
                    ]];
            });
        return response()->json($data);
    }
}
