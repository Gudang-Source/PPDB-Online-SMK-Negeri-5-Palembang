<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->helper('site_helper');
    }

    public function index()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/home');
        $this->load->view('admin/template/footer');
    }

    public function pendaftaran()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }

        $x['filter'] = $this->session->userdata("filter_jurusan");
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_admin->show_data();
        $this->load->view('admin/pendaftaran', $x);
        $this->load->view('admin/template/footer');
    }

    public function ubahdata_siswa()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $nisn = $this->input->get('nisn');
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_admin->getdatasiswa($nisn);
        $this->load->view('admin/ubah_data_siswa', $x);
        $this->load->view('admin/template/footer');
    }

    public function tpa()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $x['filter'] = $this->session->userdata("filter_jurusan");
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/tpa', $x);
        $this->load->view('admin/template/footer');
    }

    public function edit_soal()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $nisn = $this->input->get('nisn');
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_admin->get_all_soal($nisn);
        $this->load->view('admin/edit_soal', $x);
        $this->load->view('admin/template/footer');
    }

    public function tambahdata_siswa()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/tambah_data_siswa');
        $this->load->view('admin/template/footer');
    }

    public function kelola_admin()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/kelola_akun_admin');
        $this->load->view('admin/template/footer');
    }

    public function pengaturan()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/pengaturan');
        $this->load->view('admin/template/footer');
    }

    public function login()
    {

        if ($this->session->userdata('level') == "admin") {
            Redirect(base_url() . "admin", false);
        } else if ($this->session->userdata('level') == "siswa") {
            Redirect(base_url() . "home", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/login');
        $this->load->view('admin/template/footer');
    }

    public function report()
    {
        if ($this->session->userdata('level') != "admin") {
            Redirect(base_url() . "login", false);
        }
        $x['filter'] = $this->session->userdata("filter_jurusan");
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/report', $x);
        $this->load->view('admin/template/footer');
    }

    function filter($jurusan)
    {
        if (isset($jurusan)) {
            $this->session->set_userdata('filter_jurusan', $jurusan);
        } else {
            $this->session->set_userdata('filter_jurusan', "");
        }
    }
}
