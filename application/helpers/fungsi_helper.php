<?php
function check_already_login(){

    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session){
        redirect('dashboard');
    }
}

//untuk semua ctrl cek seesion login dan session unit
function is_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session){
        redirect('auth');        
    }
}

//untuk bagian dashboard saja
function cek_login_aja(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
        if (!$user_session){
        redirect('auth');
        }
}

//akses menu
function check_access($level_id, $sub_menu_id ){
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('sub_menu_id', $sub_menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
         return "checked='checked'";
    }

}

 //acces_read
  function check_access_read($level_id, $menu_id ){
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('sub_menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
        $row = $result->row();
        if ($row->read == 1) {
            return "checked='checked'";
        }         
    }

 }

 //acces_create
  function check_access_create($level_id, $menu_id ){
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('sub_menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
        $row = $result->row();
        if ($row->create == 1) {
            return "checked='checked'";
        }         
    }

 }

  //acces_update
  function check_access_update($level_id, $menu_id ){
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('sub_menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
        $row = $result->row();
        if ($row->update == 1) {
            return "checked='checked'";
        }         
    }

 }

 //acces_delete
  function check_access_delete($level_id, $menu_id ){
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('sub_menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
        $row = $result->row();
        if ($row->delete == 1) {
            return "checked='checked'";
        }         
    }

 }
 //acces_export
  function check_access_export($level_id, $menu_id ){
    $ci = get_instance();
    $ci->db->where('level_id', $level_id);
    $ci->db->where('sub_menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
        $row = $result->row();
        if ($row->export == 1) {
            return "checked='checked'";
        }         
    }

 }

//format rupiah
function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
}

//is_allowed
function is_allowed($nama_menu, $access=null){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    $user_session = $ci->fungsi->user_login()->level_id;
    $ci->db->select('user_access_menu.*,sub_menu.url');
    $ci->db->from('user_access_menu');
    $ci->db->join('sub_menu', 'sub_menu.sub_menu_id = user_access_menu.sub_menu_id','left');
    $ci->db->where('url', $nama_menu);
    $ci->db->where('level_id', $user_session);
    if ($access !=null){
        $ci->db->where($access,1);
    }
    $query = $ci->db->get();
    if ($query->num_rows() < 1 ) {
     redirect('not_access');
    }    
}

//is_allowed_button
function is_allowed_button($nama_menu, $access=null){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    $user_session = $ci->fungsi->user_login()->level_id;
    $ci->db->select('user_access_menu.*,sub_menu.url');
    $ci->db->from('user_access_menu');
    $ci->db->join('sub_menu', 'sub_menu.sub_menu_id = user_access_menu.sub_menu_id','left');
    $ci->db->where('url', $nama_menu);
    $ci->db->where('level_id', $user_session);
    if ($access !=null){
        $ci->db->where($access,1);
    }
    $query = $ci->db->get();
    $hasil = $query->num_rows();
    return $hasil;

}



