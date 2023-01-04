<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReceptCollection;
use App\Http\Resources\ReceptResource;
use App\Models\Kategorija;
use App\Models\Recept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReceptController extends Controller
{
  
    public function index()
    {
        $recepti = Recept::all();
        return new ReceptCollection($recepti);
    }

    public function store(Request $request)
    {
        $kategorija_ids = Kategorija::all()->pluck('id');

        $validator = Validator::make($request->all(),[
            'naziv_recepta'=>'required|string|max:100',
            'opis_recepta'=>'required|string',
            'kategorija_id'=>['required', Rule::in($kategorija_ids)]
        ]);

        if($validator->fails())
            return response()->json($validator->errors());
        
        $recept=Recept::create([
            'naziv_recepta'=>$request->naziv_recepta,
            'opis_recepta'=>$request->opis_recepta,
            'kategorija_id'=>$request->kategorija_id,
            'user_id'=>Auth::user()->id
        ]);
    
        return response()->json(['Recept je uspesno kreiran!', new ReceptResource($recept)]);
    }

    public function show($id)
    {
        $recept = Recept::find($id);
        return new ReceptResource($recept);
    }

    public function update(Request $request, $id)
    {
        $kategorija_ids = Kategorija::all()->pluck('id');
        $recept=Recept::find($id);

        if($recept->user_id!=Auth::user()->id)
            return response()->json('Korisnik nema prava da menja recept koji nije njegov');

        $validator = Validator::make($request->all(),[
            'naziv_recepta'=>'required|string|max:100',
            'opis_recepta'=>'required|string',
            'kategorija_id'=>['required', Rule::in($kategorija_ids)]
        ]);

        if($validator->fails())
            return response()->json($validator->errors());
        
        
        $recept->naziv_recepta=$request->naziv_recepta;
        $recept->opis_recepta=$request->opis_recepta;
        $recept->kategorija_id=$request->kategorija_id;

        $recept->save();

        return response()->json(['Recept je uspesno azuriran!', new ReceptResource($recept)]);
    }

    public function destroy($id)
    {
        $recept=Recept::find($id);
        $recept->delete();
        return response()->json('Recept je uspesno izbrisan!');
    }
}
