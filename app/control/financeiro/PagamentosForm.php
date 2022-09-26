<?php

class PagamentosForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Pagamentos';
    private static $primaryKey = 'id';
    private static $formName = 'form_PagamentosForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.70, null);
        parent::setTitle("Cadastro de pagamentos");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de pagamentos");


        $id = new TEntry('id');
        $profissionais_id = new TDBCombo('profissionais_id', 'beauty', 'Profissionais', 'id', '{nome}','id asc'  );
        $clientes_id = new TDBCombo('clientes_id', 'beauty', 'Clientes', 'id', '{nome}','sexo asc'  );
        $datalanc = new TDate('datalanc');
        $datapgto = new TDate('datapgto');
        $produtos_id = new TDBCombo('produtos_id', 'beauty', 'Produtos', 'id', '{descricao}','id asc'  );
        $servicos_id = new TDBCombo('servicos_id', 'beauty', 'Servicos', 'id', '{nome}','nome asc'  );
        $desconto = new TNumeric('desconto', '2', ',', '.' );
        $valor = new TNumeric('valor', '2', ',', '.' );
        $tipo_pagamento_id = new TDBCombo('tipo_pagamento_id', 'beauty', 'TipoPagamento', 'id', '{nome}','nome asc'  );

        $profissionais_id->addValidation("Profissionais id", new TRequiredValidator()); 
        $clientes_id->addValidation("Clientes id", new TRequiredValidator()); 
        $tipo_pagamento_id->addValidation("Tipo pagamento id", new TRequiredValidator()); 

        $id->setEditable(false);

        $datalanc->setMask('dd/mm/yyyy');
        $datapgto->setMask('dd/mm/yyyy');

        $datalanc->setDatabaseMask('yyyy-mm-dd');
        $datapgto->setDatabaseMask('yyyy-mm-dd');

        $produtos_id->enableSearch();
        $clientes_id->enableSearch();
        $servicos_id->enableSearch();
        $profissionais_id->enableSearch();
        $tipo_pagamento_id->enableSearch();

        $id->setSize(100);
        $valor->setSize('21%');
        $datalanc->setSize(110);
        $datapgto->setSize(110);
        $desconto->setSize('18%');
        $clientes_id->setSize('56%');
        $produtos_id->setSize('42%');
        $servicos_id->setSize('44%');
        $profissionais_id->setSize('31%');
        $tipo_pagamento_id->setSize('28%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Profissional:", '#3F51B5', '14px', null)],[$profissionais_id,new TLabel("Cliente:", '#3F51B5', '14px', null),$clientes_id]);
        $row3 = $this->form->addFields([new TLabel("Data lançamento:", null, '14px', null)],[$datalanc,new TLabel("Data pagamento:", null, '14px', null),$datapgto]);
        $row4 = $this->form->addFields([new TLabel("Produto:", '#3F51B5', '14px', null)],[$produtos_id,new TLabel("Serviço:", '#3F51B5', '14px', null),$servicos_id]);
        $row5 = $this->form->addFields([new TLabel("Desconto:", null, '14px', null)],[$desconto,new TLabel("Valor:", null, '14px', null),$valor,new TLabel("Tipo pagamento:", '#3F51B5', '14px', null),$tipo_pagamento_id]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Pagamentos(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('PagamentosHeaderList', 'onShow', $loadPageParam); 

                TWindow::closeWindow(parent::getId()); 
        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Pagamentos($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

