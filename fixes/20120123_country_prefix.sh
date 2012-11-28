cp /opt/freedomfone/fixes/20120123/ivr_menus_controller.php /opt/freedomfone/gui/app/controllers
cp /opt/freedomfone/fixes/20120123/settings_controller.php  /opt/freedomfone/gui/app/controllers
cp /opt/freedomfone/fixes/20120123/freedomfone_db_schema.sql /opt/freedomfone/gui/app/sql
cp /opt/freedomfone/fixes/20120123/index.ctp /opt/freedomfone/gui/app/views/settings

echo "NOTICE!! This patch requires a DB upgrade"
echo "Run ./db_install.sh and ./demo_install.sh"
