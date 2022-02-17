<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cathegory;
use Illuminate\Support\Str;

class CathegoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cathegories = Cathegory::all();

        return view("admin.cathegories.index", compact("cathegories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cathegories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:150"
        ]);

        //prendo i miei dati
        $data = $request->all();

        //creo un nuovo post
        $newCathegory = new Cathegory();
        $newCathegory->name = $data['name'];
        
        $slug = Str::of($newCathegory->name)->slug("-");
        $count = 1;

        while ( Cathegory::where("slug", $slug)->first() ) {
            $slug = Str::of($newCathegory->name)->slug("-") . "-{$count}";
            $count++;
        }

        $newCathegory->slug = $slug;

        $newCathegory->save();

        return redirect()->route("cathegories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cathegory $cathegory)
    {
        return view("admin.cathegories.show", compact("cathegory"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cathegory $cathegory)
    {
        return view("admin.cathegories.edit", compact("cathegory"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cathegory $cathegory)
    {
        //Parte di validazione dati
        $request->validate([
            "name" => "required|string|max:150"
        ]);

        //prendo i miei dati
        $data = $request->all();

        //aggiorno post
        if ( $cathegory->name != $data['name'] ) {
            $cathegory->name = $data['name'];

            $slug = Str::of($cathegory->name)->slug("-");

            if ( $slug != $cathegory->slug ) {
                $count = 1;

                while ( Cathegory::where("slug", $slug)->first() ) {
                    $slug = Str::of($cathegory->name)->slug("-") . "-{$count}";
                    $count++;
                }

                $cathegory->slug = $slug;
            }
        } 

        $cathegory->save();

        return redirect()->route("cathegories.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cathegory $cathegory)
    {
        $cathegory->delete();

        return redirect()->route("cathegories.index");
    }
}
