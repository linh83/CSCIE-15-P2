<?php
	/*******************Constant Declaration***************************/
	define("MAX_WORD", 20);
	define("MAX_NUMBER", 20);
	define("MAX_SPEC_SYMBOL", 20);
	/*******************Local Variable Declaration***************************/
	$special_symbols = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")");
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Project 2</title>
	<link type="text/css" rel="stylesheet" href="css/custom.css" />
	<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript"></script>		
	<script src="./js/UI_Control.js" type="text/javascript"></script>
</head>
<body>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">
			<div id="left"></div>
			<div id="center">
				<div class="ttl">XKCD-PASSWORD GENERATOR</div>
				<div id="border"></div>
				<div id="result">
					<input id="pass_display" type="text" placeholder="Result" readonly="readonly" />
				</div>
				<div id="general">
					<div class="ttl">General</div>
					<div class="result_m">
						<select name="num_word" id="num_word">
							<?php
								for ($i = 1; $i <= MAX_WORD; $i++){
									if ($i != 5){
										echo "<option value='$i'>" . $i . "</option>";
									}
									else{
										echo "<option value='$i' selected='selected'>" . $i . "</option>";
									}
								}
							?>				
						</select>
						<label class="css-lbl" for="num_word">Num word</label><br />
						<input class="css-input" id="max_len" type="number" name="max_len" value="50"/> 
						<label class="css-lbl" for="max_len">Max Length</label>
					</div>
				</div>
				<div id="include">
					<div class="ttl">Include</div>
					<div class="result_m">
						<label for="incl_num_check" class="label-checkbox">Include number  </label>
						<input type="checkbox" class="checkbox" name="incl_num_check" id="incl_num_check" onclick="incl_num_chbox_hdl(this)"/><br/>
						<label>Random <input type="radio" name="incl_num_type" value="r" disabled="disabled" checked="checked" onclick="incl_num_type_hdl(this)"/></label>
						<label>Custom <input type="radio" name="incl_num_type" value="c" disabled="disabled" onclick="incl_num_type_hdl(this)"/></label>
						<select name="incl_num_cus_val" disabled="disabled">
							<?php
								for ($i = 0; $i < 10; $i++){
									echo "<option value='$i'>" . $i . "</option>";	
								}						
							?>
						</select>
						<select name="incl_num_size" disabled="disabled">
							<?php
								for ($i = 1; $i <= MAX_NUMBER; $i++){
									if ($i != 5){
										echo "<option value='$i'>" . $i . "</option>";
									}
									else{
										echo "<option value='$i' selected='selected'>" . $i . "</option>";
									}
								}
							?>
						</select>
						<br />
						<label for="incl_ss_check" class="label-checkbox">Include special symbol</label>
						<input type="checkbox" class="checkbox" name="incl_ss_check" id="incl_ss_check" onclick="incl_ss_chbox_hdl(this)"/><br />
						
						<label>Random <input type="radio" name="incl_ss_type" value="r" disabled="disabled" checked="checked" onclick="incl_ss_type_hdl(this)"/></label>
						<label>Custom <input type="radio" name="incl_ss_type" value="c" disabled="disabled" onclick="incl_ss_type_hdl(this)"/></label>
						<select name="incl_ss_cus_val" disabled="disabled">
						<?php
							for ($i = 0; $i < count($special_symbols); $i++){
								echo "<option value='$i'>" . $special_symbols[$i] . "</option>";
							}
						?>
						</select>
						<select name="incl_ss_size" disabled="disabled">
						<?php
							for ($i = 1; $i <= MAX_SPEC_SYMBOL; $i++){
								if ($i != 5){
									echo "<option value='$i'>" . $i . "</option>";
								}
								else{
									echo "<option value='$i' selected='selected'>" . $i . "</option>";
								}
							}
						?>
						</select>
					</div>
				</div>
				<div class="clearfix"></div>
				<div id="separation">
					<div class="ttl">Separation</div>
					<div class="result_m">
						<input type="radio" name="sepa_type" value="none" class='css-radio' id='none'/> 
						<label for="none" class='css-label' >None</label> <br/>
						<input type="radio" name="sepa_type" value="space" class='css-radio' id='space'/> 
						<label for='space' class='css-label'>Space</label> <br/>
						<input type="radio" name="sepa_type" value="hyphen" class='css-radio' id='hyphen' checked="checked"/>
						<label for='hyphen' class='css-label'>Hyphen</label>
					</div>
				</div>
				<div id="case-transform">
					<div class="ttl">Case-transform</div>
					<div class="result_m">
						<input type="radio" id="all_lower" class="css-radio" name="case_tfm_type" value="all_lower" checked="checked"/>
						<label for="all_lower" class='css-label'>all lower case</label> <br />
						<input type="radio" id="all_upper" class="css-radio" name="case_tfm_type" value="all_upper" />
						<label for="all_upper" class='css-label'>ALL UPPER CASE</label> <br />
						<input type="radio" id="first_char" class="css-radio" name="case_tfm_type" value="first_char" />
						<label for="first_char" class='css-label'>The First Letter Of The Word</label>
					</div>
				</div>
				<div class="clearfix alignC">
					<button id="button" onclick="gen_button_hdl()">GENERATE</button>
				</div>
			</div>
			<div id="right"></div>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>