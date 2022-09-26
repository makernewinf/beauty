<?php

class ClientesForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Clientes';
    private static $primaryKey = 'id';
    private static $formName = 'form_ClientesForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.80, null);
        parent::setTitle("Clientes");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Clientes");


        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $cpf = new TEntry('cpf');
        $sexo = new TEntry('sexo');
        $telefone = new TEntry('telefone');
        $celular = new TEntry('celular');
        $datanasc = new TDate('datanasc');
        $obs = new TEntry('obs');
        $email = new TEntry('email');
        $datacad = new TDate('datacad');

        $cpf->addValidation("Cpf invalido!", new TCPFValidator(), []); 
        $email->addValidation("Email invalido!", new TEmailValidator(), []); 

        $id->setEditable(false);
        $datacad->setDatabaseMask('yyyy-mm-dd');
        $datanasc->setDatabaseMask('yyyy-mm-dd');

        $celular->placeholder = "(99)99999-9999";
        $telefone->placeholder = "(99)99999-9999";

        $obs->setMaxLength(100);
        $sexo->setMaxLength(10);
        $nome->setMaxLength(100);
        $email->setMaxLength(100);

        $datacad->setMask('dd/mm/yyyy');
        $datanasc->setMask('dd/mm/yyyy');
        $celular->setMask('(99)99999-9999');
        $telefone->setMask('(99)99999-9999');

        $id->setSize(100);
        $cpf->setSize('100%');
        $obs->setSize('100%');
        $nome->setSize('100%');
        $sexo->setSize('100%');
        $datacad->setSize(110);
        $datanasc->setSize(110);
        $email->setSize('100%');
        $celular->setSize('100%');
        $telefone->setSize('100%');

        $nome->forceUpperCase();                //coloquei em 20ago
        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Nome:", null, '14px', null, '100%'),$nome],[new TLabel("Cpf ok:", null, '14px', null, '100%'),$cpf]);
        $row1->layout = [' col-sm-2',' col-sm-6',' col-sm-4'];

        $row2 = $this->form->addFields([new TLabel("Sexo:", null, '14px', null, '100%'),$sexo],[new TLabel("Telefone:", null, '14px', null, '100%'),$telefone],[new TLabel("Celular:", null, '14px', null, '100%'),$celular],[new TLabel("Data nascimento:", null, '14px', null, '100%'),$datanasc]);
        $row2->layout = [' col-sm-3',' col-sm-3',' col-sm-3',' col-sm-3'];

        $row3 = $this->form->addFields([new TLabel("Observação:", null, '14px', null, '100%'),$obs],[new TLabel("Email:", null, '14px', null, '100%'),$email],[new TLabel("Data cadastro:", null, '14px', null, '100%'),$datacad]);
        $row3->layout = [' col-sm-6',' col-sm-4',' col-sm-2'];

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

            $object = new Clientes(); // create an empty object 

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
            TApplication::loadPage('ClientesHeaderList', 'onShow', $loadPageParam); 

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

                $object = new Clientes($key); // instantiates the Active Record 

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

