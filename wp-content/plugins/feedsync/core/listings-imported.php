<?php
/*
Title: XML Feed Processor Help Page
Program Author URI: http://realestateconnected.com.au/
Description: Program created and written to process Australian REAXML feed for easy import into WordPress. 
The program will process the input files that are places in the XML directory from your feed provider and save the results into 
three XML output files in the /feedsync/outputs directory. These files contain the results of the input files.

Author: Merv Barrett
Author URI: http://realestateconnected.com.au/

Version: 2.0

*/
	require_once('../config.php');
	require_once('functions.php');

	global $feedsync_db;
	$page_now = 'imported';
	get_header('Imported');
	get_listings_sub_header( $page_now );
?>

		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">XML Files</div>

			<?php
			# The current directory
			$directory = dir(PROCESSED_PATH);
			
			# If you want to turn on Extension Filter, then uncomment this:
			### $allowed_ext = array(".sample", ".png", ".jpg", ".jpeg", ".txt", ".doc", ".xls"); 
			$allowed_ext = array(".xml", ".XML"); 



			## Description of the soft: list_dir_files.php  
			## Major credits: phpDIRList 2.0 -(c)2005 Ulrich S. Kapp :: Systemberatung ::

			$do_link = TRUE; 
			$sort_what = 0; //0- by name; 1 - by size; 2 - by date
			$sort_how = 0; //0 - ASCENDING; 1 - DESCENDING


			# # #
			function dir_list($dir){ 
				$i=0; 
				$dl = array(); 
				if ($hd = opendir($dir))    { 
					while ($sz = readdir($hd)) {  
						if (preg_match("/^\./",$sz)==0) $dl[] = $sz;$i.=1;  
					} 
				closedir($hd); 
				} 
				asort($dl); 
				return $dl; 
			} 
			if ($sort_how == 0) { 
				function compare0($x, $y) {  
					if ( $x[0] == $y[0] ) return 0;  
					else if ( $x[0] < $y[0] ) return -1;  
					else return 1;  
				}  
				function compare1($x, $y) {  
					if ( $x[1] == $y[1] ) return 0;  
					else if ( $x[1] < $y[1] ) return -1;  
					else return 1;  
				}  
				function compare2($x, $y) {  
					if ( $x[2] == $y[2] ) return 0;  
					else if ( $x[2] < $y[2] ) return -1;  
					else return 1;  
				}  
			}else{ 
				function compare0($x, $y) {  
					if ( $x[0] == $y[0] ) return 0;  
					else if ( $x[0] < $y[0] ) return 1;  
					else return -1;  
				}  
				function compare1($x, $y) {  
					if ( $x[1] == $y[1] ) return 0;  
					else if ( $x[1] < $y[1] ) return 1;  
					else return -1;  
				}  
				function compare2($x, $y) {  
					if ( $x[2] == $y[2] ) return 0;  
					else if ( $x[2] < $y[2] ) return 1;  
					else return -1;  
				}  

			} 

			################################################## 
			#    We get the information here 
			################################################## 

			$i = 0; 
			while($file=$directory->read()) { 
				//$file = strtolower($file);
				$ext = strrchr($file, '.');
				if (isset($allowed_ext) && (!in_array($ext,$allowed_ext)))
					{
						// dump 
					}
				else { 
					$temp_info = stat(PROCESSED_PATH.$file); 
					$new_array[$i][0] = $file; 
					$new_array[$i][1] = $temp_info[7]; 
					$new_array[$i][2] = $temp_info[9]; 
					$new_array[$i][3] = date("F d, Y", $new_array[$i][2]); 
					$i = $i + 1; 
				} 
			} 
			$directory->close(); 

			################################################## 
			# We sort the information here 
			################################################# 

			if(!empty($new_array)) {
				switch ($sort_what) { 
					case 0: 
							usort($new_array, "compare0"); 
					break; 
					case 1: 
							usort($new_array, "compare1"); 
					break; 
					case 2: 
							usort($new_array, "compare2"); 
					break; 
				}
			} 

			############################################################### 
			#    We display the infomation here 
			############################################################### 

			$i2 = count($new_array); 
			$i = 0; 
			?>
			<table class="table"> 
				<tr> 
					<td width=150> File name</td> 
					<td width=100> File Size</td> 
					<td width=100>Last Modified</td> 
				</tr>
			
					<?php				
					for ($i=0;$i<$i2;$i++) { 
						if (!$do_link) { 
							$line = "<tr><td>" .  
											$new_array[$i][0] .  
											"</td><td>" .  
											number_format(($new_array[$i][1]/1024)) .  
											"k"; 
							$line = $line  . "</td><td>" . $new_array[$i][3] . "</td></tr>"; 
						}else{ 
							$line = '<tr><td><A HREF="'.PROCESSED_URL .   
											$new_array[$i][0] . '">' .  
											$new_array[$i][0] .  
											"</A></td><td>"; 
							$line = $line . number_format(($new_array[$i][1]/1024)) .  
											"k"  . "</td><td>" .  
											$new_array[$i][3] . "</td></tr>"; 
						} 
						echo $line; 
					} 
					?>
			</table>
		</div>
		
<?php echo get_footer(); ?>
