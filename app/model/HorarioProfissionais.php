<?php

class HorarioProfissionais extends TRecord
{
    const TABLENAME  = 'horario_profissionais';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $profissionais;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dia');
        parent::addAttribute('hora_inicio');
        parent::addAttribute('hora_final');
        parent::addAttribute('intervalo');
        parent::addAttribute('profissionais_id');
            
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

    
}

