Step 1: Prepare db auth table
cd /opt/freedomfone/gui/app
./Console/cake schema create DbAcl


Step 2: Populate aros table

cd auth
mysql -u freedomfone -p freedomfone < aros.sql

Step 3: Create acos

cd ..
./Console/cake acl create aco root controllers
./Console/cake AclExtras.AclExtras aco_sync

Step 4 : Run initDB from Users controller

copy initDB to UsersController.php
allow initDB from AppController.php

$this->Auth->allow('login','initDB';)

Naviate to /users/initDB
