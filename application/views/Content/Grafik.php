<?php
	echo script_tag("FusionChart/FusionCharts.js");
	//echo $grafik1;
	//echo $grafik2;
	
	function image($img){
		$attr = array(
		  'src' => 'assets/'.$img.'.png',
		  'width' => '100px',
		  'height' => '100px'
		);
		return img($attr);	
	}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#linkJumlahUsaha').click(function(){
			$.post(
				"<?php echo site_url("grafik/grafikjumlahusaha"); ?>",{"":""},
				function(data){
					$("#graph").show().html(data.response);
				},
				"json"
			); 
		});
		
		$('#linkJenisUsaha').click(function(){
			$.post(
				"<?php echo site_url("grafik/grafikjenisusaha"); ?>",{"":""},
				function(data){
					$("#graph").show().html(data.response);
				},
				"json"
			); 
		});
	});
</script>
<table>
	<tr align="center">
    	<td><a href="#graph" id="linkJumlahUsaha"><?php echo image("Usaha"); ?></a><br/>Jumlah Usaha</td>
        <td><a href="#graph" id="linkJenisUsaha"><?php echo image("Chart"); ?></a><br/>Jenis Usaha</td>
    </tr>
</table>