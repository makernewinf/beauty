<?php

class TipoProfissionais extends TRecord
{
    const TABLENAME  = 'tipo_profissionais';
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
     * Method getProfissionaiss
     */
    public function getProfissionaiss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_profissionais_id', '=', $this->id));
        return Profissionais::getObjects( $criteria );
    }

    public function set_profissionais_tipo_profissionais_to_string($profissionais_tipo_profissionais_to_string)
    {
        if(is_array($profissionais_tipo_profissionais_to_string))
        {
            $values = TipoProfissionais::where('id', 'in', $profissionais_tipo_profissionais_to_string)->getIndexedArray('nome', 'nome');
            $this->profissionais_tipo_profissionais_to_string = implode(', ', $values);
        }
        else
        {
            $this->profissionais_tipo_profissionais_to_string = $profissionais_tipo_profissionais_to_string;
        }

        $this->vdata['profissionais_tipo_profissionais_to_string'] = $this->profissionais_tipo_profissionais_to_string;
    }

    public function get_profissionais_tipo_profissionais_to_string()
    {
        if(!empty($this->profissionais_tipo_profissionais_to_string))
        {
            return $this->profissionais_tipo_profissionais_to_string;
        }
    
        $values = Profissionais::where('tipo_profissionais_id', '=', $this->id)->getIndexedArray('tipo_profissionais_id','{tipo_profissionais->nome}');
        return implode(', ', $values);
    }

    
}

