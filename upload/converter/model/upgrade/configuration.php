<?php
class ModelUpgradeConfiguration extends Model{
    private $lang;
   public function editConfig( $data ){
       $this->lang = $this->lmodel->get('upgrade_configuration');
       $this->simulate = ( !empty( $data['simulate'] ) ? true : false );
       $this->dirAdmin = ( !empty( $data['dirAdmin'] ) ? true : 'admin' ) .'/';
       $this->dirImage =  ( !empty( $data['dirImage'] ) ? true : 'image' ) . '/';
       $this->dirOld = ( !empty( $data['dirOld'] ) ? true : false );
       $this->showOps  = ( !empty( $data['showOps'] ) ? true : false );
       $this->upgrade2030  = ( !empty( $data['upgrade2030'] ) ? true : false );
    
        $text = '';

		$modification = 'define(\'DIR_MODIFICATION\', \'' . DIR_MODIFICATION . '\'); // OC 2';
		$upload = 'define(\'DIR_UPLOAD\', \'' . DIR_UPLOAD . '\'); // OC 2';

                $server = $_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['SCRIPT_NAME']));
                $server = explode('/',$server);
                array_pop($server);
                $server = implode('/',$server);
                
		$http_server = 'define(\'HTTP_SERVER\', \'http://' . $server . '/\'); // OC 1.4+';
		$https_server = 'define(\'HTTPS_SERVER\', \'https://' .$server . '/\'); // OC 1.4+';
		$https_catalog = 'define(\'HTTPS_CATALOG\', \'https://' .$server . '/\'); // OC 1.4+';
		$db_port = 'define(\'DB_PORT\', \'3306\'); // OC 2 +';

		// frontend
	    $content = file_get_contents( DIR_DOCUMENT_ROOT . 'config.php' );
            $check = $content;
	    if( $this->dirOld ) {
	    	if( strpos( $content, $this->dirOld ) !== false ) {
		    	$content = str_replace( $this->dirOld, $root, $content );
                      
		    	file_put_contents( $root . 'config.php', $content );
				$text .= $this->msg( sprintf(  $this->lang, 'config_replace',  'config.php', '' ) );
			}
	    }

	
		if( !strpos( $content, 'DIR_UPLOAD' ) || $this->upgrade2030 &&  !strpos( $content, 'DB_PORT' ) ) {

			$fp = file( DIR_DOCUMENT_ROOT . 'config.php' );

		   if( !strpos( $content, 'HTTP_SERVER' ) ) {
			  array_splice( $fp, 1, 0, $http_server . "\r\n" );
			  array_splice( $fp, 2, 0, $https_server . "\r\n" );
		   }
	   	  if( !strpos( $content, 'DIR_UPLOAD' ) ) {
			array_splice( $fp, 18, 0, $modification . "\r\n" );
			array_splice( $fp, 19, 0, $upload . "\r\n" );
		   }
		   if($this->upgrade2030 &&  !strpos( $content, 'DB_PORT' )) {
			  array_splice( $fp, 20, 0, $db_port . "\r\n" );
		   }

			$content = implode( '', $fp );

			if( is_writable( DIR_DOCUMENT_ROOT . 'config.php' ) ) {
				if( !$this->simulate ) {
					$fw = fopen( DIR_DOCUMENT_ROOT . 'config.php', 'wb' );
					fwrite( $fw, $content );
					fclose( $fw );
				}

		               if( !strpos( $check, 'HTTP_SERVER' ) ) {
			        	$text .= $this->msg( sprintf(  $this->lang['msg_config_added'],  'HTTP_SERVER', 'config.php' ) );
				        $text .= $this->msg( sprintf(  $this->lang['msg_config_added'],  'HTTPS_SERVER', 'config.php' ) );
		                }
				$text .= $this->msg( sprintf(  $this->lang['msg_config_added'],  'DIR_UPLOAD', 'config.php' ) );
				$text .= $this->msg( sprintf(  $this->lang['msg_config_added'],  'DIR_MODIFICATION', 'config.php' ) );
			}else{
				$text .= $this->msg(  sprintf( $this->lang, 'msg_perm_file', 'config.php' ) );
			}
		}else{
			$text .= $this->msg( sprintf(  $this->lang['msg_config_uptodate'], 'config.php', '' ) );
		}

		// backend
		$file		= $this->dirAdmin . '/config.php';
		$content	= file_get_contents( DIR_DOCUMENT_ROOT . $file );

		if( $this->dirOld ) {
			if( strpos( $content, $this->dirOld ) !== false ) {
		    	$content = str_replace( $this->dirOld, $root, $content );
			if( !$this->simulate ) {
		    	   file_put_contents( DIR_DOCUMENT_ROOT . $file, $content );
                        }
		    	 $text .= $this->msg( sprintf(  $this->lang['msg_config_replace'], 'config.php', '' ) );
			}
	    }

		if( !strpos( $content, 'DIR_UPLOAD' ) ) {
			$fp2 = file( DIR_DOCUMENT_ROOT . $file );
		    if( !strpos( $content, 'HTTPS_CATALOG' ) ) {
			  array_splice( $fp, 8, 0, $https_catalog . "\r\n" );
		   }
			array_splice( $fp2, 21, 0, $modification . "\r\n" );
			array_splice( $fp2, 22, 0, $upload . "\r\n" );
		    if( $this->upgrade2030 &&  !strpos( $content, 'DB_PORT' )) {
			  array_splice( $fp, 25, 0, $db_port . "\r\n" );
		   }

			$content = implode( '', $fp2 );

			if( is_writable( DIR_DOCUMENT_ROOT. $file ) ) {
				if( !$this->simulate ) {
					$fw = fopen( DIR_DOCUMENT_ROOT . $file, 'wb' );
					fwrite( $fw, $content );
					fclose( $fw );
				}

		    if( !strpos( $check, 'HTTPS_CATALOG' ) ) {
				$text .= $this->msg( sprintf(  $this->lang['msg_config_added'],  'HTTPS_CATALOG', 'config.php' ) );
		   }
				$text .= $this->msg( sprintf(  $this->lang['msg_config_constant'], 'DIR_UPLOAD', $file ) );
				$text .= $this->msg( sprintf(  $this->lang['msg_config_constant'], 'DIR_MODIFICATION', $file ) );
			}else{
				$text .= $this->msg(  sprintf( $this->lang['msg_perm_file'], 'config.php', $file ) );
			}
		}else{
			$text .= $this->msg( sprintf(  $this->lang['msg_config_uptodate'], $file, '' ) );
		}

	return $text;
   }
  public function msg( $data ){
       return str_replace( $data, '<div class="msg round">' . $data .'</div>', $data);
  }
}
