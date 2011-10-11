<?php
	session_start();
	$filename = $_SESSION['filename'];
	$index=strpos($filename,'.');
	$ext=substr($filename,$index);
	//echo $ext;
	$err = '<p style="color:#990000">Sorry, the file you are requesting is unavailable.</p>';
	if (!$filename) 
	{
		// if variable $filename is NULL or false display the message
		echo $err;
	} 
	/*elseif(strcmp($_SESSION['request'],"File")==0) {
		// define the path to your download folder plus assign the file name
		//ob_end_flush();
		if(strcmp($_SESSION['request'],"File")==0)
		{
		$filename.='.csv';
		}*/
	
		$path = $filename;
		if(strcmp($ext,'.csv')==0)
		{
			if (file_exists($path) && is_readable($path)) 
			{
			// get the file size and send the http headers
			$size = filesize($path);
			header('Content-Type: application/vnd.ms-excel');
			//header('Content-Length: '.$size);
			header('Content-Disposition: attachment; filename='.$filename);
			//header('Content-Transfer-Encoding: ASCII');
			 //header("Content-length: $fsize");
    //header("Cache-control: private"); //use this to open files directly
			$data='';
			$fd = fopen ($path, "r");
    			while(!feof($fd)) 
			{
        			$data = fread($fd, 2048);
				//$a=strip_tags($data);
        			echo $data;
    			}
							
			fclose ($fd);
				//readfile($path);
			unlink($path);
				//header("location: http://gwdroid.wrlc.org/support/scp/admin.php?t=tests");
				//exit;
			}
		}
		else
		{
			if (file_exists($path) && is_readable($path))
                        {
                        // get the file size and send the http headers
                        $size = filesize($path);
                        header('Content-Type: application/pdf');
                        //header('Content-Length: '.$size);
                        header('Content-Disposition: attachment; filename='.$filename);
                        //header('Content-Transfer-Encoding: ASCII');
                         //header("Content-length: $fsize");
    //header("Cache-control: private"); //use this to open files directly
                        $data='';
                        $fd = fopen ($path, "r");
                        while(!feof($fd))
                        {
                                $data = fread($fd, 2048);
                                //$a=strip_tags($data);
                                echo $data;
                        }

                        fclose ($fd);
                                //readfile($path);
                        unlink($path);
                                //header("location: http://gwdroid.wrlc.org/support/scp/admin.php?t=tests");
                                //exit;
                        }

		}
	 /*elseif(strcmp($_SESSION['request'],"Excel")==0) {
                // define the path to your download folder plus assign the file name
                //ob_end_flush();
	$filename.='.xls';
                $path = '/tmp/'.$filename;
                if (file_exists($path) && is_readable($path)) {
                        // get the file size and send the http headers
                        $size = filesize($path);
                        header('Content-Type: application/vnd.ms-excel');
                        //header('Content-Length: '.$size);
                        header('Content-Disposition: attachment; filename='.$filename);
                        //header('Content-Transfer-Encoding: ASCII');
                         //header("Content-length: $fsize");
    //header("Cache-control: private"); //use this to open files directly
                        $data='';
                        $fd = fopen ($path, "r");
                        while(!feof($fd)) {
                                $data = fread($fd, 2048);
                                //$a=strip_tags($data);
                                echo $data;
                                        }
                                                        }
                                fclose ($fd);
                                //readfile($path);
                                unlink($path);
                                //header("location: http://gwdroid.wrlc.org/support/scp/admin.php?t=tests");
                                //exit;
        }*/

?>
