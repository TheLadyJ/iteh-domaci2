<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReceptCollection;
use App\Models\Recept;
use Illuminate\Http\Request;

class UserReceptController extends Controller
{
    public function index($user_id)
    {
        $recepti = Recept::get()->where('user_id', $user_id);
        if(is_null($recepti))
            return response()->json('Data not found', 404);
            
        return response()->json(new ReceptCollection($recepti));
    }
}
