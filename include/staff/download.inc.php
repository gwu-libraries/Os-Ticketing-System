<?php
	session_start();
	//$filename = $_SESSION['filename'].'.csv';
	$filename = $_SESSION['filename'];
	echo $filename;
	$err = '<p style=color:#990000>Sorry, the file you are requesting is unavailable.</p>';
	if (!$filename) {
		// if variable $filename is NULL or false display the message
		echo "<p style=color:red>Sorry, the file you are requesting is unavailable</p>";
	} else {
		// define the path to your download folder plus assign the file name
		ob_end_flush();
		//$path = '/tmp/'.$filename;
		if (file_exists($filename) && is_readable($filename)) {
			// get the file size and send the http headers
			$size = filesize($filename);
			header('Content-Type: text/csv');
			//header('Content-Length: '.$size);
			header('Content-Disposition: attachment; filename='.$filename);
			//header('Content-Transfer-Encoding: ASCII');
			 //header("Content-length: $fsize");
    //header("Cache-control: private"); //use this to open files directly
			$data='';
			$fd = fopen ($path, "r");
    			while(!feof($fd)) {
        			$data = fread($fd, 2048);
				$a=strip_tags($data);
        			echo $a;
    					}
							}
				fclose ($fd);
				//readfile($path);
				unlink($filename);
				//header("location: http://gwdroid.wrlc.org/support/scp/admin.php?t=tests");
				//exit;
	}
?>
