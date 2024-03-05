<?php

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';

class CalcCtrl {

	private $msgs;
	private $form;
	private $result;

	public function __construct(){
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}

	public function getParams(){
		$this->form->kwota = isset($_REQUEST ['kwota']) ? $_REQUEST ['kwota']:null;
		$this->form->oprocentowanie = isset($_REQUEST ['procent']) ? $_REQUEST ['procent']:null;
		$this->form->okres = isset($_REQUEST ['okres']) ? $_REQUEST ['okres']:null;
	}


	public function validate() {

		if (! (isset ( $this->form->kwota ) && isset ( $this->form->oprocentowanie ) && isset ( $this->form->okres ))) {
			return false; 
		}

		if ($this->form->kwota == "") {
			$this->msgs->addError('Nie podano kwoty kredytu.');
		}
		if ($this->form->oprocentowanie == "") {
			$this->msgs->addError('Nie podano oprocentowania kredytu.');
		}
        if ($this->form->okres == "") {
			$this->msgs->addError('Nie podano czasu trwania kredytu.');
		}

		if (! $this->msgs->isError()) {

			if (! is_numeric ( $this->form->kwota )) {
				$this->msgs->addError('Podano nieprawidłową kwotę kredytu.');
			}

			if (! is_numeric ( $this->form->oprocentowanie )) {
				$this->msgs->addError('Podano nieprawidłowe oprocentowanie kredytu.');
			}

            if (! is_numeric ( $this->form->okres )) {
				$this->msgs->addError('Podano nieprawidłowy czas trwania kredytu.');
			}
		}

		return ! $this->msgs->isError();
	}

	public function process(){

		$this->getparams();

		if ($this->validate()) {

			$this->form->kwota = intval($this->form->kwota);
			$this->form->oprocentowanie = intval($this->form->oprocentowanie);
            $this->form->okres = intval($this->form->okres);
			$this->msgs->addInfo('Parametry poprawne.');

            $procent = (($this->form->kwota*$this->form->oprocentowanie)/100)*$this->form->okres;
            $kwota2 = $this->form->kwota+$procent;

            $miesiac = $this->form->okres*12;
            $this->result->result = $kwota2/$miesiac;

			$this->msgs->addInfo('Wykonano obliczenia.');
		}

		$this->generateView();
	}

	public function generateView(){
		global $conf;

		$smarty = new Smarty();
		$smarty->assign('conf',$conf);

		$smarty->assign('page_title','Kalkulator');
		$smarty->assign('page_description','Dzięki temu kalkulatorowi możesz obliczyć ratę swojego kredytu');
		$smarty->assign('page_header','Kalkulator kredytowy');

		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);

		$smarty->display($conf->root_path.'/app/credit_view.html');
	}
}