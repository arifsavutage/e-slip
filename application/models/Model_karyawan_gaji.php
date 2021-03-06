<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_karyawan_gaji extends CI_Model
{

    public $table = 'karyawan_gaji';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by karyawan_id
    function get_by_karyawan_id($id)
    {
        $this->db->select('karyawan_gaji.*, variabel_gaji.nama_variabel, variabel_gaji.posisi');
        $this->db->join('variabel_gaji', 'variabel_gaji.id = karyawan_gaji.variabel_id', 'left');
        $this->db->where('karyawan_gaji.karyawan_id', $id);
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('created', $q);
        $this->db->or_like('karyawan_id', $q);
        $this->db->or_like('updated', $q);
        $this->db->or_like('user', $q);
        $this->db->or_like('variabel_id', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('created', $q);
        $this->db->or_like('karyawan_id', $q);
        $this->db->or_like('updated', $q);
        $this->db->or_like('user', $q);
        $this->db->or_like('variabel_id', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $var_id, $data)
    {
        $this->db->where('karyawan_id', $id);
        $this->db->where('variabel_id', $var_id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file Model_karyawan_gaji.php */
/* Location: ./application/models/Model_karyawan_gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:45:53 */
/* http://harviacode.com */