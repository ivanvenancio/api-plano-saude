<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Validators\ClienteValidator;

class ClienteController extends Controller
{
    protected $baseValidator;

    public function __construct(ClienteValidator $baseValidator)
    {
       $this->baseValidator = $baseValidator;
    }
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
        // Valida os dados
        $validacao = $this->baseValidator->with($data)
            ->withCreateRules()
            ->passes('create');

        if(!$validacao){
            return response()->json(
                ['data' => [
                    'msg' => $this->baseValidator->errorsBag()
                    ]
                ], 201);


        }

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
        // Valida os dados
        $validacao = $this->baseValidator->with($data)
            ->setId($id)
            ->withUpdateRules()
            ->passes('update');


        if(!$validacao){
            return response()->json(
                ['data' => [
                    'msg' => $this->baseValidator->errorsBag()
                    ]
                ], 201);


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
