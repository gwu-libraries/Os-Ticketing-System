<?php

require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
session_start();
date_default_timezone_set("UTC");
mysql_connect("localhost","root","sql4gwdroid") or die('cannot connect to databse because:' . mysql_error());
mysql_select_db("osticket");
$ob_file;
//if(isset($todo) and $todo=="submit")
//{
	$smonth=$_POST['smonth'];
	$sdt=$_POST['sday'];
	$syear=$_POST['syear'];
	$sdate_value="$smonth/$sdt/$syear";
	echo "<br><br>";
	//echo "mm/dd/yyyy format :$sdate_value<br>";
	$sdate_value="$syear-$smonth-$sdt";
	//echo "YYYY-mm-dd format :$sdate_value<br>";
	$emonth=$_POST['emonth'];
	$edt=$_POST['eday'];
	$eyear=$_POST['eyear'];
	$edate_value="$eyear-$emonth-$edt";
	echo "<br><br>";
	$i=0;
	foreach($_POST['column'] as $field)
	{
		$fields[$i]=$field;
		$i++;
	}
	$i=0;
	foreach($_POST['groups'] as $group)
	{
		$groups[$i]=$group;
		$i++;
	}
	$i=0;
	foreach($_POST['sorts'] as $sort)
	{
		$sorts[$i]=$sort;
		$i++;
	}	
	//build select statement
	$sql='Select ';
	$department=false;
	$staff=false;
	$ticket=false;
	if(count(fields)>0)
	{	
	for($i=0;$i<(count($fields));$i++)
	{
		if($i!=(count($fields)-1))
		{
			if(strcmp($fields[$i],'firstname')==0)
			{
				$sql .= "s.firstname,";
				$staff=true;
			}
			elseif(strcmp($fields[$i],'lastname')==0)
			{
                		$sql .= 's.lastname,';
				$staff=true;
			}
			elseif(strcmp($fields[$i],'dept_name')==0)
			{
                		$sql .= 'd.dept_name,';
				$department=true;
			}
			else
			{
				$sql .='t.'.$fields[$i].',';
				$ticket=true;
			}
		}
		else
		{
			 if(strcmp($fields[$i],'firstname')==0)
                        {
                                $sql .= 's.firstname';
                                $staff=true;
                        }
                        elseif(strcmp($fields[$i],'lastname')==0)
                        {
                                $sql .= 's.lastname';
                                $staff=true;
                        }
                        elseif(strcmp($fields[$i],'dept_name')==0)
                        {       
                                $sql .= 'd.dept_name';
                                $department=true;
                        }
                        else
                        {
                                $sql .='t.'.$fields[$i];
                                $ticket=true;
                        }

		}
		

	}	
	}	
	$sql .= ' from ';
	if($ticket && !$department && !$staff)
	{
		$sql .= 'ost_ticket t ';
	}	
	elseif ($ticket && $department && !$staff)
	{
		$sql .= 'ost_ticket t join ost_department d on t.dept_id=d.dept_id ';
	}
	elseif($ticket && !$department && $staff)
	{
		$sql .= 'ost_ticket t join ost_staff s on t.staff_id=s.staff_id ';
	}
	elseif(!$ticket && $department && !$staff)
	{
		$sql .= 'ost_department d ';
	}
	elseif(!$ticket && !$department && $staff)
	{
		$sql .= 'ost_staff s ';
	}
	elseif(!$ticket && $department && $staff)
	{
		$sql .= 'ost_department d join ost_staff on d.dept_id=s.dept_id ';
	}
	else
	{
		$sql .= 'ost_ticket t join ost_department d on t.dept_id=d.dept_id join ost_staff s on t.staff_id=s.staff_id ';
	}
	if(count($groups)!=0)
	{
		$sql .= 'group by ';
		for($i=0;$i<count($groups);$i++)
		{
			if($i!=(count($groups)-1))
			{
			 	if(strcmp($groups[$i],'firstname')==0)
                		{
                        		$sql .= 's.firstname,';
                		}
                		elseif(strcmp($groups[$i],'lastname')==0)
                		{
                        		$sql .= 's.lastname,';
                       
                		}
                		elseif(strcmp($groups[$i],'dept_name')==0)
                		{
                        		$sql .= 'd.dept_name,';
                        
                		}
                		else
                		{
                        		$sql .='t.'.$groups[$i].',';
                       
                		}
			}
			else
			{
				if(strcmp($groups[$i],'firstname')==0)
                                {       
                                        $sql .= 's.firstname';
                                }
                                elseif(strcmp($groups[$i],'lastname')==0)
                                {
                                        $sql .= 's.lastname';

                                }
                                elseif(strcmp($groups[$i],'dept_name')==0)
                                {
                                        $sql .= 'd.dept_name';

                                }
                                else
                                {
                                        $sql .='t.'.$groups[$i];

                                }

			}
		
		}
	}
	if(count($sorts)!=0)
	{
		$sql .= ' order by ';
		for($i=0;$i<count($sorts);$i++)
                {
                        if($i!=(count($sorts)-1))
			{ 
				if(strcmp($sorts[$i],'firstname')==0)
                        	{
                        		$sql .= 's.firstname,';
                        	}
                        	elseif(strcmp($sorts[$i],'lastname')==0)
                        	{
                                	$sql .= 's.lastname,';
                        
                       	 	}
                        	elseif(strcmp($sorts[$i],'dept_name')==0)
                        	{
                                	$sql .= 'd.dept_name,';
                        
                        	}
                        	else
                        	{
                        		$sql .='t.'.$sorts[$i].',';
                        
                        	}
		
			}
			else
			{
                                if(strcmp($sorts[$i],'firstname')==0)
                                {
                                        $sql .= 's.firstname';
                                }
                                elseif(strcmp($sorts[$i],'lastname')==0)
                                {       
                                        $sql .= 's.lastname';

                                }
                                elseif(strcmp($sorts[$i],'dept_name')==0)
                                {
                                        $sql .= 'd.dept_name';

                                }
                                else
                                {
                                        $sql .='t.'.$sorts[$i];
                        
                                }       

                        }


                }

	}
	if(strcmp($_POST['dept'],'All')!=0)
	{
		$sql .= " where d.department_name=d.".$_POST['dept']; 
	}
	$result=mysql_query($sql);		
	if(strcmp($_POST['Format'],"Online")==0)
	{
		echo "<Table>";
        	echo "<tr><td><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></td></tr>";
        	echo "</Table>";

        	echo "<table width='100%' border='0' cellspacing='1' cellpadding='2' class='dtable'>";
         //echo "<tr><td><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></td></tr>";
        	echo "<tr></tr><tr></tr>";
		//echo "<tr>".$sql."</tr>";

        //echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
        //echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
        //echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        	echo "<tr>";
	 	for($i=0;$i<(count($fields));$i++)
        	{
			echo "<td>". $fields[$i]."</td>";
		}
		echo "</tr>";
		
		while($row=mysql_fetch_array($result))
		{
			echo "<tr>";
			for($i=0;$i<count($fields);$i++)
                	{
				
				echo "<td>" . $row[$fields[$i]]. "</td>";
			}
			echo "</tr>";

		}
		echo "</table>";
	}
	elseif(strcmp($_POST['Format'],"Pdf")==0)
	{
		$filename='/tmp/file'.rand(5, 1000).'.pdf';
		$_SESSION['filename']=$filename;
		$html="<page>";
		$html .= "<P>Report from" .  $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear']."</p>";
		$html .= "<table><tr>";
		for($i=0;$i<(count($fields));$i++)
                {
                        $html .= "<td>". $fields[$i]."</td>";
                }
			$html .= "</tr>";
		 while($row=mysql_fetch_array($result))
                {
                        $html .= "<tr>";
                        for($i=0;$i<count($fields);$i++)
                        {

                                $html .= "<td>" . $row[$fields[$i]]. "</td>";
                        }
                        $html .= "</tr>";

                }
		$html .= "</table></page>";
		$html2pdf = new HTML2PDF('P','A4','en');
    		$html2pdf->WriteHTML($html);
		$html2pdf->Output($filename,'F');
                header("Location: http://gwdroid.wrlc.org/support/scp/admin.php?t=file");
	
	
	}
	elseif(strcmp($_POST['Format'],"Excel")==0)
	{
		$filename='/tmp/file'.rand(5, 1000).'.csv';
		$ob_file = fopen($filename,'w');
		ob_start('ob_file_callback');
		echo "Report from" .  $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] ."\n";
		echo "\n";
		for($i=0;$i<(count($fields));$i++)
                {
			if($i!=(count($fields)-1))
                        {
				echo $fields[$i]." ,";
			}
			 else
                        {
                         	echo $fields[$i];
                        }

                }
 		echo "\n";
		 while($row=mysql_fetch_array($result))
                {
                        for($i=0;$i<count($fields);$i++)
                        {
				if($i!=(count($fields)-1))
				{
                                	echo $row[$fields[$i]]. " ,";
				}
				else
				{
					echo $row[$fields[$i]];
				}
                        }
                        echo "\n";

                }
		ob_end_flush();
		$_SESSION['filename']=$filename;
		header("Location: http://gwdroid.wrlc.org/support/scp/admin.php?t=file");

	}
	function ob_file_callback($buf)
	{
  	global $ob_file;
  	fwrite($ob_file,$buf);
	}
//}


?>
