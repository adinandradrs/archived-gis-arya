<div class="slider-wrapper theme-dark">

                            <div id="slider" class="nivoSlider">
                				<?php
									function slide($gambar){
										$attr = array(
											"src" => "assets/nivo-slider/demo/images/".$gambar
										);	
										return img($attr);
									}
								?>
                                <?php
									echo slide("1.jpg");
									echo slide("2.jpg");
									echo slide("3.jpg");
									echo slide("4.jpg");
								?>
                            </div>
                
                            <div id="htmlcaption" class="nivo-html-caption">
                
                                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
                
                            </div>
                
                        </div>
						
                        <?php echo script_tag("assets/nivo-slider/jquery.nivo.slider.js");?>
                    
                        <script type="text/javascript">
                    
                        $(window).load(function() {
                    
                            $('#slider').nivoSlider();
                    
                        });
                    
                        </script>
                        
<div id="two-columns">
                <div id="col1">
                    <h2>Kronologi Usaha Salatiga</h2>
                   	<p align="justify">Perihal perdagangan, Kota Salatiga memiliki potensi unggulan daerah yang mampu dipasarkan hingga luar wilyah Salatiga, yaitu industri Batu Pahat, industri abon dan dendeng, industri eating-enting gepuk, industri kofeksi, industri kerajinan panah, industri bambu, dan industri sapu ijuk. Dari 7 produk unggulan tersebut secara garis besar pemasarannya adalah Surakarta serta Semarang baik kota atau kabupaten dan tidak menutup kemungkinan ke daerah lainnya Namun yang paling dominan adalah wilayah Semarang. Sehingga perlu adanya sistem komputerisasi di dalam dinas pemerintahan kota (Pemkot), yang mampu memberikan visualisasi secara jelas bagi tingkat penyebaran jenis-jenis usaha di Kota Salatiga. </p>
                </div>
                <div id="col2">
                	<?php
						$attr = array(
						  'src' => 'assets/simbok.jpg',
						  'width' => '320px',
						  'height' => '260px',
						  'class'=>'image-style'
						);
						echo img($attr);
					?>                	
                </div>
            </div>