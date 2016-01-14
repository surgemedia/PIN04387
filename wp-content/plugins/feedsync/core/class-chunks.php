<?php
	
	/**
		Parses a big xml file and breaks it into smaller chunks
	**/

	class XMl_CHUNKS {
		
		protected $file_path;
		protected $count;
		protected $xml;
		protected $input_path = INPUT_PATH;
		
		function __construct($file_path,$count = FEEDSYNC_CHUNK_SIZE ) {
		
			$this->file_path 	= $file_path;
			$this->count 		= (int) $count;
			$this->filename		= basename($file_path);
			
		}
		
		function create_chunk() {
			
			$xmlFile = new DOMDocument('1.0');
			$xpath = new DOMXPath($xmlFile);
			$xmlFile->formatOutput = true;
			$xmlFile->recover = TRUE;
			$xmlFile->load($this->file_path);
			$items = $xmlFile->documentElement;
			
			//echo $xmlFile->documentElement->childNodes->length; die;
			
			if( !empty($items) ) {
				$item_counter = 1;
				$this->xml = $this->header();
				foreach($items->childNodes as $item) { 
					
					if( isset($item->tagName) && !is_null($item->tagName) ) {
						
						$this->xml .= $xmlFile->saveXML( $item);
						
						if($item_counter == $this->count) {
						
							$this->xml .= $this->footer();
							
							//** create chunk files
							$chunk_name = $this->input_path.'/'.uniqid().$this->filename;
							if ( $file_handle = @fopen($chunk_name , 'a' ) ) {
								fwrite( $file_handle, $this->xml );
								fclose( $file_handle );
								@chmod($chunk_name, 0755); 
							}
							
							/** reset counter **/
							$item_counter = 0;
							
							/** add header **/
							$this->xml = $this->header();
							
							continue;
						}
						
						$item_counter++;
						
					}
				}
				$this->xml .= $this->footer();
			}
			
			//** create chunk files
			$chunk_name = $this->input_path.'/'.uniqid().$this->filename;
			if ( $file_handle = @fopen($chunk_name , 'a' ) ) {
				fwrite( $file_handle, $this->xml );
				fclose( $file_handle );
				@chmod($chunk_name, 0755); 
			}
			
			@rename($this->file_path,PROCESSED_PATH.basename($this->file_path) ); 
		}
		
		
		function header() {
			return  '<?xml version="1.0" standalone="no"?>
			<!DOCTYPE propertyList SYSTEM "http://reaxml.realestate.com.au/propertyList.dtd">
			<propertyList>'."\n";
		}
		
		function footer() {
			return '</propertyList>';
		}
		
	}

