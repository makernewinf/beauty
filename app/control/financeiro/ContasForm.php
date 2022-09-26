<?php

class ContasForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Contas';
    private static $primaryKey = 'id';
    private static $formName = 'form_ContasForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.70, null);
        parent::setTitle("Contas");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Contas");


        $id = new TEntry('id');
        $documento = new TEntry('documento');
        $fornecedores_id = new TDBCombo('fornecedores_id', 'beauty', 'Fornecedores', 'id', '{nome}','id asc'  );
        $grupo_contas_id = new TDBCombo('grupo_contas_id', 'beauty', 'GrupoProdutos', 'id', '{nome}','nome asc'  );
        $valor = new TNumeric('valor', '2', ',', '.' );

        $fornecedores_id->addValidation("Fornecedores id", new TRequiredValidator()); 

        $id->setEditable(false);

        $fornecedores_id->enableSearch();
        $grupo_contas_id->enableSearch();

        $id->setSize(100);
        $valor->setSize('20%');
        $documento->setSize('26%');
        $fornecedores_id->setSize('47%');
        $grupo_contas_id->setSize('35%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Documento:", null, '14px', null)],[$documento,new TLabel("Fornecedores id:", '#3F51B5', '14px', null),$fornecedores_id]);
        $row3 = $this->form->addFields([new TLabel("Grupo id:", '#3F51B5', '14px', null)],[$grupo_contas_id]);
        $row4 = $this->form->addFields([new TLabel("Valor:", null, '14px', null)],[$valor]);

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

            $object = new Contas(); // create an empty object 

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
            TApplication::loadPage('ContasHeaderList', 'onShow', $loadPageParam); 

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

                $object = new Contas($key); // instantiates the Active Record 

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

