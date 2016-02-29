<?php
	
	class Feedsync_Installer {
			
		function Feedsync_Installer() {
		
			$this->view = VIEW_PATH.'installer.php';
		}
		
		function print_view() {
			ob_start();
			include($this->view);
			return ob_get_clean();
		}
			
	}
	

