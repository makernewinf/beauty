<?php

class Profissionais extends TRecord
{
    const TABLENAME  = 'profissionais';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_profissionais;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('telefone');
        parent::addAttribute('celular');
        parent::addAttribute('salario');
        parent::addAttribute('cpf');
        parent::addAttribute('comissao');
        parent::addAttribute('tipo_profissionais_id');
            
    }

    /**
     * Method set_tipo_profissionais
     * Sample of usage: $var->tipo_profissionais = $object;
     * @param $object Instance of TipoProfissionais
     */
    public function set_tipo_profissionais(TipoProfissionais $object)
    {
        $this->tipo_profissionais = $object;
        $this->tipo_profissionais_id = $object->id;
    }

    /**
     * Method get_tipo_profissionais
     * Sample of usage: $var->tipo_profissionais->attribute;
     * @returns TipoProfissionais instance
     */
    public function get_tipo_profissionais()
    {
    
        // loads the associated object
        if (empty($this->tipo_profissionais))
            $this->tipo_profissionais = new TipoProfissionais($this->tipo_profissionais_id);
    
        // returns the associated object
        return $this->tipo_profissionais;
    }

    /**
     * Method getHorarioProfissionaiss
     */
    public function getHorarioProfissionaiss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('profissionais_id', '=', $this->id));
        return HorarioProfissionais::getObjects( $criteria );
    }
    /**
     * Method getAgendas
     */
    public function getAgendas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('profissionais_id', '=', $this->id));
        return Agenda::getObjects( $criteria );
    }
    /**
     * Method getPagamentoss
     */
    public function getPagamentoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('profissionais_id', '=', $this->id));
        return Pagamentos::getObjects( $criteria );
    }

    public function set_horario_profissionais_profissionais_to_string($horario_profissionais_profissionais_to_string)
    {
        if(is_array($horario_profissionais_profissionais_to_string))
        {
            $values = Profissionais::where('id', 'in', $horario_profissionais_profissionais_to_string)->getIndexedArray('id', 'id');
            $this->horario_profissionais_profissionais_to_string = implode(', ', $values);
        }
        else
        {
            $this->horario_profissionais_profissionais_to_string = $horario_profissionais_profissionais_to_string;
        }

        $this->vdata['horario_profissionais_profissionais_to_string'] = $this->horario_profissionais_profissionais_to_string;
    }

    public function get_horario_profissionais_profissionais_to_string()
    {
        if(!empty($this->horario_profissionais_profissionais_to_string))
        {
            return $this->horario_profissionais_profissionais_to_string;
        }
    
        $values = HorarioProfissionais::where('profissionais_id', '=', $this->id)->getIndexedArray('profissionais_id','{profissionais->id}');
        return implode(', ', $values);
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
    
        $values = Agenda::where('profissionais_id', '=', $this->id)->getIndexedArray('clientes_id','{clientes->sexo}');
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
    
        $values = Agenda::where('profissionais_id', '=', $this->id)->getIndexedArray('profissionais_id','{profissionais->id}');
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
    
        $values = Agenda::where('profissionais_id', '=', $this->id)->getIndexedArray('servicos_id','{servicos->nome}');
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
    
        $values = Pagamentos::where('profissionais_id', '=', $this->id)->getIndexedArray('profissionais_id','{profissionais->id}');
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
    
        $values = Pagamentos::where('profissionais_id', '=', $this->id)->getIndexedArray('clientes_id','{clientes->sexo}');
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
    
        $values = Pagamentos::where('profissionais_id', '=', $this->id)->getIndexedArray('tipo_pagamento_id','{tipo_pagamento->nome}');
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
    
        $values = Pagamentos::where('profissionais_id', '=', $this->id)->getIndexedArray('servicos_id','{servicos->nome}');
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
    
        $values = Pagamentos::where('profissionais_id', '=', $this->id)->getIndexedArray('produtos_id','{produtos->id}');
        return implode(', ', $values);
    }

    
}

