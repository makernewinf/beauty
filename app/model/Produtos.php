<?php

class Produtos extends TRecord
{
    const TABLENAME  = 'produtos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $grupo_produtos;
    private $fornecedores;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao');
        parent::addAttribute('tipo');
        parent::addAttribute('custo');
        parent::addAttribute('preco');
        parent::addAttribute('estoque_min');
        parent::addAttribute('estoque_atual');
        parent::addAttribute('grupo_produtos_id');
        parent::addAttribute('fornecedores_id');
        parent::addAttribute('foto');
        parent::addAttribute('nome_foto');
            
    }

    /**
     * Method set_grupo_produtos
     * Sample of usage: $var->grupo_produtos = $object;
     * @param $object Instance of GrupoProdutos
     */
    public function set_grupo_produtos(GrupoProdutos $object)
    {
        $this->grupo_produtos = $object;
        $this->grupo_produtos_id = $object->id;
    }

    /**
     * Method get_grupo_produtos
     * Sample of usage: $var->grupo_produtos->attribute;
     * @returns GrupoProdutos instance
     */
    public function get_grupo_produtos()
    {
    
        // loads the associated object
        if (empty($this->grupo_produtos))
            $this->grupo_produtos = new GrupoProdutos($this->grupo_produtos_id);
    
        // returns the associated object
        return $this->grupo_produtos;
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
     * Method getPagamentoss
     */
    public function getPagamentoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('produtos_id', '=', $this->id));
        return Pagamentos::getObjects( $criteria );
    }

    public function set_pagamentos_profissionais_to_string($pagamentos_profissionais_to_string)
    {
        if(is_array($pagamentos_profissionais_to_string))
        {
            $values = Profissionais::where('id', 'in', $pagamentos_profissionais_to_string)->getIndexedArray('id', 'id');
            $this->pagamentos_profissionais_to_string = implode(', ', $values);
        }
        else
        {
            $this->pagamentos_profissionais_to_string = $pagamentos_profissionais_to_string;
        }

        $this->vdata['pagamentos_profissionais_to_string'] = $this->pagamentos_profissionais_to_string;
    }

    public function get_pagamentos_profissionais_to_string()
    {
        if(!empty($this->pagamentos_profissionais_to_string))
        {
            return $this->pagamentos_profissionais_to_string;
        }
    
        $values = Pagamentos::where('produtos_id', '=', $this->id)->getIndexedArray('profissionais_id','{profissionais->id}');
        return implode(', ', $values);
    }

    public function set_pagamentos_clientes_to_string($pagamentos_clientes_to_string)
    {
        if(is_array($pagamentos_clientes_to_string))
        {
            $values = Clientes::where('id', 'in', $pagamentos_clientes_to_string)->getIndexedArray('sexo', 'sexo');
            $this->pagamentos_clientes_to_string = implode(', ', $values);
        }
        else
        {
            $this->pagamentos_clientes_to_string = $pagamentos_clientes_to_string;
        }

        $this->vdata['pagamentos_clientes_to_string'] = $this->pagamentos_clientes_to_string;
    }

    public function get_pagamentos_clientes_to_string()
    {
        if(!empty($this->pagamentos_clientes_to_string))
        {
            return $this->pagamentos_clientes_to_string;
        }
    
        $values = Pagamentos::where('produtos_id', '=', $this->id)->getIndexedArray('clientes_id','{clientes->sexo}');
        return implode(', ', $values);
    }

    public function set_pagamentos_tipo_pagamento_to_string($pagamentos_tipo_pagamento_to_string)
    {
        if(is_array($pagamentos_tipo_pagamento_to_string))
        {
            $values = TipoPagamento::where('id', 'in', $pagamentos_tipo_pagamento_to_string)->getIndexedArray('nome', 'nome');
            $this->pagamentos_tipo_pagamento_to_string = implode(', ', $values);
        }
        else
        {
            $this->pagamentos_tipo_pagamento_to_string = $pagamentos_tipo_pagamento_to_string;
        }

        $this->vdata['pagamentos_tipo_pagamento_to_string'] = $this->pagamentos_tipo_pagamento_to_string;
    }

    public function get_pagamentos_tipo_pagamento_to_string()
    {
        if(!empty($this->pagamentos_tipo_pagamento_to_string))
        {
            return $this->pagamentos_tipo_pagamento_to_string;
        }
    
        $values = Pagamentos::where('produtos_id', '=', $this->id)->getIndexedArray('tipo_pagamento_id','{tipo_pagamento->nome}');
        return implode(', ', $values);
    }

    public function set_pagamentos_servicos_to_string($pagamentos_servicos_to_string)
    {
        if(is_array($pagamentos_servicos_to_string))
        {
            $values = Servicos::where('id', 'in', $pagamentos_servicos_to_string)->getIndexedArray('nome', 'nome');
            $this->pagamentos_servicos_to_string = implode(', ', $values);
        }
        else
        {
            $this->pagamentos_servicos_to_string = $pagamentos_servicos_to_string;
        }

        $this->vdata['pagamentos_servicos_to_string'] = $this->pagamentos_servicos_to_string;
    }

    public function get_pagamentos_servicos_to_string()
    {
        if(!empty($this->pagamentos_servicos_to_string))
        {
            return $this->pagamentos_servicos_to_string;
        }
    
        $values = Pagamentos::where('produtos_id', '=', $this->id)->getIndexedArray('servicos_id','{servicos->nome}');
        return implode(', ', $values);
    }

    public function set_pagamentos_produtos_to_string($pagamentos_produtos_to_string)
    {
        if(is_array($pagamentos_produtos_to_string))
        {
            $values = Produtos::where('id', 'in', $pagamentos_produtos_to_string)->getIndexedArray('id', 'id');
            $this->pagamentos_produtos_to_string = implode(', ', $values);
        }
        else
        {
            $this->pagamentos_produtos_to_string = $pagamentos_produtos_to_string;
        }

        $this->vdata['pagamentos_produtos_to_string'] = $this->pagamentos_produtos_to_string;
    }

    public function get_pagamentos_produtos_to_string()
    {
        if(!empty($this->pagamentos_produtos_to_string))
        {
            return $this->pagamentos_produtos_to_string;
        }
    
        $values = Pagamentos::where('produtos_id', '=', $this->id)->getIndexedArray('produtos_id','{produtos->id}');
        return implode(', ', $values);
    }

    
}

