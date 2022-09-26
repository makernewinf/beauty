<?php

class Contas extends TRecord
{
    const TABLENAME  = 'contas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $fornecedores;
    private $grupo_contas;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('documento');
        parent::addAttribute('fornecedores_id');
        parent::addAttribute('valor');
        parent::addAttribute('grupo_contas_id');
            
    }

    /**
     * Method set_fornecedores
     * Sample of usage: $var->fornecedores = $object;
     * @param $object Instance of Fornecedores
     */
    public function set_fornecedores(Fornecedores $object)
    {
        $this->fornecedores = $object;
        $this->fornecedores_id = $object->id;
    }

    /**
     * Method get_fornecedores
     * Sample of usage: $var->fornecedores->attribute;
     * @returns Fornecedores instance
     */
    public function get_fornecedores()
    {
    
        // loads the associated object
        if (empty($this->fornecedores))
            $this->fornecedores = new Fornecedores($this->fornecedores_id);
    
        // returns the associated object
        return $this->fornecedores;
    }
    /**
     * Method set_grupo_contas
     * Sample of usage: $var->grupo_contas = $object;
     * @param $object Instance of GrupoContas
     */
    public function set_grupo_contas(GrupoContas $object)
    {
        $this->grupo_contas = $object;
        $this->grupo_contas_id = $object->id;
    }

    /**
     * Method get_grupo_contas
     * Sample of usage: $var->grupo_contas->attribute;
     * @returns GrupoContas instance
     */
    public function get_grupo_contas()
    {
    
        // loads the associated object
        if (empty($this->grupo_contas))
            $this->grupo_contas = new GrupoContas($this->grupo_contas_id);
    
        // returns the associated object
        return $this->grupo_contas;
    }

    
}

