<?php

namespace App\Http\Controllers;

use App\comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return comentarios::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comentarios = comentarios::create($request->all());
        return $comentarios;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $comentario = comentarios::where('id', $id)->first();
        return $comentario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function edit(comentarios $comentarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $affected = DB::table('comentarios')
              ->where('id', $id)
              ->update(['comentario' => $request->nombre, 'post_id' => $request->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        DB::table('comentarios')->where('id', '=', $id)->delete();
    }
}
