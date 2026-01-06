<?php

namespace App\Http\Controllers;
use App\Models\sponsor;
use App\Models\Evenement;

use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $evenementid = Evenement::all() ;
        return view('organisateur.sponsor',compact('evenementid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validetedData = $request ->validate([

            'nom'=>'nullable',
            'logo'=>'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:100048',
            'lien_web'=>'nullable|string|url',
            'evenement_id'=>'nullable',

        ],[
            'logo.mime'=>'fichier n\'est png ou jpg',
            'lien_web'=>'lien invalid'
        ]);
        $sponsors = new Sponsor();
        $sponsors->nom = $request->nom ?? '';
        if($request->hasFile('logo')){
            $photopath = $request->file('logo')->store('evenement/sponsors','public');
            $sponsors->logo = $photopath;
        }else {
            $sponsors->logo = '';
        }
        if ($request->filled('lien_web')) {
            $sponsors->lien_web = $validetedData['lien_web'];
        }else {
            $sponsors->lien_web = '';
        }
        $sponsors->evenement_id = $validetedData['evenement_id'];
        $sponsors->save();
        return redirect()->route('organisateur.sponsor-form')->with('success','sponsor inserer avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sponsors = sponsor::findOrFail($id);
        return view('organisateur.mosifier_spnsor',compact($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validete([
            'nom'=>'nullable',
            'logo'=>'nullable',
            'lien_web'=>'nullable',
            'evenement_id'=> 'nullable'
        ]);
        $sponsors = findOrFail($id);
        $sponsors->nom = $request->nom ?? '';
        $sponsors->logo = $request->logo ?? '';
        $sponsors->lien_web = $request->lien_web ?? '';
        $sponsors->evenement_id = $request->evenement_id ?? '';
        return  redirect()->route('organisateur.modifier_billet');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dsponsors = sponsor::FindOrFail($id);
        $dsponsors->destroy();
        return redirect()->back()->with('suprimer','suprimer avec success de cet evenement ');
    }
}
