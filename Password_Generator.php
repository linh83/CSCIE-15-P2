<?php
	// ======================= DECLARE CONSTANT AND GLOBAL VARIABLE =======================
	/*
	 * The element of this array point at the positions in word list file
	 * Eg:
	 * 		$word_len_arr[0] point at first word having lenghth equal to 1
	 * 	  	$word_len_arr[1] point at first word having lenghth equal to 2
	 * 		...
	 * 		$word_len_arr[k] point at first word having lenghth equal to k+1
	 */ 
	$word_len_arr = array(0, 1, 248, 1417, 5007, 12268, 24556, 42495, 63701, 85231, 104879, 120877, 132695);
	define("WORD_LEN_ARR_SIZE", 12);
	define("WORD_LIST_FILE_NAME", "./dictionary/UK_Dictionary.dic");
	$special_symbols = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")");
	
	// ======================= DECLARE FUNCTION =======================
	/*
	 * @brief		Generate a word with $word_len size 
	 * @params	
	 * 		$word_len	
	 * 				Length of the word
	 * @return 		random word
	 */
	function word_gen($word_len){
		global $word_len_arr;
		if ($word_len > WORD_LEN_ARR_SIZE) return "";
		$wordlist_file = new SplFileObject(WORD_LIST_FILE_NAME);
		$first_word_pos = $word_len_arr[$word_len-1];	//Get the position of the first word in word list file
		$num_of_word = $word_len_arr[$word_len] - $word_len_arr[$word_len-1];	//Get number of word which have len = $word_len
		$wordlist_file->seek($first_word_pos + rand(0, $num_of_word));     // Seek to line no. 10,000
		return trim($wordlist_file->current()); // Print contents of that line		
	}
	
	// =====================================================================
	/* @brief 		create 2 string of number to append with password
	 * @params		
	 * 		$num_type	random number or custom number
	 * 		$num_size	number of number character appended
	 * 		$after_size	number of number character appended at the end of password
	 * 		$custom_num	use for custom type
	 * @return 		Array
	 * 		[['before']=>"1111", ['after']=>"111"] 
	 * @note
	 * 		'before': 	appended at the head of the password
	 * 		'after':	appended at the tail of the password
	 */ 
	function number_gen($num_type, $num_size, $after_size, $custom_num){
		$num_str = array();
		$num_str['before'] = "";
		$num_str['after'] = "";
		switch ($num_type) {
			case "c":				
				for ($i = 0; $i < ($num_size-$after_size); $i++)
					$num_str['before'] .= $custom_num;				
				for ($i = 0; $i < $after_size; $i++)
					$num_str['after'] .= $custom_num;				
				break;
			case "r":
				$random_num = rand(0, 9);
				for ($i = 0; $i < ($num_size-$after_size); $i++)
					$num_str['before'] .= $random_num;				
				for ($i = 0; $i < $after_size; $i++)
					$num_str['after'] .= $random_num;				
				break;
			default:				
		}
		return $num_str;
	}
	
	// =====================================================================
	/* @brief 		create 2 string of special symbols to append with password
	 * @params		
	 * 		$num_type	random special symbol or custom special symbol
	 * 		$num_size	number of special symbol appended
	 * 		$after_size	number of special symbol appended at the end of password
	 * 		$custom_num	use for custom type
	 * @return 		Array
	 * 		[['before']=>"###", ['after']=>"#"] 
	 * @note
	 * 		'before': 	appended at the head of the password
	 * 		'after':	appended at the tail of the password
	 */  
	function special_symbol_gen($ss_type, $ss_size, $after_size, $custom_ss){
		global $special_symbols;		
		$ss_str = array();
		$ss_str['before'] = "";
		$ss_str['after'] = "";		
		switch ($ss_type) {
			case "c":
				for ($i = 0; $i < ($ss_size-$after_size); $i++)
					$ss_str['before'] .= $special_symbols[$custom_ss];				
				for ($i = 0; $i < $after_size; $i++)
					$ss_str['after'] .= $special_symbols[$custom_ss];				
				break;
			case "r":
				$random_ss = $special_symbols[rand(0, 9)];
				for ($i = 0; $i < ($ss_size-$after_size); $i++)
					$ss_str['before'] .= $random_ss;				
				for ($i = 0; $i < $after_size; $i++)
					$ss_str['after'] .= $random_ss;				
				break;
			default:
		}
		return $ss_str;
	}
	
	// =====================================================================
	/* @brief	Add case tranform to array of words
	 * @params
	 * 		&$words		array of words which is transformed
	 * 		$case_tfm_type
	 * 					type of case transform
	 * @return	none
	 */ 
	function add_case_transform(&$words, $case_tfm_type){
		switch ($case_tfm_type) {
			case "all_lower":				
				break;
			case "all_upper":
				for ($i = 0; $i < count($words); $i++)
					$words[$i] = strtoupper($words[$i]);				
				break;
			case "first_char":
				for ($i = 0; $i < count($words); $i++)
					$words[$i] = ucfirst($words[$i]);				
				break;
			default: 
		}
	}

	// =====================================================================
	function add_num(&$password, $num_type, $num_size, $custom_num){		
		$numbers_str = number_gen($num_type, $num_size, $num_size, $custom_num);
		$password = $password . $numbers_str['after'];
		$password = $numbers_str['before'] . $password; 	
	}
	
	// =====================================================================
	function add_ss(&$password, $ss_type, $ss_size, $custom_ss){
		$special_symbols_str = special_symbol_gen($ss_type, $ss_size,$ss_size, $custom_ss);
		$password = $password . $special_symbols_str['after'];
		$password = $special_symbols_str['before'] . $password;
	}
	
	// =====================================================================
	/* @brief		Insert separated character into password
	 * @params		
	 * 		$words
	 * 				Array of words
	 * 		$sepa_type
	 * 				Type of separator
	 * @return
	 * 		a password (string format) with separator
	 */ 
	function add_sepa($words, $sepa_type){
		$xkcd_pass_tem = "";
		for ($i = 0; $i < count($words); $i++){
			$xkcd_pass_tem .= $words[$i];
			if ($i == count($words)-1) 
				break;			
			switch ($sepa_type) {
				case "space":
					$xkcd_pass_tem .= " ";
					break;
				case "hyphen":
					$xkcd_pass_tem .= "-";
					break;
				default:
			}
		}
		return $xkcd_pass_tem;
	}
?>	

<?php
	// ======================= MAIN CODE =======================	
	/*
	 * Data in post query:
	 * num_word			number of word generated
	 * max_length		maximum length of password
	 * incl_num			whether include number in password
	 * incl_num_type	random number or custom number
	 * incl_num_size	how many numbers are included? 	
	 * incl_ss			whether include special symbol
	 * incl_ss_type		random special symbol or custom special symbol
	 * incl_ss_size		how many special symbols are included?
	 * separation_type	what is separator?
	 * case_tfm_type	what is case transform?
	 */ 
	/* Initialize local variable */
	$num_word = 0;
	$max_length = 0;
	$incl_num = "false";
	$incl_num_type = "r";
	$incl_num_size = 0;
	$incl_num_cus_val = 0;
	$incl_ss = "false";
	$incl_ss_type = "r";
	$incl_ss_size = 0;
	$incl_ss_cus_val = 0;
	$sepa_type = "none";
	$case_tfm_type = "all_lower";  
	/* scan all of data in post query */
	if (isset($_POST['num_word']))
		$num_word = $_POST['num_word'];
	
	if (isset($_POST['max_length']))
		$max_length = $_POST['max_length'];
	
	if (isset($_POST['incl_num']))		
		$incl_num = $_POST['incl_num'];
	
	if (isset($_POST['incl_num_type']))
		$incl_num_type = $_POST['incl_num_type'];
	
	if (isset($_POST['incl_num_size']))
		$incl_num_size = $_POST['incl_num_size'];
	
	if (isset($_POST['incl_num_cus_val']))
		$incl_num_cus_val = $_POST['incl_num_cus_val'];
	
	if (isset($_POST['incl_ss']))
		$incl_ss = $_POST['incl_ss'];
	
	if (isset($_POST['incl_ss_type']))
		$incl_ss_type = $_POST['incl_ss_type'];
	
	if (isset($_POST['incl_ss_size']))
		$incl_ss_size = $_POST['incl_ss_size'];
	
	if (isset($_POST['incl_ss_cus_val']))
		$incl_ss_cus_val = $_POST['incl_ss_cus_val'];
	
	if (isset($_POST['separation_type']))
		$sepa_type = $_POST['separation_type'];
	
	if (isset($_POST['case_tfm_type']))
		$case_tfm_type = $_POST['case_tfm_type'];
		
	$xkcd_password = "";
	/* Calculate exact word average len
	 * Ex:
	 * 	Pass: 	123a-b-c-d23@@
	 *   Total len of words:	4
	 *   num_size				5
	 * 	 ss_size				2
	 * 	 separator				3
	 */
	if ($incl_num)
		$max_length -= $incl_num_size;		
	
	if ($incl_ss)
		$max_length -= $incl_ss_size;
	
	if ($sepa_type == "space" || $sepa_type == "hyphen")
		$max_length -= ($num_word-1);
	
	$word_average_len = floor($max_length/$num_word);
	if ($word_average_len > 0){
		$words = array();		//Store words temporarily before add number, special symbol, ...
		for ($i = 0; $i < $num_word; $i++){
			array_push($words, word_gen(rand(1, min(array(WORD_LEN_ARR_SIZE, $word_average_len)))));				 
			$max_length -= strlen($words[$i]);
			if ($i != $num_word-1)
				$word_average_len = floor($max_length/($num_word-$i-1));
			else
				$word_average_len = $max_length;			
		}		
		add_case_transform($words, $case_tfm_type);
		$xkcd_password = add_sepa($words, $sepa_type);			
		if ($incl_num == "true")
			add_num($xkcd_password, $incl_num_type, $incl_num_size, $incl_num_cus_val);
		
		if ($incl_ss == "true")
			add_ss($xkcd_password, $incl_ss_type, $incl_ss_size, $incl_ss_cus_val);			
		
	}
	echo $xkcd_password;
?>