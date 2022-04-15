<script type="text/javascript">
	$(function() {
		$( "#radioset" ).buttonset();
		$( "#mybutton" ).button();
		$('#radio1').click(function(){
			$.post(
				"<?php echo site_url("perusahaan/jenisusaha"); ?>",{"":""},
				function(data){
					$('#dialog').dialog('option', 'title', 'Jenis Usaha - '+data.kecamatan);
					$("#dataDialog").show().html(data.response);
				},
				"json"
			);
			$( "#dialog" ).dialog( "open" );	
		});
		
		$('#radio2').click(function(){						   
			$.post(
				"<?php echo site_url("perusahaan/tipeusaha"); ?>",{"":""},
				function(data){
					$('#dialog').dialog('option', 'title', 'Tipe Usaha - '+data.kecamatan);
					$("#dataDialog").show().html(data.response);
				},
				"json"
			);
			$( "#dialog" ).dialog( "open" );					   
		});
		
		$('#radio3').click(function(){
			$.post(
				"<?php echo site_url("perusahaan/dataperusahaan"); ?>",{"":""},
				function(data){
					$('#dialog').dialog('option', 'title', 'Perusahaan - '+data.kecamatan);
					$("#dataDialog").show().html(data.response);
				},
				"json"
			);
			$( "#dialog" ).dialog("open");									
		});
		
		$("#dialog" ).dialog({
			autoOpen: false,
			width: 700
		});
		
	});
</script>

<div>
	<fieldset style="width:400px; float:left;">
    	<legend>Persebaran</legend>
        <!--<li><a href="#linkJenisUsaha" id="linkJenisUsaha">Jenis Usaha</a></li>
        <li><a href="#linkTipeUsaha" id="linkTipeUsaha">Tipe Usaha</a></li>
        <li><a href="#linkPerusahaan" id="linkPerusahaan">Daftar Perusahaan</a></li>-->
        <div id="radioset">
            <input type="radio" id="radio1" name="radio"><label for="radio1">Jenis Usaha</label>
            <input type="radio" id="radio2" name="radio"><label for="radio2">Tipe Usaha</label>
            <input type="radio" id="radio3" name="radio"><label for="radio3">Daftar Usaha</label>
		</div>
    </fieldset>
<?php
	if($this->session->userdata("hasLogin") == TRUE){
?>
    <fieldset style="width:250px; float:left;">
    	<legend>Export</legend>
        <?php echo anchor("peta/exportpeta","<input type='button' value='PDF' id='mybutton'></input>");?>
    </fieldset>
</div>
<?php
	}
?>
<div>
    <fieldset id="myMap">
        <legend>Peta</legend>
        <?php echo form_open("peta/querymap"); ?>
            <input type=image name="mapa" src="<?php echo $mapImage; ?>" />
            <input type=hidden name="extent" value="<?php echo $mapRect; ?>" />
        <?php echo form_close(); ?>
        <img src=<?php echo  $mapLegend ?>><br>
    </fieldset>
</div>

<div id="dialog" title="Data">
	<div id="dataDialog">
    </div>
</div>