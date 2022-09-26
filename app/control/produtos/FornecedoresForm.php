<?php

class FornecedoresForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Fornecedores';
    private static $primaryKey = 'id';
    private static $formName = 'form_FornecedoresForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.50, null);
        parent::setTitle("Fornecedores");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Fornecedores");


        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $empresa = new TEntry('empresa');
        $telefone = new TEntry('telefone');
        $celular = new TEntry('celular');
        $observacao = new TEntry('observacao');
        $email = new TEntry('email');


        $id->setEditable(false);

        $celular->setMask('(99)99999-9999');
        $telefone->setMask('(99)99999-9999');

        $nome->setMaxLength(100);
        $email->setMaxLength(100);
        $empresa->setMaxLength(100);
        $observacao->setMaxLength(100);

        $id->setSize(100);
        $nome->setSize('100%');
        $email->setSize('100%');
        $empresa->setSize('100%');
        $celular->setSize('100%');
        $telefone->setSize('100%');
        $observacao->setSize('100%');

        $nome->forceUpperCase();                //coloquei em 20ago
        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Nome:", null, '14px', null, '100%'),$nome]);
        $row1->layout = [' col-sm-2','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Empresa:", null, '14px', null, '100%'),$empresa],[new TLabel("Telefone:", null, '14px', null, '100%'),$telefone],[new TLabel("Celular:", null, '14px', null, '100%'),$celular]);
        $row2->layout = ['col-sm-6',' col-sm-3',' col-sm-3'];

        $row3 = $this->form->addFields([new TLabel("Observação:", null, '14px', null, '100%'),$observacao],[new TLabel("Email:", null, '14px', null, '100%'),$email]);
        $row3->layout = [' col-sm-7',' col-sm-5'];

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

            $object = new Fornecedores(); // create an empty object 

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
            TApplication::loadPage('FornecedoresHeaderList', 'onShow', $loadPageParam); 

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

                $object = new Fornecedores($key); // instantiates the Active Record 

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

