<?php

use Adianti\Base\AdiantiStandardListTrait;
use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Registry\TSession;
use Adianti\Widget\Container\TPanelGroup;
use Adianti\Widget\Container\TVBox;
use Adianti\Widget\Datagrid\TDataGrid;
use Adianti\Widget\Datagrid\TDataGridAction;
use Adianti\Widget\Datagrid\TDataGridColumn;
use Adianti\Widget\Datagrid\TPageNavigation;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Wrapper\BootstrapFormBuilder;

class ContatoList extends TPage
{
    protected $form, $datagrid, $pageNavigation;

    use AdiantiStandardListTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setDatabase('banco');
        $this->setActiveRecord('Contato');
        $this->setLimit(10);
        $this->setDefaultOrder('nome', 'asc');
        $this->addFilterField('nome', 'like', 'nome');

        $this->form = new BootstrapFormBuilder('form_contato_search');
        $this->form->setFormTitle('Contato');

        $nome = new TEntry('nome');

        $this->form->addFields([new TLabel('Nome')], [$nome]);

        $this->form->setData(TSession::getValue(__CLASS__ . '_filter_data'));

        $this->form->addAction('Procurar', new TAction([$this, 'onSearch']), 'fa:search green');
        $this->form->addAction('Cadastrar', new TAction(['ContatoForm', 'onEdit']), 'fa:plus blue');

        $this->datagrid = new TDataGrid;
        $this->datagrid->style = 'width:100%';

        $col_id = new TDataGridColumn('id', 'ID', 'left');
        $col_nome = new TDataGridColumn('nome', 'Nome', 'left');
        $col_dd1 = new TDataGridColumn('dd1', 'DD1', 'left');
        $col_tel1 = new TDataGridColumn('tel1', 'Tel1', 'left');
        $col_dd2 = new TDataGridColumn('dd2', 'DD2', 'left');
        $col_tel2 = new TDataGridColumn('tel2', 'Tel2', 'left');
        $col_dd3 = new TDataGridColumn('dd3', 'DD3', 'left');
        $col_tel3 = new TDataGridColumn('tel3', 'Tel3', 'left');
        $col_dd4 = new TDataGridColumn('dd4', 'DD4', 'left');
        $col_tel4 = new TDataGridColumn('tel4', 'Tel4', 'left');

        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_dd1);
        $this->datagrid->addColumn($col_tel1);
        $this->datagrid->addColumn($col_dd2);
        $this->datagrid->addColumn($col_tel2);
        $this->datagrid->addColumn($col_dd3);
        $this->datagrid->addColumn($col_tel3);
        $this->datagrid->addColumn($col_dd4);
        $this->datagrid->addColumn($col_tel4);

        $acao_editar = new TDataGridAction(['ContatoForm', 'onEdit'], ['id' => '{id}']);
        $acao_excluir = new TDataGridAction([$this, 'onDelete'], ['id' => '{id}']);

        $this->datagrid->addAction($acao_editar, 'Editar', 'fa:edit blue');
        $this->datagrid->addAction($acao_excluir, 'Excluir', 'fa:trash red');

        $this->datagrid->createModel();

        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        $this->pageNavigation->enableCounters();

        $panel = TPanelGroup::pack('', $this->datagrid, $this->pageNavigation);

        $vbox = new TVBox;
        $vbox->style = 'width:100%';
        $vbox->add($this->form);
        $vbox->add($panel);

        parent::add($vbox);
    }
}
