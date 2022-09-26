<?php

class GrupoServicos extends TRecord
{
    const TABLENAME  = 'grupo_servicos';
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
     * Method getServicoss
     */
    public function getServicoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('grupo_servicos_id', '=', $this->id));
        return Servicos::getObjects( $criteria );
    }

    public function set_servicos_grupo_servicos_to_string($servicos_grupo_servicos_to_string)
    {
        if(is_array($servicos_grupo_servicos_to_string))
        {
            $values = GrupoServicos::where('id', 'in', $servicos_grupo_servicos_to_string)->getIndexedArray('nome', 'nome');
            $this->servicos_grupo_servicos_to_string = implode(', ', $values);
        }
        else
        {
            $this->servicos_grupo_servicos_to_string = $servicos_grupo_servicos_to_string;
        }

        $this->vdata['servicos_grupo_servicos_to_string'] = $this->servicos_grupo_servicos_to_string;
    }

    public function get_servicos_grupo_servicos_to_string()
    {
        if(!empty($this->servicos_grupo_servicos_to_string))
        {
            return $this->servicos_grupo_servicos_to_string;
        }
    
        $values = Servicos::where('grupo_servicos_id', '=', $this->id)->getIndexedArray('grupo_servicos_id','{grupo_servicos->nome}');
        return implode(', ', $values);
    }

    
}

