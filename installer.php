<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

/******************************************************************
/* Install the DB Table
******************************************************************/
function webplayer_db_install() {
	global $wpdb;
	global $installed_webplayer_version;
	global $webplayer_version;	

	if ($installed_webplayer_version != $webplayer_version) {
    	$table_name = $wpdb->prefix . "webplayer";
		$sql = "CREATE TABLE " . $table_name . " (
  		`id` int(5) NOT NULL AUTO_INCREMENT,
		`videoid` int(5) NOT NULL,
		`playlistid` int(5) NOT NULL,
  		`width` int(5) NOT NULL,
  		`height` int(5) NOT NULL,
		`skinmode` varchar(20) NOT NULL,
  		`stretchtype` varchar(20) NOT NULL,
  		`buffertime` int(3) NOT NULL,
  		`volumelevel` int(3) NOT NULL,
  		`autoplay` tinyint(4) NOT NULL,
		`playlistautoplay` tinyint(4) NOT NULL,
  		`playlistopen` tinyint(4) NOT NULL,
  		`playlistrandom` tinyint(4) NOT NULL,
		`controlbar` tinyint(4) NOT NULL,
  		`playpause` tinyint(4) NOT NULL,
  		`progressbar` tinyint(4) NOT NULL,
  		`timer` tinyint(4) NOT NULL,
  		`share` tinyint(4) NOT NULL,
  		`volume` tinyint(4) NOT NULL,
  		`fullscreen` tinyint(4) NOT NULL,
  		`playdock` tinyint(4) NOT NULL,
		`playlist` tinyint(4) NOT NULL,
		UNIQUE KEY (`id`)
		);";
   		dbDelta($sql);
		
		$table_name = $wpdb->prefix . "webplayer_license";
		$sql = "CREATE TABLE " . $table_name . " (
  		`id` int(5) NOT NULL AUTO_INCREMENT,
  		`licensekey` varchar(50) NOT NULL,
  		`logo` varchar(255) NOT NULL,
  		`logoposition` varchar(15) NOT NULL,
  		`logoalpha` int(3) NOT NULL,
  		`logotarget` varchar(255) NOT NULL,
		UNIQUE KEY (`id`)
		);";
   		dbDelta($sql);
		
		$table_name = $wpdb->prefix . "webplayer_videos";
		$sql = "CREATE TABLE " . $table_name . " (
  		`id` int(5) NOT NULL AUTO_INCREMENT,
		`playlistid` int(5) NOT NULL,
		`title` varchar(255) NOT NULL,
  		`type` varchar(20) NOT NULL,
  		`streamer` varchar(255) NOT NULL,
  		`dvr` tinyint(4) NOT NULL,
  		`video` varchar(255) NOT NULL,
  		`hdvideo` varchar(255) NOT NULL,
  		`preview` varchar(255) NOT NULL,
		`thumb` varchar(255) NOT NULL,
  		`token` varchar(255) NOT NULL,
		UNIQUE KEY (`id`)
		);";
   		dbDelta($sql);
		
		$table_name = $wpdb->prefix . "webplayer_playlist";
		$sql = "CREATE TABLE " . $table_name . " (
  		`id` int(5) NOT NULL AUTO_INCREMENT,
  		`name` varchar(255) NOT NULL,
		UNIQUE KEY (`id`)
		);";
   		dbDelta($sql);
		
		add_option( "webplayer_version", $webplayer_version );
	}
}

/******************************************************************
/* Add data to the installed DB Table
******************************************************************/
function webplayer_db_install_data() {
	global $wpdb;
	global $installed_webplayer_version;
	global $webplayer_version;

	if ($installed_webplayer_version != $webplayer_version) {
		$table_name = $wpdb->prefix . "webplayer";	
		$wpdb->insert($table_name, array( 
		'id'               => 1,
		'videoid'          => 1,
		'playlistid'       => 0,
		'width'            => 640, 
		'height'           => 360, 
		'skinmode'         => 'static',
  		'stretchtype'      => 'fill',
  		'buffertime'       => 3,
  		'volumelevel'      => 50,
  		'autoplay'         => 0,
		'playlistautoplay' => 0,
  		'playlistopen'     => 0,
  		'playlistrandom'   => 0,
		'controlbar'       => 1,
  		'playpause'        => 1,
  		'progressbar'      => 1,
  		'timer'            => 1,
  		'share'            => 1,
  		'volume'           => 1,
  		'fullscreen'       => 1,
  		'playdock'         => 1,
		'playlist'         => 1
		));
		
		$table_name = $wpdb->prefix . "webplayer_license";	
		$wpdb->insert( $table_name, array( 
		'id'               => 1,
		'licensekey'       => 'HD_Webplayer_Commercial_Key', 
		'logo'             => 'logo.jpg', 
		'logoposition'     => 'topleft',
		'logoalpha'        => 50,
		'logotarget'       => 'http://hdwebplayer.com'
		));
		
		$table_name = $wpdb->prefix . "webplayer_videos";	
		$wpdb->insert( $table_name, array( 
		'id'               => 1,
		'title'            => 'Sample Video',
		'type'             => 'video',
		'streamer'         => '',
		'dvr'              => 0,
		'video'            => 'http://hdwebplayer.com/player/videos/300.mp4',
		'hdvideo'          => '',
		'preview'          => '',
		'thumb'            => '',
		'token'            => '',
		'playlistid'       => 0
		));
	}
}

/******************************************************************
/* Check for Update
******************************************************************/
function webplayer_update_db_check() {
	 global $webplayer_version;
     if (get_site_option('webplayer_version') != $webplayer_version) {
        update_option( "webplayer_version", $webplayer_version );
     }
}
    
?>