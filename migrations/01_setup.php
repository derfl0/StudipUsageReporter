<?php

class Setup extends DBMigration
{

    function up()
    {
        DBManager::get()->exec("CREATE TABLE IF NOT EXISTS `usage_report` (
  `caller` varchar(512) NOT NULL DEFAULT '',
  `include` varchar(512) NOT NULL DEFAULT '',
  PRIMARY KEY (`caller`,`include`)
)");

        SimpleORMap::expireTableScheme();
    }

    function down()
    {
        DBManager::get()->exec("DROP TABLE IF EXISTS `usage_report`");
    }

}
