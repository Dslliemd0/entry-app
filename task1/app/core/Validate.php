<?php

/*
 * Validation class which checks from form inputted values.
 */
class Validate {

/*
 * Private Validate object properties which is used to manipulate between class methods.
 */
	private $_passed = false, $_errors = array(), $_db = null;

/*
 * Validate object constructor method which instantiate database instance to use database on this class methods.
 */
	public function __construct() {
		$this->_db = DB::getInstance();
	}

/*
 * This method checks if the submitted source is valid based on rules which is added $items array as key (rule) -> value (value of this rule) pairs. Rules is defined by case and opposite condition of this rule. If the rule executed, then error message are saved through addError() method. After error checking is finished and errors not found, then object variable is set to true.
 */
	public function check($source, $items = array()) {
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);

				if ($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} else if (!empty($value)) {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
						break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
						break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if ($check->count()) {
								$this->addError("{$item} already exists.");
							}
						break;
					}
				}
			}
		}
		if (empty($this->_errors)) {
			$this->_passed = true;
		}
		return $this;
	}

/*
 * This method adds an error message $error to object private property _errors.
 */
	private function addError($error) {
		$this->_errors[] = $error;
	}

/*
 * Method which return array of errors.
 */
	public function errors() {
		return $this->_errors;
	}

/*
 * This method return object private property _passed.
 */
	public function passed() {
		return $this->_passed;
	}
}