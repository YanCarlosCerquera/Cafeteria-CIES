<?php

defined('BASEPATH') or exit('No direct script access allowed');
// Versión 1.0.1
class Migration_Version_101 extends CI_Migration
{

    public function up()
    {
        // Inicio tabla Usuario
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE,
                'null' => FALSE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
                'null' => FALSE,
            ),
            'email_enable_send' => array(
                'type' => 'TINYINT',
                'constraint' => '1', // 0 | 1
                'default' => 0
            ),
            'fullname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
            'salt' => array(
                'type' => 'VARCHAR',
                'constraint' => '35',
                'null' => TRUE,
            ),
            'is_superuser' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => 0
            ),
            'method' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => 'Web'
            ),
            'telegram_ChatId' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
            ),
            'telegram_enable_send' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => FALSE,
                'default' => 0
            ),
            'slug' => array(
                'type' => 'VARCHAR', 
                'constraint' => '255',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => FALSE,
                'default' => 1
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        // CREAR EL CAMPO CREATED LASTSEEN DEFAULT DATETIME
        $this->dbforge->add_field('last_seen datetime NOT NULL default current_timestamp');
        $this->dbforge->add_field('created datetime NOT NULL default current_timestamp');
        // creando la tabla
        $this->dbforge->create_table('mqtt_user', TRUE);
        // Insertar datos
        $data = array(
            array(
                'username' => 'emqx',
                'email' => 'admin@gmail.com',
                'email_enable_send' => 0,
                'fullname' => 'Administrador',
                'photo' => NULL,
                'phone' => NULL,
                'password' => 'efa1f375d76194fa51a3556a97e641e61685f914d446979da50a551a4333ffd7', //public
                'token' => '64af7ac3e42589-09690413-51249864',
                'salt' => NULL,
                'is_superuser' => 1,
                'method' => 'Web',
                'telegram_ChatId' => NULL,
                'telegram_enable_send' => 0,
                'slug' => 'administrador',
                'status' => 1,
            ),
            array(
                'username' => 'yancarlos',
                'email' => 'yancerquera@outlook.com',
                'email_enable_send' => 0,
                'fullname' => 'Cliente',
                'photo' => NULL,
                'phone' => NULL,
                'password' => 'efa1f375d76194fa51a3556a97e641e61685f914d446979da50a551a4333ffd7', //public
                'token' => '64af7ac3e42589-09690443-51249864',
                'salt' => NULL,
                'is_superuser' => 0,
                'method' => 'Web',
                'telegram_ChatId' => NULL,
                'telegram_enable_send' => 0,
                'slug' => 'cliente',
                'status' => 1,
            ),

        );
        $this->db->insert_batch('mqtt_user', $data);
        // Fin Tabla Usuarios

        // Tabla de ACL (mqtt_acl)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'allow' => array(
                'type' => 'INT',
                'constraint' => '1',
                'default' => 0,
                'comment' => '0: deny, 1: allow',
            ),
            'ipaddr' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => TRUE,
                'comment' => 'IpAddress',
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
                'comment' => 'Username',
            ),
            'clientid' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
                'comment' => 'ClientId',
            ),
            'access' => array(
                'type' => 'INT',
                'constraint' => '2',
                'default' => 3,
                'comment' => '1: subscribe, 2: publish, 3: pubsub'
            ),
            'topic' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'comment' => 'Topic Filter',
            ),
        ));
        // agregando claves
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('INDEX (ipaddr)');
        $this->dbforge->add_field('INDEX (username)');
        $this->dbforge->add_field('INDEX (clientid)');
        // creamos la tabla
        $this->dbforge->create_table('mqtt_acl', TRUE);
        // Insertar data
        $data = array(
            array(
                'allow' => 0,
                'ipaddr' => NULL,
                'username' => '$all',
                'clientid' => NULL,
                'access' => 3,
                'topic' => '+/#'
            ),
            array(
                'allow' => 1,
                'ipaddr' => NULL,
                'username' => '$all',
                'clientid' => NULL,
                'access' => 3,
                'topic' => '%u/+/#'
            )
        );
        $this->db->insert_batch('mqtt_acl', $data);
        // Fin Tabla ACL

        // Tabla de dispositivos (mqtt_devices)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'serialnumber' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'type' => array(
                'type' => 'TINYINT',
                'constraint' => '4',
                'null' => FALSE,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
            'userid' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'store' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => FALSE,
                'default' => 1
            ),
            'rule_store_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'rule_status_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'online' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => FALSE,
                'default' => 0
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => FALSE,
                'default' => 1
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        // Agregar clave foranea entre tablas
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (userid) REFERENCES mqtt_user(id) ON DELETE CASCADE ON UPDATE NO ACTION');
        // CREAR EL CAMPO CREATED LASTSEEN DEFAULT DATETIME
        $this->dbforge->add_field('lastseen datetime NOT NULL default current_timestamp');
        $this->dbforge->add_field('created datetime NOT NULL default current_timestamp');
        $this->dbforge->create_table('mqtt_devices', TRUE);
        // Fin Tabla Dispositivos

        // Tabla de configuraciones generales (general_settings)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'dark_mode' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => 0
            ),
            'timezone' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => 'America/Bogota'
            ),
            'logo_path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'favicon_path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'facebook_app_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'facebook_app_secret' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'google_client_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'google_client_secret' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'google_analytics' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'mail_library' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'mail_protocol' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => 'smtp'
            ),
            'mail_host' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'mail_port' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE,
                'default' => '587'
            ),
            'mail_username' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'mail_password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'mail_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'send_email_messages' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => 0
            ),
            'registration_system' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => 1
            ),
            'recaptcha_site_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'recaptcha_secret_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'custom_css_codes' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'custom_javascript_codes' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'mqtt_host' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => 'localhost'
            ),
            'mqtt_port' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => 8073
            ),
            'mqtt_protocol' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
                'default' => 'ws'
            ),
            'emqx_AppID' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'emqx_AppSecret' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'emqx_ApiWebToken' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'emqx_AppPort' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'default' => 8091
            ),
            'telegram_bot_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ),
            'maintenance_mode_title' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'maintenance_mode_description' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE,
            ),
            'maintenance_mode_status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => 0
            ),
            'version' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE,
                'default' => '1.0.1'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('general_settings', TRUE);
        // Insertar data a la data
        $data = array(
            'dark_mode' => 0,
            'timezone' => 'America/Bogota',
            'logo_path' => NULL,
            'favicon_path' => NULL,
            'facebook_app_id' => NULL,
            'facebook_app_secret' => NULL,
            'google_client_id' => NULL,
            'google_client_secret' => NULL,
            'google_analytics' => NULL,
            'mail_library' => NULL,
            'mail_protocol' => 'smtp',
            'mail_host' => NULL,
            'mail_port' => '587',
            'mail_username' => NULL,
            'mail_password' => NULL,
            'mail_title' => NULL,
            'send_email_messages' => 0,
            'registration_system' => 1,
            'recaptcha_site_key' => NULL,
            'recaptcha_secret_key' => NULL,
            'custom_css_codes' => NULL,
            'custom_javascript_codes' => NULL,
            'emqx_AppID' => NULL,
            'emqx_AppSecret' => NULL,
            'emqx_ApiWebToken' => 'XNSS-HSJW-3NGU-8XTJ',
            'telegram_bot_token' => NULL,
            'maintenance_mode_title' => NULL,
            'maintenance_mode_description' => NULL,
            'maintenance_mode_status' => 0,
            'version' => '1.0.1',
        );
        $this->db->insert('general_settings', $data);
        // Fin tabla de configuraciones generales

        // Tabla de almacenar data (mqtt_data)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'deviceMqttId' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
            'deviceSerial' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'deviceRelay1Status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => 0
            ),
            'deviceRelay2Status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => 0
            ),
            'deviceDimmer' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => 0
            ),
            'deviceCpuTempC' => array(
                'type' => 'FLOAT',
                'null' => FALSE,
                'default' => 0
            ),
            'deviceDS18B20TempC' => array(
                'type' => 'FLOAT',
                'null' => FALSE,
                'default' => 0
            ),
            'deviceDS18B20TempF' => array(
                'type' => 'FLOAT',
                'null' => FALSE,
                'default' => 0
            ),
            'deviceRestarts' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'wifiRssiStatus' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'wifiQuality' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'deviceId' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            'deviceUserId' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),

        ));
        $this->dbforge->add_key('id', TRUE);
        // Agregar clave foranea entre tablas
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (deviceId) REFERENCES mqtt_devices(id) ON DELETE CASCADE ON UPDATE NO ACTION');
        // CREAR EL CAMPO CREATED DEFAULT DATETIME
        $this->dbforge->add_field('created datetime NOT NULL default current_timestamp');
        $this->dbforge->create_table('mqtt_data', TRUE);
        // Fin tabla de DATA

        // Tabla de recursos (mqtt_resources)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'resource_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'resource_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'resource_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('created datetime NOT NULL default current_timestamp');
        $this->dbforge->create_table('mqtt_resources', TRUE);
        // Fin de tabla recursos

        // Tabla de configuraciones (settings)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'application_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'site_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
            'keywords' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
            'facebook_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
            'twitter_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
            'youtube_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
            'contact_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
            'contact_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'contact_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'copyright' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('settings', TRUE);
        // Insertar data a la data
        $data = array(
            'application_name' => 'IoTProject v1.0.1',
            'site_description' => 'Internet de las cosas, IOT para todos',
            'keywords' => 'iot,esp32,SENA, internet de las cosas,iothost, Servicios Tecnologicos, CIES',
            'facebook_url' => NULL,
            'twitter_url' => NULL,
            'youtube_url' => NULL,
            'contact_address' => NULL,
            'contact_email' => NULL,
            'contact_phone' => NULL,
            'copyright' => 'SENA. Todos los derechos reservados.'
        );
        $this->db->insert('settings', $data);
        // Fin de tabla de configuraciones

        // Tabla de Logs (activity_log)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'description' => array(
                'type' => 'MEDIUMTEXT',
                'null' => FALSE,
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'userFullname' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'deviceId' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
            'userId' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('INDEX (userId)');
        $this->dbforge->add_field('date datetime NOT NULL default current_timestamp');
        $this->dbforge->create_table('activity_log', TRUE);
        // Fin tabla de logs

        // Tabla de sesiones (ci_sessions)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => FALSE,
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => FALSE,
            ),
            'timestamp' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'default' => 0
            ),
            'data' => array(
                'type' => 'BLOB',
                'null' => FALSE,
            )
        ));
        $this->dbforge->add_field('INDEX (timestamp)');
        $this->dbforge->create_table('ci_sessions', TRUE);
        // Fin de tabla sesiones

    }

    public function down() // MIGRACIÓN 0 
    {
        //  $this->dbforge->drop_table('nombre de tabla');
        $data = array(
            'general_settings',
            'settings',
            'mqtt_data',
            'mqtt_devices',
            'mqtt_user',
            'mqtt_acl',
            'mqtt_resources',
            'activity_log',
            'ci_sessions',
        );

        foreach ($data as $table) {
            $this->dbforge->drop_table($table);
        }
    }
}

// Tabla de Usuarios | ACL de EMQX ref.
/* 
  CREATE TABLE `mqtt_user` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(100) DEFAULT NULL,
    `password` varchar(100) DEFAULT NULL,
    `salt` varchar(35) DEFAULT NULL,
    `is_superuser` tinyint(1) DEFAULT 0,
    `created` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `mqtt_username` (`username`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 
  
  CREATE TABLE `mqtt_acl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `allow` int(1) DEFAULT 1 COMMENT '0: deny, 1: allow',
  `ipaddr` varchar(60) DEFAULT NULL COMMENT 'IpAddress',
  `username` varchar(100) DEFAULT NULL COMMENT 'Username',
  `clientid` varchar(100) DEFAULT NULL COMMENT 'ClientId',
  `access` int(2) NOT NULL COMMENT '1: subscribe, 2: publish, 3: pubsub',
  `topic` varchar(100) NOT NULL DEFAULT '' COMMENT 'Topic Filter',
  PRIMARY KEY (`id`),
  INDEX (ipaddr),
  INDEX (username),
  INDEX (clientid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

*/