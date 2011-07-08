( function($) {
$(document).ready(function() {
  initPhonebook();


	$(".listAll .user .contactAction").live("click",function(){
		addUser($(this).closest(".user"));																										 
	});
	$(".listSelected .user .contactAction").live("click",function(){
		removeUser($(this).closest(".user"));																										
	});
	$('.listSelected .listAction').live("click",function(){
		removeAll();
	});
	$('.listAll .listAction').live("click",function(){
		addAll();
	});
	
	
	function removeUser(user){
		user.remove();
		var userId = user.attr('title');
		var origUser = $(	".listAll .listUsers").find('[title='+userId+']');
		initPhonebook();
	}
	function addUser(user){
		var cloned = user.clone();
		var userId = cloned.attr('title');
		var exists = $(	".listSelected .listUsers").find('[title='+userId+']');
		if(!exists.length){
			$(cloned).insertBefore(".listSelected .listUsers .note");
		}
		initPhonebook();
	}
	function removeAll(){
		$(".listSelected .user").remove();
		initPhonebook();
	}
	function addAll(){
		var users = $(".listAll .user");
		$(users).each(function() {
			$(this).find('.contactAction').click();
		});
		initPhonebook();
	}
	function initPhonebook(){
		$('.checkbox input').prop("checked", false);
		var allUsers = $(	".listAll .listUsers .user");
		$(allUsers).each(function() {
			$(this).find('.contactAction').html('<span class="add">click to add [+]</span>');
		});
		var selectedUsers = $(	".listSelected .listUsers .user");
		$(selectedUsers).each(function() {
			$(this).find('.contactAction').html('<span class="remove">click to remove [-]</span>');														 	
			var userId = $(this).attr('title');
			$('input[value='+userId+']').prop("checked", true);
			var origUser = $(	".listAll .listUsers").find('[title='+userId+']');
			origUser.find('.contactAction').html('<span class="added">added</span>');
		});
	}
});
} ) ( jQuery );