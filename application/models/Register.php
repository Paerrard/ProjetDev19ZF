<?php

class Application_Model_Register
{
	/**
	 * @var int
	 */
	private $_id;
	/**
	 * @var string
	 */
	private $_nom;
	/**
	 * @var string
	 */
	private $_prenom;
	/**
	 * @var string
	 */
	private $_login;
	/**
	 * @var string
	 */
	private $_password;
	/**
	 * @var string
	 */
	private $_email;
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @param int $_id
	 */
	public function setId($_id) {
		$this->_id = (int) $_id;
		return $this;
	}

	/**
	 * @return the $_nom
	 */
	public function getNom() {
		return $this->_nom;
	}

	/**
	 * @param string $_nom
	 */
	public function setNom($_nom) {
		$this->_nom = (string) $_nom;
		return $this;
	}

	/**
	 * @return the $_prenom
	 */
	public function getPrenom() {
		return $this->_prenom;
	}

	/**
	 * @param string $_prenom
	 */
	public function setPrenom($_prenom) {
		$this->_prenom = (string) $_prenom;
		return $this;
	}

	/**
	 * @return the $_login
	 */
	public function getLogin() {
		return $this->_login;
	}

	/**
	 * @param string $_login
	 */
	public function setLogin($_login) {
		$this->_login = (string) $_login;
		return $this;
	}

	/**
	 * @return the $_password
	 */
	public function getPassword() {
		return $this->_password;
	}

	/**
	 * @param string $_password
	 */
	public function setPassword($_password) {
		$this->_password = (string) $_password;
		return $this;
	}

	/**
	 * @return the $_email
	 */
	public function getEmail() {
		return $this->_email;
	}

	/**
	 * @param string $_email
	 */
	public function setEmail($_email) {
		$this->_email = (string) $_email;
		return $this;
	}

	
	
}