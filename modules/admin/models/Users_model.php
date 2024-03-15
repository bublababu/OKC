<?php 

class Users_model extends CI_Model {

        //GET DISPLAIED DATA
	public function get_usersList($limit,$offset,$role="",$search="",$status="")
	{     
                          
                if($role!="" && $role!="all")
                {
                        $this->db->where('role.role_name',$role); 
                }
                if($status!="all" && $status!="" )
                {
                        $this->db->where('user.state',$status);     
                }
                if($search!="")
                {
                        $this->db->group_start();
                        $this->db->like('first_name', $search);
                        $this->db->or_like('last_name', $search);
                        $this->db->or_like("CONCAT( first_name,  ' ', last_name )", $search);
                        $this->db->or_like('email', $search);
                        $this->db->or_like('phone', $search);
                        $this->db->or_like('badge', $search);
                        $this->db->group_end();                       
                }   
                $this->db->select('user.*');
                $this->db->from('user');
                $this->db->join('users_roles', 'users_roles.user_id = user.user_id');
                if($role!="" && $role!="all")
                {
                $this->db->join('role', '`users_roles`.`role_id`= (SELECT `role`.`role_id` FROM role WHERE role.role_name LIKE "%'.$role.'%")');
                }
                $this->db->distinct();
                $this->db->order_by('last_name','asc');
                $this->db->limit($limit,$offset);    
                $query = $this->db->get();
                return $query->result_array(); 
	}
        ////GET DISPLAIED DATA
        //NUMBER OF ROW FUNCTION
        public function num_rows($role="",$search="",$status="")
        {
                if($role!="" && $role!="all")
                {
                        $this->db->where('role.role_name',$role); 
                }
                if($status!="all" && $status!="" )
                {
                        $this->db->where('user.state',$status);     
                }
                if($search!="")
                {
                        $this->db->group_start();
                        $this->db->like('first_name', $search);
                        $this->db->or_like('last_name', $search);
                        $this->db->or_like("CONCAT( first_name,  ' ', last_name )", $search);
                        $this->db->or_like('email', $search);
                        $this->db->or_like('phone', $search);
                        $this->db->or_like('badge', $search);
                        $this->db->group_end();                       
                }   
                $this->db->select('user.*');
                $this->db->from('user');
                $this->db->join('users_roles', 'users_roles.user_id = user.user_id');
                if($role!="" && $role!="all")
                {
                $this->db->join('role', '`users_roles`.`role_id`= (SELECT `role`.`role_id` FROM role WHERE role.role_name LIKE "%'.$role.'%")');
                }
                $this->db->distinct();
                $this->db->order_by('last_name','asc');                    
                $query = $this->db->get();
                return $query->num_rows(); 
        }
        ////NUMBER OF ROW FUNCTION

        public function member_list()
        {
                $this->db->order_by('first_name', 'asc');
                //$this->db->where('state', '1');
                $query = $this->db->get('user');                
                return $query->result_array(); 
        }
}
?>