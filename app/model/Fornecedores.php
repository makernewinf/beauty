<?php

class Fornecedores extends TRecord
{
    const TABLENAME  = 'fornecedores';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('empresa');
        parent::addAttribute('telefone');
        parent::addAttribute('celular');
        parent::addAttribute('email');
        parent::addAttribute('observacao');
            
    }

    /**
     * Method getProdutoss
     */
    public function getProdutoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('fornecedores_id', '=', $this->id));
        return Produtos::getObjects( $criteria );
    }
    /**
     * Method getContass
     */
    public function getContass()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('fornecedores_id', '=', $this->id));
        return Contas::getObjects( $criteria );
    }

    public function set_produtos_grupo_produtos_to_string($produtos_grupo_produtos_to_string)
    {
        if(is_array($produtos_grupo_produtos_to_string))
        {
            $values = GrupoProdutos::where('id', 'in', $produtos_grupo_produtos_to_string)->getIndexedArray('nome', 'nome');
            $this->produtos_grupo_produtos_to_string = implode(', ', $values);
        }
        else
        {
            $this->produtos_grupo_produtos_to_string = $produtos_grupo_produtos_to_string;
        }

        $this->vdata['produtos_grupo_produtos_to_string'] = $this->produtos_grupo_produtos_to_string;
    }

    public function get_produtos_grupo_produtos_to_string()
    {
        if(!empty($this->produtos_grupo_produtos_to_string))
        {
            return $this->produtos_grupo_produtos_to_string;
        }
    
        $values = Produtos::where('fornecedores_id', '=', $this->id)->getIndexedArray('grupo_produtos_id','{grupo_produtos->nome}');
        return implode(', ', $values);
    }

    public function set_produtos_fornecedores_to_string($produtos_fornecedores_to_string)
    {
        if(is_array($produtos_fornecedores_to_string))
        {
            $values = Fornecedores::where('id', 'in', $produtos_fornecedores_to_string)->getIndexedArray('id', 'id');
            $this->produtos_fornecedores_to_string = implode(', ', $values);
        }
        else
        {
            $this->produtos_fornecedores_to_string = $produtos_fornecedores_to_string;
        }

        $this->vdata['produtos_fornecedores_to_string'] = $this->produtos_fornecedores_to_string;
    }

    public function get_produtos_fornecedores_to_string()
    {
        if(!empty($this->produtos_fornecedores_to_string))
        {
            return $this->produtos_fornecedores_to_string;
        }
    
        $values = Produtos::where('fornecedores_id', '=', $this->id)->getIndexedArray('fornecedores_id','{fornecedores->id}');
        return implode(', ', $values);
    }

    public function set_contas_fornecedores_to_string($contas_fornecedores_to_string)
    {
        if(is_array($contas_fornecedores_to_string))
        {
            $values = Fornecedores::where('id', 'in', $contas_fornecedores_to_string)->getIndexedArray('id', 'id');
            $this->contas_fornecedores_to_string = implode(', ', $values);
        }
        else
        {
            $this->contas_fornecedores_to_string = $contas_fornecedores_to_string;
        }

        $this->vdata['contas_fornecedores_to_string'] = $this->contas_fornecedores_to_string;
    }

    public function get_contas_fornecedores_to_string()
    {
        if(!empty($this->contas_fornecedores_to_string))
        {
            return $this->contas_fornecedores_to_string;
        }
    
        $values = Contas::where('fornecedores_id', '=', $this->id)->getIndexedArray('fornecedores_id','{fornecedores->id}');
        return implode(', ', $values);
    }

    public function set_contas_grupo_contas_to_string($contas_grupo_contas_to_string)
    {
        if(is_array($contas_grupo_contas_to_string))
        {
            $values = GrupoContas::where('id', 'in', $contas_grupo_contas_to_string)->getIndexedArray('tipo', 'tipo');
            $this->contas_grupo_contas_to_string = implode(', ', $values);
        }
        else
        {
            $this->contas_grupo_contas_to_string = $contas_grupo_contas_to_string;
        }

        $this->vdata['contas_grupo_contas_to_string'] = $this->contas_grupo_contas_to_string;
    }

    public function get_contas_grupo_contas_to_string()
    {
        if(!empty($this->contas_grupo_contas_to_string))
        {
            return $this->contas_grupo_contas_to_string;
        }
    
        $values = Contas::where('fornecedores_id', '=', $this->id)->getIndexedArray('grupo_contas_id','{grupo_contas->tipo}');
        return implode(', ', $values);
    }

    
}

