<?php

namespace opening\Classes;

class Database {

    static public function generateTables()
    {
        // WP variable
        global $wpdb;

        // define table name with prefix    
        $tableName = $wpdb->prefix . 'orga-event_date';
  
        $charsetCollate = $wpdb->get_charset_collate();

        $sql = "
            CREATE TABLE IF NOT EXISTS `{$tableName}` (
                `event_id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                `organiser_id` INT(20) UNSIGNED NOT NULL,
                `date` DATE NOT NULL,
                PRIMARY KEY(`event_id`, `organiser_id`)
            ) {$charsetCollate};
        ";
       
        $wpdb->query($sql);
    }
}
