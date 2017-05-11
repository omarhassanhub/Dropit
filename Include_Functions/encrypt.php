<?php 
Class Cryptography
{
	function Encrypt($source, $destination)	{
		$key="passwordDR0wSS@P6660juht";
        $iv="password";

		if (extension_loaded('mcrypt') === true)
		{
			if (is_file($source) === true)
			{
				$source = file_get_contents($source);
				$encryptedSource=$this->TripleDesEncrypt($source,$key,$iv);
				if (file_put_contents($destination,$encryptedSource, LOCK_EX) !== false)
				{
					return true;
				}
				return false;
			}
			return false;
		}

		return false;
	}

	function Decrypt($source, $destination) {
		$key="passwordDR0wSS@P6660juht";
		$iv="password";
		if (extension_loaded('mcrypt') === true)
		{
			if (is_file($source) === true)
			{
				$source = file_get_contents($source);
    			$decryptedSource=self::TripleDesDecrypt($source,$key,$iv);
				if (file_put_contents($destination,$decryptedSource, LOCK_EX) !== false)
				{
					return true;
				}
				echo "no read";
				return false;
			}
			echo "no file";
			return false;
		}
			echo "no mcrypt";

		return false;
	}

	function TripleDesEncrypt($buffer,$key,$iv) {

			$cipher = mcrypt_module_open(MCRYPT_3DES, '', 'cbc', '');
			$buffer.='___EOT';

			$extra = 8 - (strlen($buffer) % 8);

			if($extra > 0) {
			for($i = 0; $i < $extra; $i++) {
				$buffer .= '_';
				}
			}
	     	 mcrypt_generic_init($cipher, $key, $iv);
		 $result = mcrypt_generic($cipher, $buffer);
		 mcrypt_generic_deinit($cipher);
		return base64_encode($result);
	}

	function TripleDesDecrypt($buffer,$key,$iv) {
	
		   $buffer= base64_decode($buffer);
		   $cipher = mcrypt_module_open(MCRYPT_3DES, '', 'cbc', '');
		   mcrypt_generic_init($cipher, $key, $iv);
		   $result = mdecrypt_generic($cipher,$buffer);
	        $result=substr($result,0,strpos($result,'___EOT'));
	   	   mcrypt_generic_deinit($cipher);
	 	  return $result;
	}
}


session_start();

$fileName   = $_GET['encrypt'];
$pathOfFile = '../' . $_SESSION['Directory'] . '/' . $_SESSION['fullPath'] . '/' . $fileName;

$obj = new Cryptography();
$obj->Encrypt($pathOfFile,$pathOfFile);

header("location:../dropbox.php");
?>