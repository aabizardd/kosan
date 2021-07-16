<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kosan extends CI_Model
{
    public function selectAll()
    {
        return $this->db->get('kosan')->result_array();
    }
}