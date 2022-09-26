<?php

class Servicos extends TRecord
{
    const TABLENAME  = 'servicos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $grupo_servicos;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('grupo_servicos_id');
        parent::addAttribute('valor');
            
    }

    /**
     * Method set_grupo_servicos
     * Sample of usage: $var->grupo_servicos = $object;
     * @param $object Instance of GrupoServicos
     */
    public function set_grupo_servicos(GrupoServicos $object)
    {
        $this->grupo_servicos = $object;
        $this->grupo_servicos_id = $object->id;
    }

    /**
     * Method get_grupo_servicos
     * Sample of usage: $var->grupo_servicos->attribute;
     * @returns GrupoServicos instance
     */
    public function get_grupo_servicos()
    {
    
        // loads the associated object
        if (empty($this->grupo_servicos))
            $this->grupo_servicos = new GrupoServicos($this->grupo_servicos_id);
    
        // returns the associated object
        return $this->grupo_servicos;
    }

    /**
     * Method getAgendas
     */
    public function getAgendas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('servicos_id', '=', $this->id));
        return Agenda::getObjects( $criteria );
    }
    /**
     * Method getPagamentoss
     */
    public function getPagamentoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('servicos_id', '=', $this->id));
        return Pagamentos::getObjects( $criteria );
    }

    public function set_agenda_clientes_to_string($agenda_clientes_to_string)
    {
        if(is_array($agenda_clientes_to_string))
        {
            $values = Clientes::where('id', 'in', $agenda_clientes_to_string)->getIndexedArray('sexo', 'sexo');
            $this->agenda_clientes_to_string = implode(', ', $values);
        }
        else
        {
            $this->agenda_clientes_to_string = $agenda_clientes_to_string;
        }

        $this->vdata['agenda_clientes_to_string'] = $this->agenda_clientes_to_string;
    }

    public function get_agenda_clientes_to_string()
    {
        if(!empty($this->agenda_clientes_to_string))
        {
            return $this->agenda_clientes_to_string;
        }
    
        $values = Agenda::where('servicos_id', '=', $this->id)->getIndexedArray('clientes_id','{clientes->sexo}');
        return implode(', ', $values);
    }

    public function set_agenda_profissionais_to_string($agenda_profissionais_to_string)
    {
        if(is_array($agenda_profissionais_to_string))
        {
            $values = Profissionais::where('id', 'in', $agenda_profissionais_to_string)->getIndexedArray('id', 'id');
            $this->agenda_profissionais_to_string = implode(', ', $values);
        }
        else
        {
            $this->agenda_profissionais_to_string = $agenda_profissionais_to_string;
        }

        $this->vdata['agenda_profissionais_to_string'] = $this->agenda_profissionais_to_string;
    }

    public function get_agenda_profissionais_to_string()
    {
        if(!empty($this->agenda_profissionais_to_string))
        {
            return $this->agenda_profissionais_to_string;
        }
    
        $values = Agenda::where('servicos_id', '=', $this->id)->getIndexedArray('profissionais_id','{profissionais->id}');
        return implode(', ', $values);
    }

    public function set_agenda_servicos_to_string($agenda_servicos_to_string)
    {
        if(is_array($agenda_servicos_to_string))
        {
            $values = Servicos::where('id', 'in', $agenda_servicos_to_string)->getIndexedArray('nome', 'nome');
            $this->agenda_servicos_to_string = implode(', ', $values);
        }
        else
        {
            $this->agenda_servicos_to_string = $agenda_servicos_to_string;
        }

        $this->vdata['agenda_servicos_to_string'] = $this->agenda_servicos_to_string;
    }

    public function get_agenda_servicos_to_string()
    {
        if(!empty($this->agenda_servicos_to_string))
        {
            return $this->agenda_servicos_to_string;
        }
    
        $values = Agenda::where('servicos_id', '=', $this->id)->getIndexedArray('servicos_id','{servicos->nome}');
        return implode(', ', $values);
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
    
        $values = Pagamentos::where('servicos_id', '=', $this->id)->getIndexedArray('profissionais_id','{profissionais->id}');
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
    
        $values = Pagamentos::where('servicos_id', '=', $this->id)->getIndexedArray('clientes_id','{clientes->sexo}');
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
    
        $values = Pagamentos::where('servicos_id', '=', $this->id)->getIndexedArray('tipo_pagamento_id','{tipo_pagamento->nome}');
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
    
        $values = Pagamentos::where('servicos_id', '=', $this->id)->getIndexedArray('servicos_id','{servicos->nome}');
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
    
        $values = Pagamentos::where('servicos_id', '=', $this->id)->getIndexedArray('produtos_id','{produtos->id}');
        return implode(', ', $values);
    }

    
}

