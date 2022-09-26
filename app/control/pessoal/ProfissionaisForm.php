<?php

class ProfissionaisForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Profissionais';
    private static $primaryKey = 'id';
    private static $formName = 'form_ProfissionaisForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.50, null);
        parent::setTitle("Cadastro de profissionais");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de profissionais");


        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $cpf = new TEntry('cpf');
        $telefone = new TEntry('telefone');
        $celular = new TEntry('celular');
        $salario = new TNumeric('salario', '2', ',', '.' );
        $comissao = new TNumeric('comissao', '2', ',', '.' );
        $tipo_profissionais_id = new TDBCombo('tipo_profissionais_id', 'beauty', 'TipoProfissionais', 'id', '{nome}','nome asc'  );

        $tipo_profissionais_id->addValidation("Tipo profissionais id", new TRequiredValidator()); 

        $id->setEditable(false);
        $nome->setMaxLength(100);
        $tipo_profissionais_id->enableSearch();

        $celular->setMask('(99)99999-9999');
        $telefone->setMask('(99)99999-9999');

        $id->setSize(100);
        $cpf->setSize('100%');
        $nome->setSize('100%');
        $celular->setSize('100%');
        $salario->setSize('100%');
        $telefone->setSize('100%');
        $comissao->setSize('100%');
        $tipo_profissionais_id->setSize('100%');

        $nome->forceUpperCase();                //coloquei em 20ago
        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Nome:", null, '14px', null, '100%'),$nome],[new TLabel("Cpf:", null, '14px', null, '100%'),$cpf]);
        $row1->layout = [' col-sm-2','col-sm-6',' col-sm-4'];

        $row2 = $this->form->addFields([new TLabel("Telefone:", null, '14px', null, '100%'),$telefone],[new TLabel("Celular:", null, '14px', null, '100%'),$celular],[new TLabel("Salário:", null, '14px', null, '100%'),$salario],[new TLabel("Comissão:", null, '14px', null, '100%'),$comissao]);
        $row2->layout = [' col-sm-3',' col-sm-3',' col-sm-3',' col-sm-3'];

        $row3 = $this->form->addFields([new TLabel("Tipo profissionais id:", '#3F51B5', '14px', null, '100%'),$tipo_profissionais_id]);
        $row3->layout = [' col-sm-4'];

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

            $object = new Profissionais(); // create an empty object 

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
            TApplication::loadPage('ProfissionaisHeaderList', 'onShow', $loadPageParam); 

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

                $object = new Profissionais($key); // instantiates the Active Record 

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

