<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class template {
    
                
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
	
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			$mod = $this->CI->load->model('user/model','users_model');
			$data['menu'] = $this->CI->users_model->get_menu($this->CI->access->get_level());
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			return $this->CI->load->view($template, $this->template_data, $return);
		}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */