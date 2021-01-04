<?php

namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl
{

    private $form;
    private $result;

    public function __construct()
    {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

	public function getParams(){
		$this->form->kwota = getFromRequest('kwota');
		$this->form->lata = getFromRequest('lata');
		$this->form->procent = getFromRequest('procent');
	}

        
	public function validate() {
        if (!(isset ($this->form->kwota) && isset ($this->form->lata) && isset ($this->form->procent))) {
            return false;
        }
//sprawdzanie
        if ($this->form->kwota == null) 
        {
            getMessages()->addError('Kwota planowanej pozyczki nie zostala podana');
        }

        if ($this->form->lata == null) 
        {
            getMessages()->addError('Podaj czas kredytowania');
        }

        if ($this->form->procent == null) 
        {
            getMessages()->addError('Oprocentowanie nie jest znane');
        }
		
		
		return ! getMessages()->isError();
	}

	public function process(){

		$this->getParams();
		
        if ($this->validate()) {
            $this->form->kwota = intval($this->form->kwota);
            $this->form->lata = intval($this->form->lata);
            $this->form->procent = floatval($this->form->procent);
            getMessages()->addInfo('Parametry poprawne');

            $this->result->result = ($this->form->kwota + ($this->form->lata * ($this->form->procent / 100))) / ($this->form->lata * 12);
            

            getMessages()->addInfo('Gotowe, obliczenia wykonane');
        }

        $this->generateView();
	}


	public function generateView(){
		
		getSmarty()->assign('page_title','Zadanie6');
		getSmarty()->assign('page_description','Kolejne rozszerzenia dla aplikacja z jednym "punktem wejścia". Do nowej struktury dołożono automatyczne ładowanie klas wykorzystując w strukturze przestrzenie nazw.');
		getSmarty()->assign('page_header','Kontroler głowny');
					
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.tpl'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
