<?php
class Auth_model extends  CI_Model{
    public function get_webuser_auth($doc_no)
    {
        $this->db->where('email', $doc_no);
        $query = $this->db->get('web_users');

        if($query->num_rows() > 0)
        {
            return $query->row();
        }

        else
        {
            return false;
        }
    }


}