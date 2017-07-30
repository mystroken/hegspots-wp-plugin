<?php

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();

$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_activities (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  slug varchar(255) NOT NULL UNIQUE,
  name varchar(100) NOT NULL,

  PRIMARY KEY (ID)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_locations (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  slug varchar(255) NOT NULL,
  town varchar(50) NOT NULL,
  country varchar(50) NOT NULL,

  PRIMARY KEY (ID),
  UNIQUE KEY {$wpdb->prefix}hegspots_locations_town_country_unique (town, country)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_map_positions (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  lat double(8,2) NOT NULL,
  lng double(8,2) NOT NULL,

  PRIMARY KEY (ID),
  UNIQUE KEY {$wpdb->prefix}hegspots_map_positions_lat_lng_unique (lat, lng)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_members (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  slug varchar(255) NOT NULL UNIQUE,
  name varchar(50) NOT NULL,
  profile_id int(10) UNSIGNED DEFAULT NULL,
  location_id int(10) UNSIGNED NOT NULL,
  instagram varchar(50) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,

  PRIMARY KEY (ID),
  KEY {$wpdb->prefix}hegspots_members_profile_id_foreign (profile_id),
  KEY {$wpdb->prefix}hegspots_members_location_id_foreign (location_id)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_members_activities (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  activity_id int(10) UNSIGNED NOT NULL,
  member_id int(10) UNSIGNED NOT NULL,

  PRIMARY KEY (ID),
  KEY {$wpdb->prefix}hegspots_members_activities_activity_id_foreign (activity_id),
  KEY {$wpdb->prefix}hegspots_members_activities_member_id_foreign (member_id)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_members_recommandations (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  place_id int(10) UNSIGNED NOT NULL,
  member_id int(10) UNSIGNED NOT NULL,

  PRIMARY KEY (ID),
  KEY {$wpdb->prefix}hegspots_members_recommandations_place_id_foreign (place_id),
  KEY {$wpdb->prefix}hegspots_members_recommandations_member_id_foreign (member_id)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_places (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  slug varchar(255) NOT NULL UNIQUE,
  name varchar(100) NOT NULL,
  description text ,
  photo text, 
  type_place_id int(10) UNSIGNED NOT NULL,
  location_id int(10) UNSIGNED NOT NULL,
  map_position_id int(10) UNSIGNED DEFAULT NULL,
  instagram varchar(50) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,

  PRIMARY KEY (ID),
  KEY {$wpdb->prefix}hegspots_places_type_place_id_foreign (type_place_id),
  KEY {$wpdb->prefix}hegspots_places_location_id_foreign (location_id),
  KEY {$wpdb->prefix}hegspots_places_map_position_id_foreign (map_position_id)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_profiles (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  photo text, 
  watch varchar(100) DEFAULT NULL,
  bag varchar(100) DEFAULT NULL,
  book varchar(100) DEFAULT NULL,
  grooming varchar(100) DEFAULT NULL,
  style_icon varchar(100) DEFAULT NULL,
  brand varchar(100) DEFAULT NULL,

  PRIMARY KEY (ID)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_types_place (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  slug varchar(255) NOT NULL UNIQUE,
  name varchar(100) NOT NULL,
  description text,
  photo text,

  PRIMARY KEY (ID)
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_profiles (
  ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  photo text,
  watch varchar(100) DEFAULT NULL,
  bag varchar(100) DEFAULT NULL,
  book varchar(100) DEFAULT NULL,
  grooming varchar(100) DEFAULT NULL,
  style_icon varchar(100) DEFAULT NULL,
  brand varchar(100) DEFAULT NULL,

  PRIMARY KEY (ID)
) ENGINE=InnoDB {$charset_collate};");


// CONTRAINTS



$wpdb->query("ALTER TABLE {$wpdb->prefix}hegspots_members
  ADD CONSTRAINT {$wpdb->prefix}hegspots_members_location_id_foreign FOREIGN KEY (location_id) REFERENCES {$wpdb->prefix}hegspots_locations (ID),
  ADD CONSTRAINT {$wpdb->prefix}hegspots_members_profile_id_foreign FOREIGN KEY (profile_id) REFERENCES {$wpdb->prefix}hegspots_profiles (ID);
");

$wpdb->query("ALTER TABLE {$wpdb->prefix}hegspots_members_activities
  ADD CONSTRAINT {$wpdb->prefix}hegspots_members_activities_activity_id_foreign FOREIGN KEY (activity_id) REFERENCES {$wpdb->prefix}hegspots_activities (ID) ON DELETE CASCADE,
  ADD CONSTRAINT {$wpdb->prefix}hegspots_members_activities_member_id_foreign FOREIGN KEY (member_id) REFERENCES {$wpdb->prefix}hegspots_members (ID) ON DELETE CASCADE;
");

$wpdb->query("ALTER TABLE {$wpdb->prefix}hegspots_members_recommandations
  ADD CONSTRAINT {$wpdb->prefix}hegspots_members_recommandations_member_id_foreign FOREIGN KEY (member_id) REFERENCES {$wpdb->prefix}hegspots_members (ID) ON DELETE CASCADE,
  ADD CONSTRAINT {$wpdb->prefix}hegspots_members_recommandations_place_id_foreign FOREIGN KEY (place_id) REFERENCES {$wpdb->prefix}hegspots_places (ID) ON DELETE CASCADE;
");

$wpdb->query("ALTER TABLE {$wpdb->prefix}hegspots_places
  ADD CONSTRAINT {$wpdb->prefix}hegspots_places_location_id_foreign FOREIGN KEY (location_id) REFERENCES {$wpdb->prefix}hegspots_locations (ID),
  ADD CONSTRAINT {$wpdb->prefix}hegspots_places_map_position_id_foreign FOREIGN KEY (map_position_id) REFERENCES {$wpdb->prefix}hegspots_map_positions (ID),
  ADD CONSTRAINT {$wpdb->prefix}hegspots_places_type_place_id_foreign FOREIGN KEY (type_place_id) REFERENCES {$wpdb->prefix}hegspots_types_place (ID);
");

/**
 * Attach the plugin uninstall hooks
 */
register_uninstall_hook(__FILE__, function() { include_once dirname(__FILE__) . '/app/uninstall.php'; });