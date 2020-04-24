<?php

use Adianti\Base\AdiantiStandardFormTrait;
use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Wrapper\BootstrapFormBuilder;

class ContatoForm extends TPage
{
    protected $form;

    use AdiantiStandardFormTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setDatabase('banco');
        $this->setActiveRecord('Contato');

        $this->form = new BootstrapFormBuilder('form_contato');
        $this->form->setFormTitle('Contato');

        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $dd1 = new TEntry('dd1');
        $tel1 = new TEntry('tel1');
        $dd2 = new TEntry('dd2');
        $tel2 = new TEntry('tel2');
        $dd3 = new TEntry('dd3');
        $tel3 = new TEntry('tel3');
        $dd4 = new TEntry('dd4');
        $tel4 = new TEntry('tel4');

        $id->setEditable(false);

        $this->form->addFields([new TLabel('ID')], [$id]);
        $this->form->addFields([new TLabel('Nome')], [$nome]);
        $this->form->addFields([new TLabel('DD1')], [$dd1], [new TLabel('Tel1')], [$tel1]);
        $this->form->addFields([new TLabel('DD2')], [$dd2], [new TLabel('Tel2')], [$tel2]);
        $this->form->addFields([new TLabel('DD3')], [$dd3], [new TLabel('Tel3')], [$tel3]);
        $this->form->addFields([new TLabel('DD4')], [$dd4], [new TLabel('Tel4')], [$tel4]);

        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addAction('Limpar', new TAction([$this, 'onClear']), 'fa:eraser red');

        parent::add($this->form);
    }
}
