<?php

class HorarioProfissionaisForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'HorarioProfissionais';
    private static $primaryKey = 'id';
    private static $formName = 'form_HorarioProfissionaisForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.50, null);
        parent::setTitle("Cadastro de horario profissionais");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de horario profissionais");


        $id = new TEntry('id');
        $dia = new TEntry('dia');
        $hora_inicio = new TTime('hora_inicio');
        $hora_final = new TTime('hora_final');
        $intervalo = new TEntry('intervalo');
        $profissionais_id = new TDBCombo('profissionais_id', 'beauty', 'Profissionais', 'id', '{id}','id asc'  );

        $profissionais_id->addValidation("Profissionais id", new TRequiredValidator()); 

        $dia->setMaxLength(10);
        $id->setEditable(false);
        $profissionais_id->enableSearch();

        $id->setSize(100);
        $dia->setSize('100%');
        $hora_final->setSize(110);
        $hora_inicio->setSize(110);
        $intervalo->setSize('100%');
        $profissionais_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Dia:", null, '14px', null, '100%'),$dia],[new TLabel("Hora inicio:", null, '14px', null, '100%'),$hora_inicio],[new TLabel("Hora final:", null, '14px', null, '100%'),$hora_final]);
        $row1->layout = [' col-sm-2',' col-sm-3','col-sm-2','col-sm-2'];

        $row2 = $this->form->addFields([new TLabel("Intervalo:", null, '14px', null, '100%'),$intervalo],[new TLabel("Profissionais id:", '#3F51B5', '14px', null, '100%'),$profissionais_id]);
        $row2->layout = [' col-sm-3','col-sm-6'];

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

            $object = new HorarioProfissionais(); // create an empty object 

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
            TApplication::loadPage('HorarioProfissionaisHeaderList', 'onShow', $loadPageParam); 

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

                $object = new HorarioProfissionais($key); // instantiates the Active Record 

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

