// ============= HANDLE GENERATE BUTTON =============
function gen_button_hdl(){
	var num_word = $('[name="num_word"]').val();
	var max_length = $('[name="max_len"]').val();
	var incl_num = $('[name="incl_num_check"]').prop("checked");
	var incl_num_type = $('[name="incl_num_type"]:checked').val();
	var incl_num_size = $('[name="incl_num_size"]').val();
	var incl_num_cus_val = $('[name="incl_num_cus_val"]').val();
	var incl_ss = $('[name="incl_ss_check"]').prop("checked");
	var incl_ss_type = $('[name="incl_ss_type"]:checked').val();
	var incl_ss_size = $('[name="incl_ss_size"]').val();
	var incl_ss_cus_val = $('[name="incl_ss_cus_val"]').val();
	var separation_type = $('[name="sepa_type"]:checked').val();
	var case_tfm_type = $('[name="case_tfm_type"]:checked').val();
	/* Refer from http://api.jquery.com/jquery.ajax/ */
	var request = $.ajax({
  		url: "Password_Generator.php",
  		type: "POST",
  		data: { 
  			num_word: num_word,
  			max_length: max_length,
  			incl_num: incl_num,
  			incl_num_type: incl_num_type,
  			incl_num_size: incl_num_size,
  			incl_num_cus_val: incl_num_cus_val,
  			incl_ss: incl_ss,
  			incl_ss_type: incl_ss_type,
  			incl_ss_size: incl_ss_size,
  			incl_ss_cus_val: incl_ss_cus_val,
  			separation_type: separation_type,
  			case_tfm_type: case_tfm_type  			 
  		},
  		dataType: "text"
	});
	request.done(function(msg) {
  		$("#pass_display").val(msg);
	});
	request.fail(function( jqXHR, textStatus ) {
  		alert( "Request failed: " + textStatus );
	});
}

// ============= HANDLE incl_cus_ss_radio BUTTON =============
/* @brief: Enable include_ss_size list when custom radio is checked
 * @params: incl_cus_ss_radio 	radio input object
 * @return:	none  */
function incl_ss_type_hdl(incl_cus_ss_radio){
	if (incl_cus_ss_radio.value == "c")
		$('[name="incl_ss_cus_val"]').prop("disabled", false);
	else
		$('[name="incl_ss_cus_val"]').prop("disabled", true);	
}

// ============= HANDLE incl_ss_checkbox BUTTON =============
/* @brief:	Enable Random, Custom radio button and include_ss_size list when
 * 			include_ss_checkbox is checked 
 * 			(enable include_ss_custom_value list if custom radio is checked) 
 * 			and otherwise
 * @params:	incl_ss_checkbox 	checkbox input object
 * @return:	none  */
function incl_ss_chbox_hdl(incl_ss_checkbox){
	if (incl_ss_checkbox.checked == true){
		$('[for="incl_ss_check"]').addClass('chk');
		$('[name="incl_ss_type"]').prop("disabled", false);
		$('[name="incl_ss_size"]').prop("disabled", false);
		if ($('[name="incl_ss_type"]:checked').val() == "c")
			$('[name="incl_ss_cus_val"]').prop("disabled", false);		 				
	}
	else{
		$('[for="incl_ss_check"]').removeClass('chk');
		$('[name="incl_ss_type"]').prop("disabled", true);
		$('[name="incl_ss_cus_val"]').prop("disabled", true);
		$('[name="incl_ss_size"]').prop("disabled", true);		
	}	
}

// ============= HANDLE incl_cus_num_radio BUTTON =============
/* @brief: Enable include_num_size list when custom radio is checked
 * @params: incl_cus_num_radio 	radio input object
 * @return:	none  */
function incl_num_type_hdl(incl_cus_num_radio){
	if (incl_cus_num_radio.value == "c")
		$('[name="incl_num_cus_val"]').prop("disabled", false);	
	else
		$('[name="incl_num_cus_val"]').prop("disabled", true);	
}

// ============= HANDLE incl_num_checkbox BUTTON =============
/* @brief:	Enable Random, Custom radio button and include_num_size list when
 * 			include_num_checkbox is checked 
 * 			(enable include_num_custom_value list if custom radio is checked) 
 * 			and otherwise
 * @params:	incl_num_checkbox 	checkbox input object
 * @return:	none  */
function incl_num_chbox_hdl(incl_num_checkbox){
	if (incl_num_checkbox.checked == true){
		$('[for="incl_num_check"]').addClass('chk');
		$('[name="incl_num_type"]').prop("disabled", false);
		$('[name="incl_num_size"]').prop("disabled", false);
		if ($('[name="incl_num_type"]:checked').val() == "c")
			$('[name="incl_num_cus_val"]').prop("disabled", false);		 				
	}
	else{
		$('[for="incl_num_check"]').removeClass('chk');
		$('[name="incl_num_type"]').prop("disabled", true);
		$('[name="incl_num_cus_val"]').prop("disabled", true);
		$('[name="incl_num_size"]').prop("disabled", true);		
	}
}