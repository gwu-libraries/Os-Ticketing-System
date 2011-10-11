<?php

$conn = mysql_connect('localhost', 'root', 'sql4gwdroid');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('osticket');
$result = mysql_query('select ost_ticket.ticketID,ost_department.dept_name,ost_staff.firstname,ost_staff.lastname,ost_ticket.helptopic,ost_ticket.status,ost_ticket.email,ost_ticket.source,ost_ticket.closed,ost_ticket.created,ost_ticket.lastresponse,ost_ticket.issue_type,ost_ticket.resolved_by from ost_ticket  join ost_staff  on ost_ticket.staff_id=ost_staff.staff_id join ost_department  on ost_ticket.dept_id=ost_department.dept_id');

if (!$result) {
    die('Query failed: ' . mysql_error());
}
/* get column metadata */
//echo "<script type='text/javascript'>";
//echo "$(document).ready(function() {";
//echo  "$('#s1').dropdownchecklist();";
//echo "});";
//echo "</script>";
$i = 0;
echo "<br><br>";
echo "<form name=myform method=post action=admin.php?t=dynamic> <input type=hidden name=todo value=submit>";
echo "<table width='100%' border='0' cellspacing='1' cellpadding='2' >";
echo "<tr><td>Select columns for report:</td>";
//echo"<td>action</td>";
//echo "<td>Selected columns</td>";
//echo"<td>action</td>";
echo "<td> group by </td>";
//echo"<td>action</td>";
echo "<td> sort by </td>";

echo "<tr><td><select id=\"s1\" name=column[] multiple='multiple' size=". mysql_num_fields($result). " onblur=ShowItem()>";

while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result, $i);	
    echo "<option name=field".$i. " value=".$meta->name." >".$meta->name."</option>";
    
    //}
//echo "<pre> name:         $meta->name table:        $meta->table type:         $meta->type </pre>";
    $i++;
}
echo "</select></td>";
$i=0;
//echo "<td><button type=button name=btnMoveLeft onclick = fnMoveItems('column','fields')>add field</button><br><br><button type=button name=btnMoveRight onclick = fnMoveItems('fields','column')>remove field</button></td>";
/*echo "<td> <select name=fields multiple='multiple' size=". mysql_num_fields($result).">";
while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result, $i);
    echo "<option name=field".$i. " value=".$meta->name." >".$meta->name."</option>";

    //}
//echo "<pre> name:         $meta->name table:        $meta->table type:         $meta->type </pre>";
    $i++;
}
echo "</select></td>";
$i=0;*/
//echo "<td><button type=button name=btnMoveLeft1 onclick = fnMoveItems1('fields','groups')>add field</button><br><br><button type=button name=btnMoveRight1 onclick = fnMoveItems('groups','fields')>remove field</button></td>";
echo "<td> <select id=\"s2\" name=groups[] multiple='multiple' size=". mysql_num_fields($result).">";
/*while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result, $i);
    echo "<option name=".$i. " value=".$meta->name." >".$meta->name."</option>";

    //}
//echo "<pre> name:         $meta->name table:        $meta->table type:         $meta->type </pre>";
    $i++;
}*/

echo "</select></td>";
$i=0;
//echo "<td><button type=button name=btnMoveLeft2 onclick = fnMoveItems1('groups','sorts')>add field</button><br><br><button type=button name=btnMoveRight2 onclick = fnMoveItems('sorts','groups','fields')>remove field</button></td>";
echo "<td> <select id=\"s3\" name=sorts[] multiple='multiple' size=". mysql_num_fields($result).">";
/*while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result, $i);
    echo "<option name=".$i. " value=".$meta->name." >".$meta->name."</option>";

    //}
//echo "<pre> name:         $meta->name table:        $meta->table type:         $meta->type </pre>";
    $i++;
}*/

echo "</select></td>";

echo "<tr><td>";

mysql_free_result($result);
echo "<tr>";
echo "<td align =left>Select Department: <select name=dept>";
echo "<option value='All'>All</option>";

        //mysql_connect("localhost","root","sql4gwdroid");
        //mysql_select_db("osticket") or die("Unable to select osticket database");
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
</tr></td>

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

<tr><td align=left>
Output to 
<select name=Format>
<option value=Online>Online</option>
<option value=Pdf> Pdf</option>
<option value=Excel>Excel</option>
</select>
</td></tr>
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
<script type="text/javascript">

function ShowItem()
{
  var arSelected = new Array();
  var source = document.getElementById("s1");
  var dst1 = document.getElementById("s2");
  var dst2= document.getElementById("s3");
  for (var i = 0; i < source.options.length; i++)
    if (source.options[ i ].selected)
      arSelected.push(i);
  for( var i =0;i<arSelected.length;i++)
  {
	var opt = document.createElement("option");
	var opt2 = document.createElement("option");	
	dst1.options.add(opt);
	dst2.options.add(opt2);
	opt.text= source.options[arSelected[i]].text;
	opt.value=source.options[arSelected[i]].value;
	opt2.text= source.options[arSelected[i]].text;
        opt2.value=source.options[arSelected[i]].value;

  }
   
}

</script>
