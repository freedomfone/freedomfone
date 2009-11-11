<?php
echo "<p class='frameRight'>".$html->link($html->image("icons/add.png", array("alt" => "Add tag")),"/tags/add",null, null, false)."</p>";
echo "<h1>".__("Manage Tags",true)."</h1>";


$session->flash();





   if ($tags){

      echo "<table width='100%'>";
      echo $html->tableHeaders(array(__('Tag',true),__('Description',true),__('Edit',true),__('Delete',true)));


      	   foreach ($tags as $key => $tag){

      		   $title 	= $tag['Tag']['name'];
      		   $description = $tag['Tag']['longname'];		   
  		   $edit 	= $html->link($html->image("icons/edit.png", array("alt" => "Edit")),"/tags/edit/{$tag['Tag']['id']}",null, null, false);
      		   $delete 	= $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/tags/delete/{$tag['Tag']['id']}",null, "Are you sure you want to delete this tag?",false);
      		   

     $row[$key] = array($title, $description,$edit,$delete);

      		   }

     echo $html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {
      echo "<div class='instruction'>".__("No tags exist. Please create a tag by clicking on the green button to the right.")."</div>";
      }

?>