<?php


?>

<form method=post name=f1 action="tickets.php?a=actualclose"><input type=hidden name=todo value=submit>

 <table border='0' cellspacing='0' >
<tr><td>Please fill the form with the following information about ticket before closing
 <tr><td align=left> <b>Ticket Source:</b></td>
        <td>
            <select name="source">
                <option value="" selected >Select Source</option>
                <option value="Web" <?=($info['source']=='Web')?'selected':''?>>Web</option>
                <option value="Phone" <?=($info['source']=='Phone')?'selected':''?>>Phone</option>
                <option value="Email" <?=($info['source']=='Email')?'selected':''?>>Email</option>
                <option value="Other" <?=($info['source']=='Other')?'selected':''?>>Other</option>
            </select>
            &nbsp;<font class="error"><b>*</b>&nbsp;<?=$errors['source']?></font>
        </td>
    </tr>
         <tr>
        <td align="left"><b>User Type:</b></td>
        <td>
            <select name="type">
                <option value="" selected >Select Type</option>
                <option value="Patron" <?=($info['type']=='Patron')?'selected':''?>>Paton</option>
                <option value="Staff" <?=($info['type']=='Staff')?'selected':''?>>Staff</option>
                <option value="External Visitor" <?=($info['type']=='External Visitor')?'selected':''?>>External Visitor</option>
                <option value="Faculty" <?=($info['type']=='Faculty')?'selected':''?>>Faculty</option>
                <option value="Other" <?=($info['type']=='Other')?'selected':''?>>Other</option>

            </select>
            &nbsp;<font class="error"><b>*</b>&nbsp;<?=$errors['type']?></font>
        </td>
    </tr>
 <?php
    $services= db_query('SELECT topic_id,topic FROM '.TOPIC_TABLE.' WHERE isactive=1 ORDER BY topic');
    if($services && db_num_rows($services)){
        ?>
    <tr>
        <td align="left" valign="top">Help Topic:</td>
        <td>
            <select name="topicId">
                <option value="" selected >Select One</option>
                <?
                 while (list($topicId,$topic) = db_fetch_row($services)){
                    $selected = ($info['topicId']==$topicId)?'selected':''; ?>
                    <option value="<?=$topicId?>"<?=$selected?>><?=$topic?></option>
                <?
                 }?>
            </select>
            &nbsp;<font class="error">&nbsp;<?=$errors['topicId']?></font>
        </td>
    </tr>
    <?
    }
        ?>
 <tr height=2px><td align="left" colspan=2 >&nbsp;</td</tr>
    <tr>
        <td></td>
        <td>
            <input class="button" type="submit" name="submit_x" value="Submit Ticket">
            <input class="button" type="reset" value="Reset">
            <input class="button" type="button" name="cancel" value="Cancel" onClick='window.location.href="tickets.php"'>
        </td>
    </tr>
  </form>



