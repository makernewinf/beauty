<?php

class Pagamentos extends TRecord
{
    const TABLENAME  = 'pagamentos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $profissionais;
    private $clientes;
    private $tipo_pagamento;
    private $servicos;
    private $produtos;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('datalanc');
        parent::addAttribute('datapgto');
        parent::addAttribute('formapgto');
        parent::addAttribute('desconto');
        parent::addAttribute('valor');
        parent::addAttribute('profissionais_id');
        parent::addAttribute('clientes_id');
        parent::addAttribute('tipo_pagamento_id');
        parent::addAttribute('servicos_id');
        parent::addAttribute('produtos_id');
            
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
     * Method set_tipo_pagamento
     * Sample of usage: $var->tipo_pagamento = $object;
     * @param $object Instance of TipoPagamento
     */
    public function set_tipo_pagamento(TipoPagamento $object)
    {
        $this->tipo_pagamento = $object;
        $this->tipo_pagamento_id = $object->id;
    }

    /**
     * Method get_tipo_pagamento
     * Sample of usage: $var->tipo_pagamento->attribute;
     * @returns TipoPagamento instance
     */
    public function get_tipo_pagamento()
    {
    
        // loads the associated object
        if (empty($this->tipo_pagamento))
            $this->tipo_pagamento = new TipoPagamento($this->tipo_pagamento_id);
    
        // returns the associated object
        return $this->tipo_pagamento;
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
    /**
     * Method set_produtos
     * Sample of usage: $var->produtos = $object;
     * @param $object Instance of Produtos
     */
    public function set_produtos(Produtos $object)
    {
        $this->produtos = $object;
        $this->produtos_id = $object->id;
    }

    /**
     * Method get_produtos
     * Sample of usage: $var->produtos->attribute;
     * @returns Produtos instance
     */
    public function get_produtos()
    {
    
        // loads the associated object
        if (empty($this->produtos))
            $this->produtos = new Produtos($this->produtos_id);
    
        // returns the associated object
        return $this->produtos;
    }

    
}

