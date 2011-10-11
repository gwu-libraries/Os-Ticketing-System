<?php
session_start();
date_default_timezone_set("UTC");
mysql_connect("localhost","root","sql4gwdroid") or die('cannot connect to databse because:' . mysql_error());
mysql_select_db("osticket");

$filename='tmp'.rand(5, 1000);
$_SESSION['filename']=$filename;
$selected_radio=$_SESSION['type'];
$dept=$_SESSION['dept'];
$eday=$_SESSION['eday'];
$emonth=$_SESSION['emonth'];
$eyear=$_SESSION['eyear'];
$smonth=$_SESSION['smonth'];
$syear=$_SESSION['syear'];
$sday=$_SESSION['sday'];
$_SESSION['request']="File";
$ob_file = fopen('/tmp/'.$filename.'.csv','w');
 ob_start('ob_file_callback');
if(strcmp($selected_radio,"Source")==0)
{
	if(strcmp($dept,"All")==0)
        {
		$query = mysql_query("select d.dept_name, t.source,COUNT(t.source) from ost_ticket t join ost_department d on t.dept_id=d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by t.source, d.dept_name order by dept_name"); 
	}
	else	
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
        	$row=mysql_fetch_array($result);
        	$deptid=$row['dept_id'];
		 $query = mysql_query("select d.dept_name,t.source,COUNT(t.source) from ost_ticket t join ost_department d on t.dept_id= d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' AND d.dept_id=$deptid group by t.source, d.dept_name order by dept_name");
	}
	//echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>"; 
	echo "Report from " . $smonth. "-" . $sday . "-" . $syear . " to " . $emonth . "-" . $eday . "-" . $eyear ;
	//echo ;
	echo "\n";  
	echo " Department";
	echo ", Source";
	echo ", Number of Requests";
	echo "\n";


while($row=mysql_fetch_array($query))
{
	
	echo "" . $row['dept_name'];
	echo ", " . $row['source'] ;
	echo ", " . $row['COUNT(t.source)'];
	echo "\n";
}
}
else if(strcmp($selected_radio,"User")==0)
{
	if(strcmp($dept,"All")==0)
	{
 	$query = mysql_query("select d.dept_name, t.issue_type,COUNT(t.issue_type) from ost_ticket t join ost_department d on t.dept_id = d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by t.issue_type,d.dept_name order by d.dept_name");
	}

	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
		$row=mysql_fetch_array($result);
		$deptid=$row['dept_id'];
	//echo $deptid;
	$query = mysql_query("select d.dept_name, t.issue_type,COUNT(t.issue_type) from ost_ticket t join ost_department d on t.dept_id=d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' AND d.dept_id=$deptid group by t.issue_type,d.dept_name order by d.dept_name");
	}
        //echo "<table width='100%' border='0' cellspacing='1' cellpadding='1'>";
	//echo "<tr> <td> Department ID and name ". $dept . " " . $deptid . "</td><tr>";
	 //echo "Report for the period from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] ;
        echo "Report from " . $smonth. "-" . $sday . "-" . $syear . " to " . $emonth . "-" . $eday . "-" . $eyear ;
 
	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        echo "\n";
	echo " Department";
        echo ", User";
        echo ", Number of Requests";
        echo "\n";
	while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	echo "" . $row['dept_name'] ;
        echo ", " . $row['issue_type'];
        echo ", ".  $row['COUNT(t.issue_type)'];
        echo "\n";
}


}
else if(strcmp($selected_radio,"Problem")==0)
{
        //echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
	 //echo "Report for the period from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] ;
        echo "Report from " . $smonth. "-" . $sday . "-" . $syear . " to " . $emonth . "-" . $eday . "-" . $eyear ;
	echo "\n";

	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        //echo "\n";
	echo " Ticket";
	echo ", Problem type";	
	echo ", Department";
	echo ", Source";
        echo ", User";
	echo ", Date Opened";
	echo ", Date Closed";
        echo ", Technician";
        echo "\n";
	 if(strcmp($dept,"All")==0)
        {
 		$query = mysql_query("select d.dept_name,t.issue_type,t.helptopic,s.firstname,s.lastname,t.source,t.created,t.closed,t.ticket_id,t.email,t.ticketID from ost_ticket t join ost_department d on t.dept_id= d.dept_id join ost_staff s on t.resolved_by=s.staff_id where t.closed IS NOT NULL  AND  t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' order by t.helptopic");
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
                $row=mysql_fetch_array($result);
                $deptid=$row['dept_id'];
		 $query = mysql_query("select d.dept_name,t.issue_type,t.helptopic,s.firstname,s.lastname,t.source,t.created,t.closed,t.ticket_id,t.email,t.ticketID from ost_ticket t join ost_department d on t.dept_id= d.dept_id join ost_staff s on t.resolved_by=s.staff_id where t.closed IS NOT NULL AND d.dept_id=$deptid AND  t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' order by t.helptopic");
	}
        while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	echo "" . $row['ticketID']; 
        echo ", " . $row['helptopic'];
	echo "," . $row['dept_name'];
	echo "," . $row['source'];
        echo "," .  $row['issue_type'];
	echo "," .  '"'.$row['created'].'"';
	echo "," .  '"'.$row['closed'].'"';
	echo "," .  $row['firstname'] . " " . $row['lastname'];
        echo "\n";
}


}
else if(strcmp($selected_radio,"Tech")==0)
{
        //echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
	 //echo "Report for the period from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] ;
        echo "Report from " . $smonth. "-" . $sday . "-" . $syear . " to " . $emonth . "-" . $eday . "-" . $eyear ;
	//echo "<tr></tr><tr></tr>";
 
	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        echo "\n";
	echo " Department";
	echo ", Technicain First Name";
	echo ", Technicain Last Name";
	echo ", Ticket Count";
        echo ", Problem type";
	echo ", Status";
        //echo "<td>  Ticket Duration  </td>";
        echo "\n";
        //$query = mysql_query("select s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.created,t.closed),COUNT(t.helptopic),t.helptopic from ost_ticket t join ost_staff s on t.staff_id=s.staff_id  where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by t.helptopic") or die(mysql_error()) ;
	//$query = mysql_query("select s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.created,t.closed),t.helptopic,COUNT(s.firstname) from ost_ticket t join ost_staff s on t.staff_id=s.staff_id  where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by s.firstname") or die(mysql_error()) ;
	if(strcmp($dept,"All")==0)
        {
	$query=mysql_query("select d.dept_name,s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.closed,t.created),COUNT(t.helptopic),t.helptopic from ost_ticket t join ost_staff s on t.resolved_by=s.staff_id join ost_department d on s.dept_id=d.dept_id where t.status='closed' and t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday'  group by t.resolved_by order by d.dept_name");
	//echo mysql_num_rows($query);
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
                $row=mysql_fetch_array($result);
                $deptid=$row['dept_id'];
		$query=mysql_query("select d.dept_name,s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.closed,t.created),COUNT(t.helptopic),t.helptopic from ost_ticket t join ost_staff s on t.resolved_by=s.staff_id join ost_department d on s.dept_id=d.dept_id where t.status='closed' and t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' AND d.dept_id=$deptid group by t.resolved_by order by dept_name");

	}
        while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	echo "" . $row['dept_name'];
	echo "," . $row['firstname'];
	echo "," . $row['lastname'];
	echo "," . $row['COUNT(t.helptopic)'];
       	//echo "<td>" . $row['COUNT(t.helptopic)'] . "</td>";
	echo "," . $row['helptopic'];
	echo "," . $row['status'];
	//echo $row['created'];	
	/*if (is_null($row['closed']))
	{
		$now   = date('Y-m-d H:i:s',time());
		$endTime = strtotime($now);
  		$startTime = strtotime($row['created']);
  		$diff = $endTime - $startTime;
  		
		echo $diff;	
		echo "<td>" .    (($diff > 0) ? floor($diff / 86400)+1 : 0) . "</td>";
	}
	else
	{
		echo "<td>" . $row['DATEDIFF(created,closed)'] . "</td>";
	}*/
       
	
        echo "\n";
}


}
else if(strcmp($selected_radio,"Duration")==0)
{
	//echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
	 //echo "Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'];
        echo "Report from " . $smonth. "-" . $sday . "-" . $syear . " to " . $emonth . "-" . $eday . "-" . $eyear ;
	//echo "<tr></tr><tr></tr>";
 
	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        echo "\n";
	echo " Department";
	 echo ", Ticket Count";
	echo ", Ticket Issue";
	//echo "<td>  Assigned to </td>";
	echo ", Ticket Status";
	echo ", Avg. Ticket Duration in Days";
	echo "\n";
	//if(strcmp($))	
	if(strcmp($dept,"All")==0)
        {

	$query = mysql_query("select d.dept_name,Count(t.Ticket_id)  ,t.helptopic, t.created,t.closed,t.status, Avg(DATEDIFF(t.closed,t.created)) from ost_ticket t join ost_department d on t.dept_id=d.dept_id group by t.helptopic,t.status order by d.dept_name  ");
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
                $row=mysql_fetch_array($result);
                $deptid=$row['dept_id'];
		 $query = mysql_query("select d.dept_name,Count(t.Ticket_id)  ,t.helptopic, t.created,t.closed,t.status, Avg(DATEDIFF(t.closed,t.created)) from ost_ticket t join ost_department d on t.dept_id=d.dept_id where d.dept_id=$deptid group by t.helptopic,t.status order by d.dept_name  ");

	}
	while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	echo "" . $row['dept_name'];
	echo "," . $row['Count(t.Ticket_id)'];
	echo "," . $row['helptopic'];
	//echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
	echo "," . $row['status'];
	if (is_null($row['closed']))
        {
                $now   = date('Y-m-d H:i:s',time());
                $endTime = strtotime($now);
                $startTime = strtotime($row['created']);
                $diff = $endTime - $startTime;
                //echo $now . " " . $row['created'];    
                echo "," .    (($diff > 0) ? floor($diff / 86400)+1 : 0) ;
		//echo "<td>" . dateDiff($row['created'],$now) . "</td>";
        }
        else
        {
                echo "," . $row['Avg(DATEDIFF(t.closed,t.created))'] ;
        }
	echo "\n";
}
}
ob_end_flush();
header("Location: http://gwdroid.wrlc.org/support/scp/admin.php?t=file");
//}
//ob_end_flush();
//ob_end_flush();
//if (extension_loaded('zlib')) {//check extension is loaded
//if(!ob_start('ob_gzhandler'))
//ob_start();
//}
//$_SESSION['filename']=$_POST['mytext'];
//header("Location: http://gwdroid.wrlc.org/support/scp/admin.php?t=file");

//}
//echo $_SESSION['filename'];
//ob_end_flush();
//ob_end_flush();
//if (extension_loaded('zlib')) {//check extension is loaded
//if(!ob_start('ob_gzhandler'))
//ob_start();
//}
//$_SESSION['filename']=$_POST['mytext'];
//header("Location: http://gwdroid.wrlc.org/support/scp/admin.php?t=file");
//$file=$_POST['mytext'];
//header("Content-type: application/csv");
//header("Content-Disposition: attachment; filename=" ."'" . $_POST['mytext'].  ".csv'");
//readfile("/tmp/" . $_POST['mytext'].'.csv');
//}
//}
/*elseif(strcmp($_POST['format'],"Excel")==0)
{
$_SESSION['filename']=$_POST['mytext'];
$_SESSION['request']="Excel";
 //$ob_file = fopen('/tmp/'.$_POST['mytext'].'.xls','w');
        //ob_start('ob_file_callback');
//$workbook = new Spreadsheet_Excel_Writer($_POST['mytext'].'.xls');
//$worksheet =$workbook->addWorksheet("Report for the period from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear']);
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0); //we are selecting a worksheet
//$excel->getActiveSheet()->setTitle("Report for the period from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear']); //renaming it
$excel->getActiveSheet()->setTitle("Testing");

if(strcmp($selected_radio,"Source")==0)
{
	if(strcmp($dept,"All")==0)
        {
		$query = mysql_query("select d.dept_name, t.source,COUNT(t.source) from ost_ticket t join ost_department d on t.dept_id=d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by t.source, d.dept_name order by dept_name"); 
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
        	$row=mysql_fetch_array($result);
        	$deptid=$row['dept_id'];
		 $query = mysql_query("select d.dept_name,t.source,COUNT(t.source) from ost_ticket t join ost_department d on t.dept_id= d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' AND d.dept_id=$deptid group by t.source, d.dept_name order by dept_name");
	}
	//echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>"; 
	//echo "<tr><th><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></th></tr>";
	//echo "<tr></tr><tr></tr>";
	//echo "<tr>";  
	$excel->getActiveSheet()->setCellValue('A1',"Department");
	$excel->getActiveSheet()->setCellValue('B1',"Source");
	$excel->getActiveSheet()->setCellValue('C1',"Number of Requests");
	//echo "</tr>";

$i=2;
while($row=mysql_fetch_array($query))
{
	
	//echo "<tr>";
	$excel->getActiveSheet()->setCellValue("A$i",$row['dept_name']);
	$excel->getActiveSheet()->setCellValue("B$i",$row['source']);
	$excel->getActiveSheet()->setCellValue("C$i",$row['COUNT(t.source)']);
	//echo "</tr>";
	$i=$i+1;
}
}
else if(strcmp($selected_radio,"User")==0)
{
	if(strcmp($dept,"All")==0)
	{
 	$query = mysql_query("select d.dept_name, t.issue_type,COUNT(t.issue_type) from ost_ticket t join ost_department d on t.dept_id = d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by t.issue_type,d.dept_name order by d.dept_name");
	}

	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
		$row=mysql_fetch_array($result);
		$deptid=$row['dept_id'];
	//echo $deptid;
	$query = mysql_query("select d.dept_name, t.issue_type,COUNT(t.issue_type) from ost_ticket t join ost_department d on t.dept_id=d.dept_id where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' AND d.dept_id=$deptid group by t.issue_type,d.dept_name order by d.dept_name");
	}
        //echo "<table width='100%' border='0' cellspacing='1' cellpadding='1'>";
	//echo "<tr> <td> Department ID and name ". $dept . " " . $deptid . "</td><tr>";
	 //echo "<tr><th><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></th></tr>";
        //echo "<tr></tr><tr></tr>";
 
	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue('A1',"Department");
        $excel->getActiveSheet()->setCellValue('B1',"User");
        $excel->getActiveSheet()->setCellValue('C1',"Number of Requests");
        //echo "</tr>";
	$i=2;
	while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue("A".$i,$row['dept_name']);
        $excel->getActiveSheet()->setCellValue("B".$i,$row['issue_type']);
        $excel->getActiveSheet()->setCellValue("C".$i,$row['COUNT(t.issue_type)']);
        $i=$i+1;
}


}
else if(strcmp($selected_radio,"Problem")==0)
{
        //echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
	 //echo "<tr><th><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></th></tr>";
        //echo "<tr></tr><tr></tr>";

	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue('A1',"Ticket");
	$excel->getActiveSheet()->setCellValue('B1',"Department");	
	$excel->getActiveSheet()->setCellValue('C1',"Problem type");
	$excel->getActiveSheet()->setCellValue('D1',"Source");
        $excel->getActiveSheet()->setCellValue('E1',"User");
	$excel->getActiveSheet()->setCellValue('F1',"Date Opened");
	$excel->getActiveSheet()->setCellValue('G1',"Date Closed");
        $excel->getActiveSheet()->setCellValue('H1',"Technician");
        //echo "</tr>";
	 if(strcmp($dept,"All")==0)
        {
 		$query = mysql_query("select d.dept_name,t.issue_type,t.helptopic,s.firstname,s.lastname,t.source,t.created,t.closed,t.ticket_id,t.email,t.ticketID from ost_ticket t join ost_department d on t.dept_id= d.dept_id join ost_staff s on t.resolved_by=s.staff_id where t.closed IS NOT NULL  order by d.dept_name");
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
                $row=mysql_fetch_array($result);
                $deptid=$row['dept_id'];
		 $query = mysql_query("select d.dept_name,t.issue_type,t.helptopic,s.firstname,s.lastname,t.source,t.created,t.closed,t.ticket_id,t.email,t.ticketID from ost_ticket t join ost_department d on t.dept_id= d.dept_id join ost_staff s on t.resolved_by=s.staff_id where t.closed IS NOT NULL AND d.dept_id=$deptid order by d.dept_name");
	}
	$i=2;
        while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue("A".$i,$row['ticketID']); 
        $excel->getActiveSheet()->setCellValue("B".$i,$row['dept_name']);
	$excel->getActiveSheet()->setCellValue("C".$i,$row['helptopic']);
	$excel->getActiveSheet()->setCellValue("D".$i,$row['source']);
        $excel->getActiveSheet()->setCellValue("E".$i,$row['issue_type']);
	$excel->getActiveSheet()->setCellValue("F".$i,$row['created']);
	$excel->getActiveSheet()->setCellValue("G".$i,$row['closed']);
	$excel->getActiveSheet()->setCellValue("H".$i,$row['firstname'] . " " . $row['lastname']);
	$i= $i+1;
        //echo "</tr>";
}


}
else if(strcmp($selected_radio,"Tech")==0)
{
        //echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
	 //echo "<tr><th><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></th></tr>";
        //echo "<tr></tr><tr></tr>";
 
	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue('A1',"Department");
	$excel->getActiveSheet()->setCellValue('B1',"Technicain First Name");
	$excel->getActiveSheet()->setCellValue('C1',"Technicain Last Name");
	$excel->getActiveSheet()->setCellValue('D1',"Ticket Count");
        $excel->getActiveSheet()->setCellValue('E1',"Problem type");
	$excel->getActiveSheet()->setCellValue('F1',"Status");
        //echo "<td>  Ticket Duration  </td>";
        //echo "</tr>";
        //$query = mysql_query("select s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.created,t.closed),COUNT(t.helptopic),t.helptopic from ost_ticket t join ost_staff s on t.staff_id=s.staff_id  where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by t.helptopic") or die(mysql_error()) ;
	//$query = mysql_query("select s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.created,t.closed),t.helptopic,COUNT(s.firstname) from ost_ticket t join ost_staff s on t.staff_id=s.staff_id  where t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' group by s.firstname") or die(mysql_error()) ;
	if(strcmp($dept,"All")==0)
        {
	$query=mysql_query("select d.dept_name,s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.closed,t.created),COUNT(t.helptopic),t.helptopic from ost_ticket t join ost_staff s on t.resolved_by=s.staff_id join ost_department d on s.dept_id=d.dept_id where t.status='closed' and t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday'  group by t.resolved_by order by d.dept_name");
	//echo mysql_num_rows($query);
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
                $row=mysql_fetch_array($result);
                $deptid=$row['dept_id'];
		$query=mysql_query("select d.dept_name,s.firstname,s.lastname,t.status,t.closed,t.created,DATEDIFF(t.closed,t.created),COUNT(t.helptopic),t.helptopic from ost_ticket t join ost_staff s on t.resolved_by=s.staff_id join ost_department d on s.dept_id=d.dept_id where t.status='closed' and t.created >= '$syear$smonth$sday' AND t.created <= '$eyear$emonth$eday' AND d.dept_id=$deptid group by t.resolved_by order by dept_name");

	}
	$i=2;
        while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue("A".$i,$row['dept_name']);
	$excel->getActiveSheet()->setCellValue("B".$i,$row['firstname']);
	$excel->getActiveSheet()->setCellValue("C".$i,$row['lastname']);
	$excel->getActiveSheet()->setCellValue("D".$i,$row['COUNT(t.helptopic)']);
       	//echo "<td>" . $row['COUNT(t.helptopic)'] . "</td>";
	$excel->getActiveSheet()->setCellValue("E".$i,$row['helptopic']);
	$excel->getActiveSheet()->setCellValue("F".$i,$row['status']);
	//echo $row['created'];	
	/*if (is_null($row['closed']))
	{
		$now   = date('Y-m-d H:i:s',time());
		$endTime = strtotime($now);
  		$startTime = strtotime($row['created']);
  		$diff = $endTime - $startTime;
  		
		echo $diff;	
		echo "<td>" .    (($diff > 0) ? floor($diff / 86400)+1 : 0) . "</td>";
	}
	else
	{
		echo "<td>" . $row['DATEDIFF(created,closed)'] . "</td>";
	}*/
       
	/*$i=$i+1;
        //echo "</tr>";
}


}
else if(strcmp($selected_radio,"Duration")==0)
{
	//echo "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
	 //echo "<tr><th><h2>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</h2></th></tr>";
        //echo "<tr></tr><tr></tr>";
 
	//echo "<tr><th>Report from " . $_POST['smonth']. "-" . $_POST['sday'] . "-" . $_POST['syear'] . " to " . $_POST['emonth'] . "-" . $_POST['eday'] . "-" . $_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from" . $_POST['smonth']. '-' . $_POST['sday'] . '-' . $_POST[s'year'] 'to' . $_POST['emonth']. '-' .$_POST['eday']. '-' .$_POST['eyear'] . "</th></tr>";
	//echo "<tr><th>Report from $_POST['smonth']-$_POST['sday']-$_POST[s'year'] to $_POST['emonth']-$_POST['eday']-$_POST['eyear'] </th></tr>";
        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue('A1',"Department");
	$excel->getActiveSheet()->setCellValue('B1',"Ticket Count");
	$excel->getActiveSheet()->setCellValue('C1',"Ticket Issue");
	//echo "<td>  Assigned to </td>";
	$excel->getActiveSheet()->setCellValue('D1',"Ticket Status");
	$excel->getActiveSheet()->setCellValue('E1',"Avg. Ticket Duration in Days");
	//echo "<tr>";
	//if(strcmp($))	
	if(strcmp($dept,"All")==0)
        {

	$query = mysql_query("select d.dept_name,Count(t.Ticket_id)  ,t.helptopic, t.created,t.closed,t.status, Avg(DATEDIFF(t.closed,t.created)) from ost_ticket t join ost_department d on t.dept_id=d.dept_id group by t.helptopic,t.status order by d.dept_name  ");
	}
	else
	{
		$result=mysql_query("select dept_id from ost_department where dept_name='$dept'");
                $row=mysql_fetch_array($result);
                $deptid=$row['dept_id'];
		 $query = mysql_query("select d.dept_name,Count(t.Ticket_id)  ,t.helptopic, t.created,t.closed,t.status, Avg(DATEDIFF(t.closed,t.created)) from ost_ticket t join ost_department d on t.dept_id=d.dept_id where d.dept_id=$deptid group by t.helptopic,t.status order by d.dept_name  ");

	}
	$i=2;
	while($row=mysql_fetch_array($query))
{

        //echo "<tr>";
	$excel->getActiveSheet()->setCellValue("A".$i,$row['dept_name']);
	$excel->getActiveSheet()->setCellValue("B".$i,$row['Count(t.Ticket_id)']);
	$excel->getActiveSheet()->setCellValue("C".$i,$row['helptopic']);
	//echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
	$excel->getActiveSheet()->setCellValue("D".$i,$row['status']);
	if (is_null($row['closed']))
        {
                $now   = date('Y-m-d H:i:s',time());
                $endTime = strtotime($now);
                $startTime = strtotime($row['created']);
                $diff = $endTime - $startTime;
                //echo $now . " " . $row['created'];    
                $excel->getActiveSheet()->setCellValue("E".$i,(($diff > 0) ? floor($diff / 86400)+1 : 0));
		//echo "<td>" . dateDiff($row['created'],$now) . "</td>";
	
        }
        else
        {
                $excel->getActiveSheet()->setCellValue("E".$i,$row['Avg(DATEDIFF(t.closed,t.created))']);
        }
	$i=$i+1;
	//echo "</tr>";
}
}
}
}
//$excelBinaryWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
//$excelBinaryWriter->save('/tmp/'.$_POST['mytext'].'.xls');
$excelWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$excelWriter->save('/tmp/'.$_POST['mytext'].'.xls');
header("Location: http://gwdroid.wrlc.org/support/scp/admin.php?t=file");
}*/
function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }

function ob_file_callback($buf)
{
  global $ob_file;
  fwrite($ob_file,$buf);
}

?>
