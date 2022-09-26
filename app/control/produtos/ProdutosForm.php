<?php

class ProdutosForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'beauty';
    private static $activeRecord = 'Produtos';
    private static $primaryKey = 'id';
    private static $formName = 'form_ProdutosForm';

    use Adianti\Base\AdiantiFileSaveTrait;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.50, null);
        parent::setTitle("Cadastro de produtos");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de produtos");


        $id = new TEntry('id');
        $descricao = new TEntry('descricao');
        $tipo = new TCombo('tipo');
        $custo = new TNumeric('custo', '2', ',', '.' );
        $preco = new TNumeric('preco', '2', ',', '.' );
        $estoque_min = new TEntry('estoque_min');
        $estoque_atual = new TEntry('estoque_atual');
        $grupo_produtos_id = new TDBCombo('grupo_produtos_id', 'beauty', 'GrupoProdutos', 'id', '{nome}','nome asc'  );
        $fornecedores_id = new TDBCombo('fornecedores_id', 'beauty', 'Fornecedores', 'id', '{nome}','id asc'  );
        $foto = new TImageCropper('foto');

        $grupo_produtos_id->addValidation("Grupo produtos id", new TRequiredValidator()); 
        $fornecedores_id->addValidation("Fornecedores id", new TRequiredValidator()); 

        $id->setEditable(false);
        $descricao->setMaxLength(100);
        $tipo->addItems(["1"=>"Venda","2"=>"Uso interno"]);
        $foto->enableFileHandling();
        $foto->setAllowedExtensions(["jpg","jpeg","png","gif"]);
        $foto->setAspectRatio(TimageCropper::CROPPER_RATIO_16_9);
        $foto->setImagePlaceholder(new TImage("fas:file-upload"));

        $tipo->enableSearch();
        $fornecedores_id->enableSearch();
        $grupo_produtos_id->enableSearch();

        $id->setSize(100);
        $tipo->setSize('100%');
        $custo->setSize('100%');
        $preco->setSize('100%');
        $foto->setSize(397, 320);
        $descricao->setSize('100%');
        $estoque_min->setSize('100%');
        $estoque_atual->setSize('100%');
        $fornecedores_id->setSize('88%');
        $grupo_produtos_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Descrição:", null, '14px', null, '100%'),$descricao]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Condição:", null, '14px', null, '100%'),$tipo],[new TLabel("Custo:", null, '14px', null, '100%'),$custo]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Preço:", null, '14px', null, '100%'),$preco],[new TLabel("Estoque mínimo:", null, '14px', null, '100%'),$estoque_min]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Estoque atual:", null, '14px', null, '100%'),$estoque_atual],[new TLabel("Grupo produtos id:", '#ff0000', '14px', null, '100%'),$grupo_produtos_id]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Fornecedores id:", '#ff0000', '14px', null, '100%'),$fornecedores_id],[$foto]);
        $row5->layout = [' col-sm-5','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['ProdutosHeaderList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Produtos(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $this->saveBinaryFile($object, $data, 'foto', 'nome_foto');
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
            TApplication::loadPage('ProdutosHeaderList', 'onShow', $loadPageParam); 

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

                $object = new Produtos($key); // instantiates the Active Record 

                $this->loadBinaryFile($object, 'foto', 'nome_foto'); 

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

