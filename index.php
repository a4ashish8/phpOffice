<?php
error_reporting(E_ERROR);
include('function.php');
include('helper.php');
include('data.php');

include_once 'PhpPresentation/src/PhpPresentation/Autoloader.php';
include_once 'Common/src/Common/Autoloader.php';
\PhpOffice\PHPPresentation\Autoloader::register();
\PhpOffice\Common\Autoloader::register();

use PhpOffice\PhpPresentation\Autoloader;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Slide;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\AbstractShape;
use PhpOffice\PhpPresentation\DocumentLayout;
use PhpOffice\PhpPresentation\Shape\Drawing;
use PhpOffice\PhpPresentation\Shape\Group;
use PhpOffice\PhpPresentation\Shape\RichText;
use PhpOffice\PhpPresentation\Shape\RichText\BreakElement;
use PhpOffice\PhpPresentation\Shape\RichText\TextElement;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Bullet;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Fill;
use PhpOffice\PhpPresentation\Style\Border;
use \PhpOffice\PhpPresentation\Slide\Background\Image;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Area;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar3D;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Line;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Pie;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Pie3D;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Scatter;
use PhpOffice\PhpPresentation\Shape\Chart\Series;
use PhpOffice\PhpPresentation\Style\Shadow;
use PhpOffice\PhpPresentation\Shape\Drawing\File;

$oColor_border = new Color();

$client_name_head = 'Development';

$report_heading_name = $client_name_head . ' Account Profiles Report';
define('abs_path', 'C:/wamp64/www/PhpOffice');


$theme_setting['theme']  = "theme4";


define('BORDER_COLOR', 'a6a6a6');
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');
define('TBL_CONTENT_LIMIT', 570);
define('FONT_ITALIC', true);
define('HEADING_CELL_HEIGHT', '40');
define('CLIENT_NAME', $clientname);
define('PARTNER_NAME', 'Ashish Ranjan');
define('THEME_COLOR', '000000');
define('TH_FONTSIZE', '12');
define('TD_FONTSIZE', '12');
define('TD_COLOR', '333333');
define('TABLE_BG', "0d45a2");
define('color_2', "58c82d");
define('CELL_HEIGHT', '35');



define('ROOT_PATH', dirname(__DIR__));

$footer_content = "";

define('FOOTER_CONTENT', $footer_content);
define('REPORT_HEADING_NAME', $report_heading_name);

Autoloader::register();

$pageNumber = 1; //ppt page nUmber counter
/****************DEFAULT SETING END***********************/


/**************** PRESENTATION START***********************/

// set ppt dlide dimesion
$objPHPPresentation = new PhpPresentation();

$objPHPPresentation->getLayout()->setDocumentLayout(DocumentLayout::LAYOUT_CUSTOM, true)
	->setCX(1850,  DocumentLayout::UNIT_PIXEL)
	->setCY(890,  DocumentLayout::UNIT_PIXEL);

// Set properties
$objPHPPresentation->getDocumentProperties()->setCreator('SuccessfulchannelsAPP')->setLastModifiedBy('Successfulchannels Team');

$scorecard_counter = 1;
$tbl_counter = 1;
$customPPTArr  = array();

// remove first slide
$objPHPPresentation->removeSlideByIndex(0);

$partnerArr = array();

/*********** main Table **************/
$total_template = 1;
// for Counting of table header


/******************* intial Varibales  ********************************/

$old_max_lines += $total_max_lines;
$new_cam_slide = true;
$total_count = 1;
$headingOffsetY = 80;
$table_header_arr = array();
$actionplan_x_axis_val = 25;

$max_lines_limit = 40;
$row_count_limit  = 35;
$slideUse = 0;
$headingOffsetY1 = 0;
$setting['header_title'] = strtoupper($app_title['title']);

$tableCount = count_array($fieldHeading['fieldHeadingTitle']);
$tableCounter = 0;
$row_count = 0;
$total_max_lines  = 0;
if ($new_cam_slide == true) {
	$max_lines_limit = 40;
	$headingOffsetY = 80;
	$slide_counter++;
	$setting['slide_counter']  = $slide_counter;
	$currentSlide = createTemplatedSlide($objPHPPresentation, $setting);
	$actionplan_x_axis = $actionplan_x_axis_val;
	$table_side = 'odd';
	$old_max_lines = 0;
	$row_count_limit  = 35;
	$slideUse = 0;
}

$max_total_template = 2;
$table_width = 1800;
$table_size = 'full';
/******************* intial Varibales  ********************************/


/******************* PPT Code start here ****************************/

foreach ($fieldHeading['fieldHeadingTitle'] as $tableId => $column) {

	$countCustomColumn = count_array($fieldHeading['fieldHeadingTitle'][$tableId]);
	$columnWidth = table_column_width($fieldLen[$tableId], $module_key);

	if ($headingOffsetY > 650) {
		$headingOffsetY1 = $headingOffsetY;
	} else if ($headingOffsetY > 150 && $headingOffsetY <= 300 && count_array($FieldArr['fieldData'][$tableId]) < 5) {
		$headingOffsetY1 = $headingOffsetY1;
	} else if ($headingOffsetY > 80) {
		$headingOffsetY1 = 40;
	}
	$headingOffsetY1 = $headingOffsetY1 * 1.2;
	if ($headingOffsetY1 >= 680) {
		$total_max_lines = 0;
		$row_count = 0;
		$total_template = 0;
		$max_lines_limit = 40;
		$headingOffsetY = 100;
		$tableHeight = 0;
		$headingOffsetY1 = 0;
		$slide_counter++;
		$setting['slide_counter']  = $slide_counter;
		$currentSlide = createTemplatedSlide($objPHPPresentation, $setting);
		$actionplan_x_axis = $actionplan_x_axis_val;
		$table_side = 'odd';
		$old_max_lines = 0;
		$row_count_limit  = 35;
		$slideUse = 0;
		// break;
	}

	if ($countCustomColumn > 0) {
		for ($total_template = 1; $total_template < $max_total_template; $total_template++) {
			$shape0 = $currentSlide->createRichTextShape()
				->setWidth(1800)->setOffsetX($actionplan_x_axis)->setOffsetY($headingOffsetY + $headingOffsetY1);
			$textRun = $shape0->createTextRun($tableNameArr[$tableId])->getFont()->setBold(true)->setSize(18)->setColor($oColor_border->setRGB(color_2));
			$total_max_lines += 2;
			// create table1

			$row_max_lines = table_max_lines($columnWidth['str_length'], $column);
			$total_max_lines += $row_max_lines;
			$headingOffsetY1 += $row_max_lines * 16;


			$shape1 = $currentSlide->createTableShape($countCustomColumn);
			$shape1->setOffsetX($actionplan_x_axis);
			$shape1->setOffsetY($headingOffsetY + $headingOffsetY1);

			/******************* Header Row Start ********************************/

			$row = $shape1->createRow();

			$row->getFill()->setFillType(Fill::FILL_GRADIENT_LINEAR)
				->setRotation(90)
				->setStartColor($oColor_border->setRGB(TABLE_BG))
				->setEndColor($oColor_border->setRGB(TABLE_BG));

			foreach ($column as $key => $table_header) {
				$oCell = $row->nextCell()->setWidth($columnWidth['column_width'][$key]);

				$oCell->getBorders()->getTop()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));
				$oCell->getBorders()->getBottom()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));
				$oCell->getBorders()->getLeft()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));
				$oCell->getBorders()->getRight()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));

				$oCell->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_BOTTOM)->setMarginBottom(3);
				$header1 = $oCell->createTextRun($table_header);
				$header1->getFont()->setBold(true);
				$header1->getFont()->setSize(11);
				$header1->getFont()->setColor(new Color('FFFFFF'))->setItalic(FONT_ITALIC);
			}

			/******************* Header Row End ********************************/

			$tableData = array_keys($FieldArr['fieldData'][$tableId]);
			$tableDataCount = count($tableData);

			for ($i = 0; $i < $tableDataCount; $i++) {
				$pId = $tableData[$i];
				$partnerDataArr = $FieldArr['fieldData'][$tableId][$pId];

				if (inArray($pId, $partnerArr[$tableId])) {
					continue;
				}

				$row_max_lines = table_max_lines($columnWidth['str_length'], $partnerDataArr);
				$total_max_lines += $row_max_lines;
				$row_count++;

				$headingOffsetY = 135 + ($total_max_lines * 18);

				$headingOffsetY1 += ($row_max_lines + 1 * 18);
				$slideUse++;

				if ($total_max_lines > $max_lines_limit || $headingOffsetY1 >= 780) {
					$total_max_lines = 0;
					$row_count = 0;
					$total_template = 0;
					$max_lines_limit = 40;
					$headingOffsetY = 80;
					$tableHeight = 0;
					$headingOffsetY1 = 0;
					$slide_counter++;
					$setting['slide_counter']  = $slide_counter;
					$currentSlide = createTemplatedSlide($objPHPPresentation, $setting);
					$actionplan_x_axis = $actionplan_x_axis_val;
					$table_side = 'odd';
					$old_max_lines = 0;
					$row_count_limit  = 35;
					$slideUse = 0;
					break;
				}

				$partnerArr[$tableId][$pId] = $pId;

				$row1 = $shape1->createRow();
				$row1->getFill()->setFillType(Fill::FILL_GRADIENT_LINEAR)
					->setRotation(90)
					->setStartColor(new Color('FFFFFFFF'))
					->setEndColor(new Color('FFFFFFFF'));
				$row1->setHeight(0);

				foreach ($partnerDataArr as $fieldKey => $fieldVal) {
					$oCell = $row1->nextCell();
					$oCell->getBorders()->getTop()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));
					$oCell->getBorders()->getBottom()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));
					$oCell->getBorders()->getLeft()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));
					$oCell->getBorders()->getRight()->setLineStyle(Border::LINE_TRI)->setColor($oColor_border->setRGB(BORDER_COLOR));

					$oCell->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)
						->setVertical(Alignment::VERTICAL_CENTER)
						->setMarginLeft(3)
						->setMarginRight(3)
						->setMarginTop(2)
						->setMarginBottom(2);

					$oCell->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setMarginLeft(3)->setMarginRight(3)->setMarginTop(1)->setMarginBottom(1);

					$header1 = $oCell->createTextRun(displayHtmlSafe($fieldVal));
					$header1->getFont()->setSize(TD_FONTSIZE)->setItalic(FONT_ITALIC);
				}

				/******************* Table Body Row End ********************************/
			}

			$actionplan_x_axis  =  $actionplan_x_axis_val;
			$table_side = 'odd';
		}
	}
	$total_max_lines += $total_max_lines * .75;

	$tableCounter++;

	if ($tableCount == $tableCounter) {
		break;
	}
}

/******************* PPT Code End here ****************************/


// create slide template	
function createTemplatedSlide(PhpOffice\PhpPresentation\PhpPresentation $objPHPPresentation, $setting)
{
	$setting['header_year'] = '2025-static';

	// Create slide
	$slide = $objPHPPresentation->createSlide();


	if ($setting['module_type'] != "cover_page") {
		$left_divider = abs_path . "/resources/theme1.jpg";
		$header_line = abs_path . "/resources/ppt/header-line.png";
		$header_logo = abs_path . "/resources/logo.png";

		// echo $left_divider; die;

		if (file_exists($left_divider)) {
			$oBkgImage = new Image();
			$oBkgImage->setPath($left_divider);
			$slide->setBackground($oBkgImage);
		}
		if (file_exists($header_line)) {
			$shape = $slide->createDrawingShape();
			$shape->setPath($header_line)
				->setWidth(1850)
				->setOffsetX(10)
				->setOffsetY(65)
				->setResizeProportional(false);
		}

		if (file_exists($header_logo)) {
			$shape = $slide->createDrawingShape();
			$shape->setPath($header_logo)
				->setHeight(50)
				->setWidth(200)
				->setOffsetX(30)
				->setOffsetY(10)
				->setResizeProportional(false);
		}


		if ($setting['header_title']) {
			header_footer_title($objPHPPresentation, $slide, $setting['header_title'], 'Calibri', 20, color_2, 'none', 8, '', '1');
		}


		header_footer_title($objPHPPresentation, $slide, PARTNER_NAME, 'Calibri', '15', color_2, 'right', 3, 'italic', '0');
		header_footer_title($objPHPPresentation, $slide, REPORT_HEADING_NAME, 'Calibri', '15', color_2, 'right', 30, 'italic', '0');

		header_footer_title($objPHPPresentation, $slide, "Slide:" . $setting['slide_counter'], 'Calibri', '15', TABLE_BG, 'right', 860, 'italic', '0');

		if (FOOTER_CONTENT != "") {
			header_footer_title($objPHPPresentation, $slide, FOOTER_CONTENT, 'Calibri', '14', color_2, 'none', 860, 'italic', '0');
		}
	}
	return $slide;
}

function header_footer_title(PhpPresentation $objPHPPresentation, $slide, $header_title, $font_family, $font_size, $font_color, $font_alignment, $offsetY, $font_type, $is_font_bold)
{
	$font_type_style  = false;
	if ($font_type == "italic") {
		$font_type_style  = true;
	}
	$is_bold = 	false;
	if ($is_font_bold == 1) {
		$is_bold = 	true;
	}
	$oColor_border = new Color();
	$shape = $slide->createRichTextShape()
		->setHeight(20)
		->setWidth(1810)
		->setOffsetX(30)
		->setOffsetY($offsetY);
	$textRun = $shape->createTextRun($header_title)->getFont()->setName($font_family)->setBold($is_bold)->setSize($font_size)->setColor($oColor_border->setRGB($font_color))->setItalic($font_type_style);

	if ($font_alignment == 'left') {
		$shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
	} else if ($font_alignment == 'right') {
		$shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
	} else if ($font_alignment == 'none') {
		$shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
	}
}

function write($phpPresentation, $filename, $writers)
{

	$extension = 'pptx';
	foreach ($writers as $writer => $extension) {
		if (!is_null($extension)) {
			$xmlWriter = IOFactory::createWriter($phpPresentation, $writer);
			$xmlWriter->save(ROOT_PATH . "/phpOffice/results/$filename.$extension");
		} else {
		}
	}
}


$writers = array('PowerPoint2007' => 'pptx');
write($objPHPPresentation, $file_name, $writers);


header('Location: results/' . $file_name . '.pptx');
exit();
