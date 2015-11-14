<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'aid' => 
  array (
    'field' => 'aid',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => '',
  ),
  'username' => 
  array (
    'field' => 'username',
    'type' => 'varchar(20)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'passwd' => 
  array (
    'field' => 'passwd',
    'type' => 'char(32)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'logintime' => 
  array (
    'field' => 'logintime',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'loginip' => 
  array (
    'field' => 'loginip',
    'type' => 'varchar(20)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'lock' => 
  array (
    'field' => 'lock',
    'type' => 'tinyint(3) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
);
?>