<?php

use Adianti\Database\TRecord;

class Contato extends TRecord
{
    const TABLENAME = 'contato';
    const PRIMARYKEY = 'id';
    const IDPOLICY = 'serial';

    public function __construct($id = null)
    {
        parent::__construct($id);

        parent::addAttribute('nome');
        parent::addAttribute('dd1');
        parent::addAttribute('tel1');
        parent::addAttribute('dd2');
        parent::addAttribute('tel2');
        parent::addAttribute('dd3');
        parent::addAttribute('tel3');
        parent::addAttribute('dd4');
        parent::addAttribute('tel4');
    }
}
