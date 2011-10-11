<?php




?>

<script type="text/javascript">
//<![CDATA[
	
	
	function checktext() {
	var myselect = document.getElementById('myselect');
    var mytextfield = document.getElementById('mytext');
    if (myselect.value == 'File'){
        mytextfield.value = 'tmp'+<?php echo rand(5, 1000);?>;
    }else {
        mytextfield.value = '';
    }
}
//]]>
</script>

 <form method=post name=f1 action="admin.php?t=result"><input type=hidden name=todo value=submit>

 <table border='0' cellspacing='0'  >
 <tr><td>
 <Table><tr>


<td align=left >
 Report's Starting Date: 
<select name=smonth value=''>Select Month</option>
 <option value='01'>January</option>
 <option value='02'>February</option>
 <option value='03'>March</option>
 <option value='04'>April</option>
 <option value='05'>May</option>
 <option value='06'>June</option>
 <option value='07'>July</option>
 <option value='08'>August</option>
 <option value='09'>September</option>
 <option value='10'>October</option>
 <option value='11'>November</option>
 <option value='12'>December</option>
 </select>

 </td><td align=left >
 Day<select name=sday >
 <option value='01'>01</option>

 <option value='02'>02</option>
 <option value='03'>03</option>
 <option value='04'>04</option>
 <option value='05'>05</option>
 <option value='06'>06</option>
 <option value='07'>07</option>
 <option value='08'>08</option>
 <option value='09'>09</option>
 <option value='10'>10</option>
 <option value='11'>11</option>
 <option value='12'>12</option>
 <option value='13'>13</option>
 <option value='14'>14</option>
 <option value='15'>15</option>
 <option value='16'>16</option>
 <option value='17'>17</option>
 <option value='18'>18</option>
 <option value='19'>19</option>
 <option value='20'>20</option>
 <option value='21'>21</option>
 <option value='22'>22</option>
 <option value='23'>23</option>
 <option value='24'>24</option>
 <option value='25'>25</option>
 <option value='26'>26</option>
 <option value='27'>27</option>
 <option value='28'>28</option>
 <option value='29'>29</option>
 <option value='30'>30</option>
 <option value='31'>31</option>
 </td><td align=left >
 Year(yyyy)<input type=text name=syear size=4 value=2011>
 </td>

</tr>
</Table>
</td>
</tr>
 <tr><td>
<Table><tr>


<td align=left >
Report's Ending Date:
 <select name=emonth value=''>Select Month</option>
 <option value='01'>January</option>
 <option value='02'>February</option>
 <option value='03'>March</option>
 <option value='04'>April</option>
 <option value='05'>May</option>
 <option value='06'>June</option>
 <option value='07'>July</option>
 <option value='08'>August</option>
 <option value='09'>September</option>
 <option value='10'>October</option>
 <option value='11'>November</option>
 <option value='12'>December</option>
 </select>

 </td><td align=left >
 Day<select name=eday >
 <option value='01'>01</option>
 <option value='02'>02</option>
 <option value='03'>03</option>
 <option value='04'>04</option>
 <option value='05'>05</option>
 <option value='06'>06</option>
 <option value='07'>07</option>
 <option value='08'>08</option>
 <option value='09'>09</option>
 <option value='10'>10</option>
 <option value='11'>11</option>
 <option value='12'>12</option>
 <option value='13'>13</option>
 <option value='14'>14</option>
 <option value='15'>15</option>
 <option value='16'>16</option>
 <option value='17'>17</option>
 <option value='18'>18</option>
 <option value='19'>19</option>
 <option value='20'>20</option>
 <option value='21'>21</option>
 <option value='22'>22</option>
 <option value='23'>23</option>
 <option value='24'>24</option>
 <option value='25'>25</option>
 <option value='26'>26</option>
 <option value='27'>27</option>
 <option value='28'>28</option>
 <option value='29'>29</option>
 <option value='30'>30</option>
 <option value='31'>31</option>
 </select>
 </td><td align=left >
 Year(yyyy)<input type=text name=eyear size=4 value=2011>
 </td>

</tr>
</table>
</td>
</tr>
 
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr>
<td align =left>Select Department: <select name=dept>
	<option value="All">All</option>
<?php 
	mysql_connect("localhost","root","sql4gwdroid");
	mysql_select_db("osticket") or die("Unable to select osticket database");
	$result=mysql_query("select dept_name from ost_department");
	$num=mysql_numrows($result);
	$i=0;
	while($i<$num)
	{
		$department=mysql_result($result,$i,"dept_name");
		echo "<option value = " . $department . ">" . $department . "</option>";  
		$i++;
	}
?>
</select>
</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr>
<td align = left>Select Report Format: <select name=format id='myselect' onChange="checktext();">
	<option value="Online">View Online</option>
	<option value="File">Output to File</option>
</select>

<input type='Hidden' value='tmp<?php echo rand(5, 1000); ?>'  name='mytext' id='mytext'  />
</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr>
<td>  Select a report from this list: </td>
</tr>
 
<br>
<br> 
 <tr>
<tr>
 <td  align=left>
 <input type='Radio' name='Metric' value='Problem' checked/> Problem Type
 </td>
 </tr>

 <td  align=left>
 <input type='Radio' name='Metric' value='Source' /> Ticket Creation Source
 </td>
 </tr>
  <tr>
 <td align=left>
 <input type='Radio' name='Metric' value='User' /> Ticket User
 </td>
 </tr>
 
 <tr>
 <td  align=left>
 <input type='Radio' name='Metric' value='Tech' /> Technician
 </td>
 </tr>
 <td  align=left>
 <input type='Radio' name='Metric' value='Duration' /> Ticket Duration
 </td>
 </tr>


<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>


 

 <tr>
 <td align = center>
 <input type=submit value=Submit>
 

 <input type=reset >
 </td>

 </tr>
 </table>


 </form>

