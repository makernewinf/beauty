<?php

class GrupoProdutos extends TRecord
{
    const TABLENAME  = 'grupo_produtos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
            
    }

    /**
     * Method getProdutoss
     */
    public function getProdutoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('grupo_produtos_id', '=', $this->id));
        return Produtos::getObjects( $criteria );
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
    
        $values = Produtos::where('grupo_produtos_id', '=', $this->id)->getIndexedArray('grupo_produtos_id','{grupo_produtos->nome}');
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
    
        $values = Produtos::where('grupo_produtos_id', '=', $this->id)->getIndexedArray('fornecedores_id','{fornecedores->id}');
        return implode(', ', $values);
    }

    
}

