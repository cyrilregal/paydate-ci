<!DOCTYPE html>
<html lang="fr">
	<head>
<?php 
		$meta_tags = array(
			
			// Author.
			//--------
			array (
				'name' => 'author',
				'content' => 'SAINT-PATRICE Arnaud'
			),
				
			// Description.
			//-------------
			array (
				'name' => 'description',
				'content' => $this->page_infos->description
			),
				
			// Keywords.
			//----------
			array (
				'name' => 'keywords',
				'content' => $this->page_infos->keywords
			),
				
			// Viewport.
			//----------
			array (
				'name' => 'viewport',
				'content' => 'width=device-width, initial-scale=1'
			),
			
			// Content type.
			//--------------
			array (
				'name' => 'Content-type',
				'content' => 'text/html; charset=utf-8',
				'type' => 'equiv'
			),
			
			// X-UA-Compatible.
			//-----------------
			array (
				'name' => 'X-UA-Compatible',
				'content' => 'IE=edge',
				'type' => 'equiv'
			),
				
		);
		
		echo meta($meta_tags);
		echo link_tag(IMG_FOLDER.'logo-base.png', 'icon', 'image/ico');
		echo title_tag($this->page_infos->title);
?>
	    
	</head>
	<body>
