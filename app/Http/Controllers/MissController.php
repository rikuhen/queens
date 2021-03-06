<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\RepositoryInterface\MissRepositoryInterface;
use  App\RepositoryInterface\CityRepositoryInterface;

class MissController extends Controller
{
    
    private $miss;
    private $city;
    
    public function __construct(MissRepositoryInterface $miss,CityRepositoryInterface $city)
    {
        $this->miss = $miss;
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $misses = $this->miss->enum();
        return view('admin.misses.index',compact('misses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->city->getActives();
        return view('admin.misses.create-edit',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $miss = $this->miss->save($request->all());
        $sessionData['tipo_mensaje'] = 'success';
        $sessionData['mensaje'] = "Se ha guardado Satisfactoriamente la candidata";

        if ($miss) {
            return redirect('/admin/misses/'.$miss->id.'/edit')->with($sessionData);
        }

        $sessionData['tipo_mensaje'] = 'error';
        $sessionData['mensaje'] = "No se ha podido guardar la candidata";
        return back()->with($sessionData);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $miss = $this->miss->find($id);
        $cities = $this->city->getActives();
        return view('admin.misses.create-edit',compact('miss','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $miss = $this->miss->edit($id, $request->all());

        $sessionData['tipo_mensaje'] = 'success';
        $sessionData['mensaje'] = "Se ha actualizado Satisfactoriamente la candidata";

        if ($miss) {
            return redirect('/admin/misses/'.$miss->id.'/edit')->with($sessionData);
        }

        $sessionData['tipo_mensaje'] = 'error';
        $sessionData['mensaje'] = "No se ha podido actualizar la candidata";

        return back()->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $removed = $this->miss->remove($id);
        if ($removed) {
            $sessionData['tipo_mensaje'] = 'success';
            $sessionData['mensaje'] = "Se ha eliminado satisfactoriamente la candidata";
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = "No se ha podido eliminar la candidata";
        }

        return back()->with($sessionData);
    }
}
