<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class site_library
{
    // Public properties
    public $settings = array();
    // Protected or private properties
    protected $_table;
    
    // Constructor
    public function __construct()
    {
        if (!isset($this->CI))
        {
            $this->CI =& get_instance();
        }
        $this->CI->load->library('user_agent');
        $this->get_site_info();
		
		//$this->CI->load->helper('language');
		// load language file
        //$this->CI->lang->load('en');
 
    }
	
    public function load($page, $data = NULL,$layout=FALSE)
    {
		$data['page'] = $page;
		
		// SEO meta
		//$data['meta'] = $this->get_meta_tag() ;
		//$data['meta'] = !empty($data['meta']) ? $data['meta'] : $this->get_default_meta() ;
		
		// chia data theo 2 mien
		$town = $this->CI->session->userdata("town") ;
		$data['town'] = ($town!==false) ?  (int)$town : 0 ;
		
		// load template
		if($layout==TRUE){
			$this->CI->load->view('html/skin_'.$layout, $data);
		}else{
			$this->CI->load->view('html/skin', $data);
		}        
    }

	// Phan danh cho SEO meta
	function get_meta_tag()
	{
		$url = isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : $_SERVER["REQUEST_URI"];
		$uri = explode("/", $url) ;
		
		$id = (int) str_replace(".html","", end($uri)) ;
		
		if(strpos($url, 'category') > 0 )
		{
			$this->CI->db->where("proid",$id) ;
			$this->CI->db->where("kind",'category') ;
			$query = $this->CI->db->get("seo");
		}
		else if (strpos($url, 'product') > 0)
		{ 
			$this->CI->db->where("proid",$id) ;
			$this->CI->db->where("kind",'product') ;
			$query = $this->CI->db->get("seo");
		}
		else
		{
			$this->CI->db->where("sid", 1) ;
			$query = $this->CI->db->get("seo");
		}
		
		return $query->row() ;
		
	}
	function get_default_meta()
	{
		$this->CI->db->where("sid", 1) ;
		$query = $this->CI->db->get("seo");
		return $query->row() ;
	}
	// Phan danh cho admin
    public function loadadmin($page, $data = NULL)
	{
        $data['page'] = $page;
        $this->CI->load->view('theme/admin/vnit/skin', $data);        
    }
	
    // Get Templates Active
    public function get_default_template()
    {
        $this->CI->db->select('duongdan');
        $this->CI->db->where('kichhoat', '1');
        
        $query = $this->CI->db->get('giaodien', 1);
        
        if ($query->num_rows() == 1)
        {
            $row = $query->row_array();
        }
        
        return $row['duongdan'];
    }
    
    public function get_default_language()
    {
        $this->CI->db->select('language');
        $this->CI->db->where('is_default', '1');
        
        $query = $this->CI->db->get($this->_table['languages'], 1);
        
        if ($query->num_rows() == 1)
        {
            $row = $query->row_array();
        }
        
        return $row['language'];
    }
    
    public function get_site_info()
    {
        /*
        $this->CI->db->select('name, value');
        
        $query = $this->CI->db->get($this->_table['settings']);
        
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();

            foreach ($result as $row)
            {
                $this->settings[$row['name']] = $row['value'];
            }
        }
        */
    }
    
    public function check_site_status()
    {
        /*
        $this->CI->db->select('name, value');
        $this->CI->db->where('name', 'enabled');
        
        $query = $this->CI->db->get($this->_table['settings'], 1);
        
        if ($query->num_rows() == 1)
        {
            $result = $query->row_array();
            
            if ($result['value'] == 0)
            {
                $data['offline_reason'] = $this->settings['offline_reason'];
                
                $this->CI->load->view('admin/layout/pages/offline', $data);
                die();
            }
        }
        */
    }
    
    public function generate_social_bookmarking_links($post_url, $post_title)
    {
        /*
        $links = '';
        
        if ($this->settings['enable_digg'] == 1)
        {
            $links = '<a href="http://digg.com/submit?phase=2&amp;url=' . $post_url . '&amp;title=' . $post_title . '" target="_blank">Digg</a>';
        }
        
        if ($this->settings['enable_technorati'] == 1)
        {
            $links .= ($links) ?  ' | ' : '';
            $links .= '<a href="http://technorati.com/faves?add=' . $post_url . '" target="_blank">Technorati</a>';
        }
        
        if ($this->settings['enable_delicious'] == 1)
        {
            $links .= ($links) ?  ' | ' : '';
            $links .= '<a href="http://del.icio.us/post?url=' . $post_url . '&amp;title=' . $post_title . '" target="_blank">del.icio.us</a>';
        }
        
        if ($this->settings['enable_stumbleupon'] == 1)
        {
            $links .= ($links) ?  ' | ' : '';
            $links .= '<a href="http://www.stumbleupon.com/submit?url=' . $post_url . '&amp;title=' . $post_title . '" target="_blank">Stumbleupon</a>';
        }
        
        if ($this->settings['enable_reddit'] == 1)
        {
            $links .= ($links) ?  ' | ' : '';
            $links .= '<a href="http://reddit.com/submit?url=' . $post_url . '&amp;title=' . $post_title . '" target="_blank">reddit</a>';
        }
        
        if ($this->settings['enable_furl'] == 1)
        {
            $links .= ($links) ?  ' | ' : '';
            $links .= '<a href="http://www.furl.net/storeIt.jsp?t=' . $post_title . '&amp;u=' . $post_url . '" target="_blank">Furl</a>';
        }
        
        return $links;
        */
    }
    
}
?>