<?php

class Agenda extends TRecord
{
    const TABLENAME  = 'agenda';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $clientes;
    private $profissionais;
    private $servicos;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dataag');
        parent::addAttribute('horaag');
        parent::addAttribute('cor');
        parent::addAttribute('clientes_id');
        parent::addAttribute('profissionais_id');
        parent::addAttribute('servicos_id');
        parent::addAttribute('horario_inicial');
        parent::addAttribute('horario_final');
            
    }

    /**
     * Method set_clientes
     * Sample of usage: $var->clientes = $object;
     * @param $object Instance of Clientes
     */
    public function set_clientes(Clientes $object)
    {
        $this->clientes = $object;
        $this->clientes_id = $object->id;
    }

    /**
     * Method get_clientes
     * Sample of usage: $var->clientes->attribute;
     * @returns Clientes instance
     */
    public function get_clientes()
    {
    
        // loads the associated object
        if (empty($this->clientes))
            $this->clientes = new Clientes($this->clientes_id);
    
        // returns the associated object
        return $this->clientes;
    }
    /**
     * Method set_profissionais
     * Sample of usage: $var->profissionais = $object;
     * @param $object Instance of Profissionais
     */
    public function set_profissionais(Profissionais $object)
    {
        $this->profissionais = $object;
        $this->profissionais_id = $object->id;
    }

    /**
     * Method get_profissionais
     * Sample of usage: $var->profissionais->attribute;
     * @returns Profissionais instance
     */
    public function get_profissionais()
    {
    
        // loads the associated object
        if (empty($this->profissionais))
            $this->profissionais = new Profissionais($this->profissionais_id);
    
        // returns the associated object
        return $this->profissionais;
    }
    /**
     * Method set_servicos
     * Sample of usage: $var->servicos = $object;
     * @param $object Instance of Servicos
     */
    public function set_servicos(Servicos $object)
    {
        $this->servicos = $object;
        $this->servicos_id = $object->id;
    }

    /**
     * Method get_servicos
     * Sample of usage: $var->servicos->attribute;
     * @returns Servicos instance
     */
    public function get_servicos()
    {
    
        // loads the associated object
        if (empty($this->servicos))
            $this->servicos = new Servicos($this->servicos_id);
    
        // returns the associated object
        return $this->servicos;
    }

    
}

