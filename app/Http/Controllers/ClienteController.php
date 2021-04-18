<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::all();
        return response()->json($cliente);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $cliente = Cliente::create($data);

        return response()->json(
            ['data' => [
                'msg' => 'Cliente criado com sucesso',
                'cliente' => $cliente
                ]
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $cliente = Cliente::find($id);

        if(!$cliente){
            return response()->json(
                ['data' => [
                    'error' => 'Cliente não encontrado'
                    ]
                ]
                , 404);
        }

        // return new ClienteResource($cliente);
        return $cliente;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $cliente = Cliente::find($id);
        $data = $request->all();

        if(!$cliente){
            return response()->json(
                ['data' => [
                    'error' => 'Cliente não encontrado'
                    ]
                ]
                , 404);
        }

        $cliente->update($data);
        // return new ClienteResource($cliente);
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json(
                ['data' => [
                    'error' => 'Cliente não encontrado'
                    ]
                ]
                , 404);
        }
        $cliente->planos()->detach();
        $cliente->delete();
        return response()->json(
            ['data' => [
                'msg' => 'Cliente removido com sucesso'
                ]
            ], 200);
    }
}
