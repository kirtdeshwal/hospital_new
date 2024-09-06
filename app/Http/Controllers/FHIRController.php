<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FHIRService;

class FHIRController extends Controller
{

    public function generateFHIR() {
        FHIRService::renderFHIRDefinition();
        return response()->json([
            'message' => 'FHIR code rendered successfully'
        ]);
    }
}
