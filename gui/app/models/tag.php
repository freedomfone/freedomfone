<?
class Tag extends AppModel {

    var $name = 'Tag';

    var $hasAndBelongsToMany = array('Message');

      var $validate = array(
	'name' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 30),
 				       'message' => 'Between 1 to 30 characters'
 				       ),
	                'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => 'This description is already in use.'
				     )
 		),
	'longname' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 50),
 				       'message' => 'Between 1 to 50 characters'
 				       )
 		));

}
?>
