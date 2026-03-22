<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission
{
	private static $_CI;

	public function __construct()
	{
		self::$_CI =& get_instance();
		self::$_CI->load->database();
	}

	public static function grant($uri)
	{

        $ci =& get_instance();
        // sess()['type_user'];
        if (sess()['type_user'] =='super') {
            $permissions = $ci->Mod->getWhere('menu',array('parent' => '-1','status !=' =>8 ))->result_array();
        }else{
            $permissions = $ci->Mod->GetCustome("SELECT a.*,b.* FROM role_akses a left join menu b on b.idmenu= a.id_menu where a.id_role = '".sess()['type_user']."' and (a.create = 1 or a.read = 1 or a.update =1 or a.delete = 1)")->result_array();
        }
        // echo "<pre>",print_r ($permissions),"</pre>";
		$match = false;
	
    	//  = self::$_CI->db->join('permission_user', 'permissions.id = permission_user.permission_id')
        //               ->join('users', 'users.id = permission_user.user_id')
        //               ->where('permission_user.user_id', $user_id)
        //               ->get('permissions')
        //               ->result();

        foreach($permissions as $permission) {
            if($permission['url'] != "*") {
                 $re_uri =$permission['url'];
                $match = preg_match("/{$re_uri}/", $uri);
            }

            if($permission['url'] == "*" || $uri == 'home') {
                return;
            } else {
                $match = (!$match) ? $match : true;
            }

            // if found true
            if($match) {
                return;
            }
        }

        // if all false
        if(!$match) {
        	// self::$_CI->session->set_flashdata('err', 'You don\'t have permission.');
          
            return redirect('dash');
        }
	}

	public function __destruct()
	{
		self::$_CI->db->close();
	}
}
