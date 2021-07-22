 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {
    public function login ($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username',$post['username']);
        $this->db->where('password',sha1($post['password']));
        $query=$this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->select('user.*,level.nama_level');
        $this->db->from('user');
        $this->db->join('level', 'level.level_id = user.level_id');
        if ($id !=null){
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }



    public function addHistory($user_id, $info, $user_agent) {
        return $this->db->insert('history_login', array('user_id' => $user_id, 'info' => $info,'user_agent' =>$user_agent));
    }

    public function ubah_data($data,$id){
        $this->db->where('user_id',$id);
        $this->db->update ('user',$data);
    }

    public function user_token($user_token){
        $this->db->insert('user_token',$user_token);
    }

}