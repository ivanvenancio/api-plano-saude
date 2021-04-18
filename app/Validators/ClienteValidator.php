<?php
namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\Rule;

class ClienteValidator extends AbstractValidator
{

    protected $rules = [
        'create' => [
            'nome' => 'required|string',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|digits_between:10,11',
            'estado' => 'required|string',
            'cidade' => 'required|string',

        ],
        'update' => [
            'nome' => 'sometimes|required|string',
            'data_nascimento' => 'sometimes|required|date',
            'telefone' => 'sometimes|required|digits_between:10,11',
            'estado' => 'sometimes|required|string',
            'cidade' => 'sometimes|required|string',

        ]
    ];

    protected $messages = [

    ];

    public $id;

    public function __construct(Factory $validator)
    {
        parent::__construct($validator);
    }

    protected function beforeValidator($action = null){

    }

    public function withUpdateRules()
    {

        $this->addRuleToGroup([
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('clientes', 'email')->ignore($this->id)
            ]
        ]);

        return $this;
    }

    public function withCreateRules()
    {
        $this->addRuleToGroup([
            'email' => [
                'required',
                'email',
                Rule::unique('clientes', 'email')
            ]
        ]);
        return $this;
    }
}
