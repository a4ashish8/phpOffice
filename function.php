<?php

// delete previous files
function delete_previous_files($path, $type)
{
	$files = glob($path);

	foreach ($files as $file) {
		$explode_path = explode("/", $file);
		if ($type == "eco_system" or $type == "mkt_calculator") {
			$explode_type = $explode_path[7];
		} else {
			$explode_type = $explode_path[3];
		}

		if (is_file($file)) {
			if ($explode_type != "index.html") {
				unlink($file);
			}
		}
	}
}



function check_is_val($val)
{
	if (is_nan($val)) {
		$value = 0;
	} elseif (is_infinite($val)) {
		$value = 0;
	} else {
		$value = $val;
	}
	return $value;
}

function content_limit($text, $wrap = 230, $read_txt = "")
{
	$len = strlen($text);
	if ($len > $wrap)
		$str = substr($text, 0, $wrap) . ".." . $read_txt;
	else
		$str = $text;
	return $str;
}


function table_column_width($max_str_arr, $module_name = '')
{

	$halfWidth = 890;
	if ($module_name == 'account_planning') {
		$divider = 23;
		$ac_text = 4;
	} else {
		$divider = 19;
		$ac_text = 0;
	}
	$plan_column_width = array();
	$total_sum = array_sum(array_values($max_str_arr));

	if ($module_name == 'partner_profile') {
		$total_width =  1800;
	} else {
		$total_width = ceil(count($max_str_arr)) > 5 ? 1800 : 890;
	}


	asort($max_str_arr);
	foreach ($max_str_arr as $col_key => $col_length) {
		if ($col_length == 'New Smart Table') {
			continue;
		}
		$col_width = ceil(($total_width / $total_sum) * $col_length);
		if ($col_width <= 180) {
			if ($col_length < 32) {
				$total_width -= 120;
				$total_sum -= $col_length;
				$plan_column_width['column_width'][$col_key] = 120;
				$plan_column_width['str_length'][$col_key] = 13 + $ac_text;
			} else {
				$total_width -= 180;
				$total_sum -= $col_length;
				$plan_column_width['column_width'][$col_key] = 180;
				$plan_column_width['str_length'][$col_key] = 24 + $ac_text;
			}
			continue;
		}
		$plan_column_width['column_width'][$col_key] = $col_width;
		$plan_column_width['str_length'][$col_key] = ceil((($divider / 150) * $col_width));
	}
	return $plan_column_width;
}

function calculate_max_lines($standard_str, $custom_data_str)
{
	$max_line_arr = array(0);
	foreach ($standard_str as $col_key => $standard_length) {
		if ($custom_data_str[$col_key] == 'New Smart Table') {
			$max_line_arr[$col_key] = 0;
			continue;
		}
		$max_line_arr[$col_key] = ceil($custom_data_str[$col_key] / $standard_length);
	}
	return max(array_values($max_line_arr));
}

function table_max_lines($standard_str, $custom_data_str)
{
	$max_line_arr = array();
	foreach ($standard_str as $col_key => $standard_length) {
		$max_line_arr[$col_key] = ceil(strlen($custom_data_str[$col_key]) / $standard_length);
	}
	return max(array_values($max_line_arr));
}
