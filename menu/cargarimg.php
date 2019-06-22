<?php
	/*En php recibimos las variables de nuestro formulario 
	Como lo haríamos normalmente, en este caso solo es una. */
	
	$pic = $_FILES[fusion_builder_container hundred_percent="yes" overflow="visible"][fusion_builder_row][fusion_builder_column type="1_1" background_position="left top" background_color="" border_size="" border_color="" border_style="solid" spacing="yes" background_image="" background_repeat="no-repeat" padding="" margin_top="0px" margin_bottom="0px" class="" id="" animation_type="" animation_speed="0.3" animation_direction="left" hide_on_mobile="no" center_content="no" min_height="none"]['pic'];
	$data = array('success' => false);
	
	//Validamos si la copio correctamente 
	if(copy($pic['tmp_name'],'ruta/'.$pic['name'])){
		$data = array('success' => true);
	}
	
	//Codificamos el array a JSON (Esta sera la respuesta AJAX) 
	echo json_encode($data);
?>
 
