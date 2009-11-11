<?
class Category extends AppModel {

    var $name = 'Category';

    var $hasMany = array('Message');

}
?>
