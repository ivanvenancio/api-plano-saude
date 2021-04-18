<?php
namespace App\Validators;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;

abstract class AbstractValidator
{
       /**
     * @var int
     */
    protected $id = null;

    /**
     * Validator
     *
     * @var object
     */
    protected $validator;

    /**
     * Data to be validated
     *
     * @var array
     */
    protected $data = array();

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = array();

    /**
     * Validation Custom Messages
     *
     * @var array
     */
    protected $messages = array();

    /**
     * Validation Custom Attributes
     *
     * @var array
     */
    protected $attributes = array();



    protected $defaultRuleKey = 'default';


    protected $currentAction = null;

    public function __construct(ValidationFactory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Set Id
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set data to validate
     *
     * @param array $data
     * @return $this
     */
    public function with(array $data)
    {
        $this->data = $data;

        return $this;
    }


    /**
     * Set Rules for Validation
     *
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * Get Custom error messages for validation
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set Custom error messages for Validation
     *
     * @param array $messages
     * @return $this
     */
    public function setMessages(array $messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * Get Custom error attributes for validation
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set Custom error attributes for Validation
     *
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    protected function beforeValidator($action = null){}

    protected function afterValidator($action = null){}

    public function passes($action = null)
    {
        $this->currentAction = $action;


        $this->beforeValidator($action);


        $rules      = $this->getRules($action);
        $messages   = $this->getMessages();
        $attributes = $this->getAttributes();
        $validator  = $this->validator->make($this->data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }


        $this->afterValidator($action);


        return true;
    }


    /**
     * Get rule for validation by action ValidatorInterface::RULE_CREATE or ValidatorInterface::RULE_UPDATE
     *
     * Default rule: ValidatorInterface::RULE_CREATE
     *
     * @param null $action
     * @return array
     */
    public function getRules($action = null)
    {
        $rules = $this->rules;


        // Extrai a validaçao padrão
        if (isset($this->rules[$this->defaultRuleKey])) {
            $rules = $this->rules[$this->defaultRuleKey];
        }

        // Faz o merge da validação padrao com a default
        if (isset($this->rules[$action])) {
            $rules = array_merge($rules, $this->rules[$action]);;
        }

        return $rules;
    }

    /**
     * Add or Overwrite Rule for Validation Group
     *
     * @param array $rules
     * @param string|boolean $ruleGroup
     * @param boolean $overwriteRules
     * @return $this
     */
    public function addRuleToGroup(array $rules, $ruleGroup = false, $overwriteRules = true)
    {
        $currentRule = $ruleGroup ? $ruleGroup : $this->defaultRuleKey;

        if(isset($this->rules[$currentRule]) && $overwriteRules){
            $this->rules[$currentRule] = array_merge($this->rules[$currentRule],  $rules );
        } else {
            $this->rules[$currentRule] = $rules;
        }

        return $this;
    }



    /**
     * Pass the data and the rules to the validator
     *
     * @param string $action
     * @return bool
     */
    public function passesOrFail($action = null)
    {
        $this->beforeValidator($action);

        $rules      = $this->getRules($action);
        $messages   = $this->getMessages();
        $attributes = $this->getAttributes();
        $validator  = $this->validator->make($this->data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            throw (new ValidationException($validator));
        }

        $this->afterValidator($action);

        return true;
    }

    /**
     * Return errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->errorsBag()->all();
    }

    /**
     * Errors
     *
     * @return MessageBag
     */
    public function errorsBag()
    {
        return $this->errors;
    }

}
