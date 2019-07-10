<?php

header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
define('DONOTCACHEPAGE', 1);

ini_set('max_execution_time', 3600);
set_time_limit(60 * 60);

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set("log_errors", 1);
ini_set("error_log", "debug.log");

if (!isset($_GET['run'])) die('...');

$folder_path = explode('wp-content', __DIR__);
	$folder_path = $folder_path[0].'wp-content/uploads/builder/assets/img/';
	if (!file_exists($folder_path)) die('builder assets img folder missing.');

$colors = array(
	'natural' => array('folder' => 'export-folder-Natural'),
	'black' => array('folder' => 'export-folder-HP-black'),
	'white' => array('folder' => 'export-folder-HP-white'),
	'bronze' => array('folder' => 'export-folder-HP-bronze'),
	'vintage-lantern' => array('folder' => 'export-folder-HP-vintage-lantern'),
	);

$treads = array(
	'smooth-plate-open-ends' => array('folder' =>'Smooth_Plate_with_Open_End'),
	'smooth-plate-closed-ends' => array('folder' =>'Smooth_Plate_with_Closed_End'),
	'diamond-plate-open-ends' => array('folder' =>'Diamond_Plate_with_Open_End'),
	'diamond-plate-closed-ends' => array('folder' =>'Diamond_Plate_with_Closed_End'),
	);

$coverings = array(
	'no-tread-covering' => array('folder' =>'No_Covering'),
	'fire-pit' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-fire-pit', 'source-hp' => 'export-folder-hp-fire-pit'),
	'gravel-path' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-gravel-path', 'source-hp' => 'export-folder-hp-gravel-path'),
	'havana-gold' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-havana-gold', 'source-hp' => 'export-folder-hp-havana-gold'),
	'island-mist' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-island-mist', 'source-hp' => 'export-folder-hp-island-mist'),
	'lava-rock' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-lava-rock', 'source-hp' => 'export-folder-hp-lava-rock'),
	'rope-swing' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-rope-swing', 'source-hp' => 'export-folder-hp-rope-swing'),
	'spiced-rum' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-spiced-rum', 'source-hp' => 'export-folder-hp-spiced-rum'),
	'tiki-torch' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-tiki-torch', 'source-hp' => 'export-folder-hp-tiki-torch'),
	'tree-house' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-tree-house', 'source-hp' => 'export-folder-hp-tree-house'),
	'vintage-lantern' => array('folder' =>'Trex', 'source-natural' => 'export-folder-natural-vintage-lantern', 'source-hp' => 'export-folder-hp-vintage-lantern'),
	);

$spindles = array(
	'square' => array('folder' =>'Square_Spindle'),
	'round' => array('folder' =>'Round_Spindle'),
	'multiline' => array('folder' =>'Multiline_Spindle', 'source-hp' => 'export-folder-HP'),
	);

$lightings = array(
	'no-lighting-kit' => array('folder' =>'No_Lighting_Kit'),
	'lighting-kit' => array('folder' =>'Lighting_Kit'),
	);

$images = array(
	'pole' => array('filename' => 'Center_Pole.png'),
	'handrail-top' => array('filename' => 'Handrail.png'),
	'handrail-bottom' => array('filename' => 'Handrail_Middle_Section.png'),
	'lighting-kit' => array('filename' => 'Lighting_Kit.png'),
	'spindle' => array('filename' => 'Spindle.png'),
	'tread' => array('filename' => 'Tread.png'),
	'tread-covering' => array('filename' => 'Trex_Covering.png'),
	);

foreach ($colors as $color => $color_meta) {
	
	// color folder
	if (!file_exists($folder_path.$color.'/')) mkdir($folder_path.$color);

	foreach ($treads as $tread => $tread_meta) {
		
		foreach ($coverings as $covering => $covering_meta) {
			
			foreach ($spindles as $spindle => $spindle_meta) {

				foreach ($lightings as $lighting => $lighting_meta) {

					foreach ($images as $image => $image_meta) {

						// set patha
						$color_path = $color_meta['folder'];
						$spindle_path = $spindle_meta['folder'];

						// alter color path for various trex colors
						if ($image == 'tread-covering') {
							switch ($color) {
								case 'natural':
									
									if (isset($covering_meta['source-natural']) && !empty($covering_meta['source-natural'])) {
										$color_path = $covering_meta['source-natural'];
									}

									break;
								
								default:
									
									if (isset($covering_meta['source-hp']) && !empty($covering_meta['source-hp'])) {
										$color_path = $covering_meta['source-hp'];
									}

									break;
							}
						}

						// alter color path for multiline spindle
						if ($image == 'spindle' && $color != 'natural') {
							switch ($spindle) {
								case 'multiline':
									
									if (isset($spindle_meta['source-hp']) && !empty($spindle_meta['source-hp'])) {
										$color_path = $spindle_meta['source-hp'];
									}

									break;
								
								default:

									break;
							}
						}

						$copy = true;
						
						switch ($tread) {
							case 'diamond-plate-open-ends':
							case 'diamond-plate-closed-ends':
								$file = $folder_path.'renderings/'.$color_path.'/'.$tread_meta['folder'].'/'.$tread_meta['folder'].'__'.$spindle_path.'__'.$lighting_meta['folder'].'/'.$image_meta['filename'];

								//if ($covering == 'trex') $copy = false;
								break;
							
							default:
								$file = $folder_path.'renderings/'.$color_path.'/'.$tread_meta['folder'].'/'.$tread_meta['folder'].'__'.$covering_meta['folder'].'__'.$spindle_path.'__'.$lighting_meta['folder'].'/'.$image_meta['filename'];
								break;
						}						
						//echo $file.'<br>';

						if (file_exists($file) && $copy) {

							$new_file = $folder_path.$color.'/'.$tread.'-'.$covering.'-'.$spindle.'-'.$lighting.'-'.$image.'.png';
							//echo $new_file.'<br><br>';

							$result = copy($file, $new_file);

							if (!$result) die('There was a problem copying file '.$file.' --->>> '.$new_file);

						} else {
							if ($lighting == 'no-lighting-kit' && $image == 'lighting-kit') continue;
							if ($tread == 'smooth-plate-open-ends' && $covering == 'no-tread-covering' && $image == 'tread-covering') continue;
							if ($tread == 'smooth-plate-closed-ends' && $covering == 'no-tread-covering' && $image == 'tread-covering') continue;
							if ($tread == 'diamond-plate-open-ends' && $image == 'tread-covering') continue;
							if ($tread == 'diamond-plate-closed-ends' && $image == 'tread-covering') continue;
							if ($color != 'natural' && $image == 'pole') continue;
							echo 'Not Found ->>>> ';
							echo $file.'<br><br>';

						}

						// debug
						//die('test done');

					}

				}

			}

		}

	}

}

