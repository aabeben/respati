<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticationModel extends CI_Model {
	private $_table = '`party`';

	function get_user($username, $password) {
		$this->db->where('id_user', $username);
        $this->db->where('password', md5($password));

		$result = $this->db->get($this->_table)->result();
		
		if($result)
			return $result;
		
		return NULL;
    }
}