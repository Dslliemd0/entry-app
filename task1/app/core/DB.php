<?php

/*
 * Database class DB where connect to database, revieve, and submit data into database.
 */
class DB {

/*
 * Declare static variable of object instance state, by default it is null.
 */
	private static $_instance = null;

/*
 * Declare private static object properties which is used to get and set data between this class methods.
 */
	private $_pdo, $_query, $_error = false, $_results, $_count = 0;

/*
 * Private DB constructor which established connection to database when get provided information from Config class who reads a global variable arrays of usefull data.
 */
	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

/*
 * Static function which accesses to DB private constructor and checks if instance is already created. If instance of DB class is created, then it returns already created instance.
 */
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

/*
 * Method which execute SQL query and bind values into query from this method parameters. After successfull checking of SQL query, returns an object containing results of executed SQL script.
 */
	public function query($sql, $params = array()) {
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if (count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if ($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}

/*
 * Method which prepare SQL operations for CRUD implementation on other methods.
 */
	public function action($action, $table, $where = array()) {
		if (count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');
			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];
			if (in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
		return false;
	}

/*
 * Shortcut method to easily get records from database, when define table and where operations.
 */
	public function get($table, $where) {
		return $this->action('SELECT *', $table, $where);
	}

/*
 * Shortcut method for inserting a data into database based on given $table name as database table and field list of key -> value pairs ($fields) which needed to inset into database table.
 */
	public function insert($table, $fields = array()) {
		if (count($fields)) {
			$keys = array_keys($fields);
			$values = null;
			$counter = 1;

			foreach ($fields as $field) {
				$values .= '?';
				if ($counter < count($fields)) {
					$values .= ', ';
				}
				$counter++;
			}

			$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

			if(!$this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return false;
	}

/*
 * Method which returns results (object) from last SQL query.
 */
	public function results() {
		return $this->_results;
	}

/*
 * Method wich return only first record of last queried SQL query.
 */
	public function first() {
		return $this->_results[0];
	}

/*
 * Simple method which return error condition value (true or false).
 */
	public function error() {
		return $this->_error;
	}

/*
 * Method who returns the count resulted records from database.
 */
	public function count() {
		return $this->_count;
	}
}