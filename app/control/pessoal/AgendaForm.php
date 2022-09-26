<?php

class AgendaForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Agenda';
    private static $primaryKey = 'id';
    private static $formName = 'form_AgendaForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.50, null);
        parent::setTitle("Cadastro de agenda");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de agenda");


        $id = new TEntry('id');
        $dataag = new TDate('dataag');
        $horaag = new TTime('horaag');
        $cor = new TColor('cor');
        $clientes_id = new TDBCombo('clientes_id', 'beauty', 'Clientes', 'id', '{sexo}','sexo asc'  );
        $profissionais_id = new TDBCombo('profissionais_id', 'beauty', 'Profissionais', 'id', '{id}','id asc'  );
        $servicos_id = new TDBCombo('servicos_id', 'beauty', 'Servicos', 'id', '{nome}','nome asc'  );

        $clientes_id->addValidation("Clientes id", new TRequiredValidator()); 
        $profissionais_id->addValidation("Profissionais id", new TRequiredValidator()); 
        $servicos_id->addValidation("Servicos id", new TRequiredValidator()); 

        $id->setEditable(false);
        $dataag->setMask('dd/mm/yyyy');
        $dataag->setDatabaseMask('yyyy-mm-dd');

        $clientes_id->enableSearch();
        $servicos_id->enableSearch();
        $profissionais_id->enableSearch();

        $id->setSize(100);
        $cor->setSize(100);
        $dataag->setSize(110);
        $horaag->setSize(110);
        $clientes_id->setSize('100%');
        $servicos_id->setSize('100%');
        $profissionais_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Data:", null, '14px', null, '100%'),$dataag],[new TLabel("Hora:", null, '14px', null, '100%'),$horaag],[new TLabel("Cor:", null, '14px', null, '100%'),$cor]);
        $row1->layout = [' col-sm-2',' col-sm-2','col-sm-2','col-sm-2'];

        $row2 = $this->form->addFields([new TLabel("Clientes id:", '#3F51B5', '14px', null, '100%'),$clientes_id],[new TLabel("Profissionais id:", '#3F51B5', '14px', null, '100%'),$profissionais_id],[new TLabel("Servicos id:", '#3F51B5', '14px', null, '100%'),$servicos_id]);
        $row2->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

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

            $object = new Agenda(); // create an empty object 

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
            TApplication::loadPage('AgendaHeaderList', 'onShow', $loadPageParam); 

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

                $object = new Agenda($key); // instantiates the Active Record 

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

