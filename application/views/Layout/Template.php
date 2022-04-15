<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $title; ?></title>
    <?php
		
		echo link_tag("assets/css/blitzer/jquery-ui-1.9.1.custom.css");
		echo link_tag("assets/default.css");
		echo script_tag("assets/jquery-1.8.2.js");
		echo script_tag("assets/jquery-ui-1.9.0.custom.js");
		
		echo link_tag("assets/nivo-slider/themes/default/default.css");
		echo link_tag("assets/nivo-slider/themes/light/light.css");
		echo link_tag("assets/nivo-slider/themes/dark/dark.css");
		echo link_tag("assets/nivo-slider/themes/bar/bar.css");
		echo link_tag("assets/nivo-slider/nivo-slider.css");
	?>

</head>
	<body>
    
    	<div id="wrapper">
            <div id="header">
            	<div class="kontol">
                </div>
                <div id="logo">
                    <h1><a href="#">Usaha<span>Salatiga</span></a></h1>
                     <h2 align="center"><a href="#">Jl.Let.Jend Sukowati No 51 Salatiga<span>-Telp.(0298)326767</span></a></h2>
                    
                </div>
            </div>
            <!-- end #header -->
            <div id="menu">
                <ul>
                    <!--<li class="current_page_item"><a href="#">Home</a></li>-->
                    <li><?php echo anchor("","Beranda");?></li>
                    <li><?php echo anchor("home/peta","Peta");?></li>
                    <li><?php echo anchor("home/perusahaan","Perusahaan");?></li>
                    <li><?php echo anchor("home/grafik","Grafik");?></li>
                    <?php if ($this->session->userdata("hasLogin") != TRUE){?>
                    <li><?php echo anchor("home/login","Login");?></li>
                    <?php }else{ ?>
                    <li><?php echo anchor("admin/logout","Logout");?></li>
					<li><?php echo anchor("admin/index","Admin"); }?></li>
                    <li class="last"><?php echo anchor("home/link","Link");?></a></li>
                </ul>
            </div>
            <?php
				/*$attr = array(
				  'src' => 'assets/images/headerweb.jpg',
				  'width' => '1200px',
				  'height' => '300px'
				);*/
			?>
            
            <!--<div id="banner"><?php echo img($attr);?></div>-->
            <div id="welcome">
                <h2 class="title"><a href="#"><?php echo $title; ?></a></h2>
                <div class="content">
                    <p>
                    	<?php
							echo isset($content) ? $content : "";
						?>
                        <div id="graph"></div>
                    </p>
                </div>
            </div>
            <!--<div id="three-columns">
                <div class="content">
                
                	 
                        
                </div>
            </div>-->
            
        </div>
        <div id="footer">
            <p>By Immanuel Arya _ FTI@2008</p>
        </div>

	</body>
</html>