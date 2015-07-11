function notify_re(re)
{
  var jsonObject = JSON.parse(re);
  if(jsonObject['status']){
    success_notify_right(jsonObject['info']);
    return true;
  }
  else
  {
    error_notify_right(jsonObject['error']);
    return false;
  }
}

$(function() {
  $('#btn-add-find').on('click', function() {
    $('#find-add-prompt').modal({
      relatedTarget: this,
      onConfirm: function(e) {
          $.ajax({
		        type:"POST",
		        url:"/index.php/Admin/Find/AddItem",
		        data:{
		              answer_id:$("#input-find-add-answerid").val(),
		              order:$("#input-find-add-order").val()
		              },
		        success:function(re){
               notify_re(re);
		        }
          });
      }
    });
  });
});

function DeleteFindBtnClick(delete_id)
{
  $.ajax({
  type:"POST",
  url:"/index.php/Admin/Find/DeleteItem",
  data:{
        id:delete_id
        },
  success:function(re){
        if(notify_re(re))
        {
        	$('#find-list-tr-'+delete_id).fadeOut(800);
        }
  }
  });
}

function EditFindBtnClick(edit_id)
{
	$("#input-find-edit-answerid").val($("#find-list-answerid-"+edit_id).text());
	$("#input-find-edit-order").val($("#find-list-order-"+edit_id).text());
	
    $('#find-edit-prompt').modal({
      relatedTarget: this,
      onConfirm: function(e) {
          $.ajax({
		        type:"POST",
		        url:"/index.php/Admin/Find/EditItem",
		        data:{
		        	  id:edit_id,
		              answer_id:$("#input-find-edit-answerid").val(),
		              order:$("#input-find-edit-order").val()
		              },
		        success:function(re){
               notify_re(re);
		        }
          });
      }
    });
}