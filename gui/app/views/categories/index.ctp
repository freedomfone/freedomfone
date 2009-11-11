<?php
echo "<p class='frameRight'>".$html->link($html->image("icons/add.png", array("alt" => "Add category")),"/categories/add",null, null, false)."</p>";
echo "<h1>".__("Manage Categories",true)."</h1>";


$session->flash();





   if ($categories){

      echo "<table width='100%'>";
      echo $html->tableHeaders(array(__('Category',true),__('Description',true),__('Edit',true),__('Delete',true)));


      	   foreach ($categories as $key => $category){

      		   $title 	= $category['Category']['name'];
      		   $description = $category['Category']['longname'];		   
  		   $edit 	= $html->link($html->image("icons/edit.png", array("alt" => "Edit")),"/categories/edit/{$category['Category']['id']}",null, null, false);
      		   $delete 	= $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/categories/delete/{$category['Category']['id']}",null, "Are you sure you want to delete this category?",false);
      		   

     $row[$key] = array($title, $description,$edit,$delete);

      		   }

     echo $html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {

      echo "<div class='instruction'>".__("No categories exist. Please create a category by clicking on the green button to the right.")."</div>";
      }

?>