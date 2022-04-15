<?php echo form_open("home/dologin");?>
<table align="center">
	<tr>
    	<td>Username</td>
        <td>:</td>
        <td><?php echo form_input("txtUsername");?></td>
    </tr>
    <tr>
    	<td>Password</td>
        <td>:</td>
        <td><?php echo form_password("txtPassword");?></td>
    </tr>
    <tr>
    	<td></td>
        <td></td>
        <td><?php echo form_submit("","Login");?></td>
    </tr>
</table>
<?php echo form_close();?>