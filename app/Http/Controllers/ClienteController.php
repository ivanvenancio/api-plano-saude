<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Plano;
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
            return $this->retornoApi($this->baseValidator->errorsBag(),201);
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
            return $this->retornoApi('Cliente não encontrado',404);
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
            return $this->retornoApi('Cliente não encontrado',404);
        }
        // Valida os dados
        $validacao = $this->baseValidator->with($data)
            ->setId($id)
            ->withUpdateRules()
            ->passes('update');


        if(!$validacao){
            return $this->retornoApi($this->baseValidator->errorsBag(),201);
        }

        $cliente->update($data);

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
            return $this->retornoApi('Cliente não encontrado',404);
        }

        if($this->validaExclusao($cliente)){

            $cliente->planos()->detach();
            $cliente->delete();
            return $this->retornoApi('Cliente removido com sucesso',200);
        }else{
            return $this->retornoApi('Cliente do São Paulo do Plano Free não podem ser deletados',201);
        }

    }

    private function validaExclusao($cliente)
    {
        $validacao = 0;

        //Valida Plano
        $teste1 = $cliente->belongsToMany(Plano::class)
        ->wherePivot('plano_id', 1)
        ->get();

        if($teste1->count()) $validacao++;

        //Valida Estado
        $teste2 = $cliente->estado == 'São Paulo' ? 1 : 0;

        if($teste2) $validacao++;

        if($validacao == 2){
            return false;
        }

        return true;
    }

    public function contrataPlano(Request $request)
    {
        $cliente = Cliente::find($request->cliente);
        $plano = Plano::find($request->plano);
        if(!$plano) {
            return $this->retornoApi('Plano nao encontrado',404);
        }

        if(!$cliente) {
            return $this->retornoApi('Cliente nao encontrado',404);
        }

        //Contrata plano
        $contratado = $cliente->planos()->syncWithoutDetaching([$plano->id]);

        if($contratado['attached']){
            return $this->retornoApi('Plano contratado com sucesso',200);
        }else{
            return $this->retornoApi('Cliente já tem plano contratado',200);
        }

    }

    private function retornoApi($msg,$cod)
    {
        return response()->json(
            ['data' => [
                'msg' => $msg
                ]
            ], $cod);
    }
}
