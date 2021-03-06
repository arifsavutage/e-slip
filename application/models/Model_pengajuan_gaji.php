<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_pengajuan_gaji extends CI_Model
{

    public $table = 'pengajuan_gaji';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    //get pengajuan
    function get_pengajuan_data()
    {
        $this->db->select("karyawan.id, karyawan.nama_lengkap, perusahaan.nama, 
        pengajuan_gaji.gaji_id, pengajuan_gaji.periode, pengajuan_gaji.jam_lembur, 
        pengajuan_gaji.hari_kerja");
        $this->db->from('karyawan');
        $this->db->join('pengajuan_gaji', 'pengajuan_gaji.gaji_id = karyawan.id', 'left');
        $this->db->join('perusahaan', 'perusahaan.kode = karyawan.kode_pt', 'left');
        $this->db->order_by('karyawan.id', 'ASC');
        return $this->db->get()->result();
    }

    function get_rincian($periode = null, $id = null)
    {
        $this->db->select("pengajuan_gaji.id, karyawan.nama_lengkap, 
            SUM(CASE WHEN karyawan_gaji.variabel_id = 1 THEN karyawan_gaji.nominal END) AS gaji_pokok,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 2 THEN karyawan_gaji.nominal END) AS pot_persen,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 3 THEN karyawan_gaji.nominal END) AS tnj_jabatan,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 4 THEN karyawan_gaji.nominal END) AS tnj_ms_krj,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 5 THEN karyawan_gaji.nominal END) AS tnj_lain,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 6 THEN karyawan_gaji.nominal END) AS tnj_td_tetap,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 7 THEN karyawan_gaji.nominal END) AS uang_makan,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 10 THEN karyawan_gaji.nominal END) AS pot_koperasi,
            SUM(CASE WHEN karyawan_gaji.variabel_id = 11 THEN karyawan_gaji.nominal END) AS pot_bpjs,
            pengajuan_gaji.hari_kerja,pengajuan_gaji.jam_lembur,pengajuan_gaji.jml_cuti, 
            pengajuan_gaji.periode, perusahaan.nama");
        $this->db->from('karyawan');
        $this->db->join('perusahaan', 'perusahaan.kode = karyawan.kode_pt', 'left');
        $this->db->join('pengajuan_gaji', 'pengajuan_gaji.gaji_id = karyawan.id', 'inner');
        $this->db->join('karyawan_gaji', 'karyawan_gaji.karyawan_id = karyawan.id', 'inner');
        $this->db->join('variabel_gaji', 'variabel_gaji.id = karyawan_gaji.variabel_id', 'inner');
        $this->db->where('karyawan_gaji.nominal IS NOT NULL');

        if ($periode != null) {
            $this->db->where('pengajuan_gaji.periode', $periode);
        }

        if ($id != null) {
            $this->db->where('pengajuan_gaji.id', $id);
        }

        $this->db->group_by('karyawan.id');
        return $this->db->get(); //view data di sesuaikan apakah tunggal atau banyak
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

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('created', $q);
        $this->db->or_like('gaji_id', $q);
        $this->db->or_like('periode', $q);
        $this->db->or_like('user', $q);
        $this->db->from($this->table);
        $this->db->group_by('periode');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('created', $q);
        $this->db->or_like('gaji_id', $q);
        $this->db->or_like('periode', $q);
        $this->db->or_like('user', $q);
        $this->db->group_by('periode');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file Model_pengajuan_gaji.php */
/* Location: ./application/models/Model_pengajuan_gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:46:08 */
/* http://harviacode.com */