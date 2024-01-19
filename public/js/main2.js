$(document).on("click",".editcompany_",function(){
	var id=$(this).attr('data-id');
	var comany_name=$(this).attr('data-name');
	// alert(comany_name);
	$("#edit_company_id").attr('value',id);
	$("#edit_company_name").attr('value',comany_name);
});


$(document).on("click",".deletecompany",function(e){
	e.preventDefault();
	if(confirm("Are You Sure, You want to delete")){
		var id=$(this).attr('data-cid');
		var table=$(this).attr('data-table');
		$.ajax({
			url : '/delete',
			type:'GET',
			data:{id:id,table:table},
			success:function(data){
				alert(data);
				//location.reload();
				$('#companylist').DataTable().ajax.reload();
				$('#candidatedocumentslist').DataTable().ajax.reload();
				$("#candidatedocumentspopup").hide();
				location.reload()
			}
		});
	}else{
		$('#candidatedocumentslist').DataTable().ajax.reload();
		$('#companylist').DataTable().ajax.reload();
	}
	
});


       $(document).ready(function(){
         
         // $("select").change(function(){
         //   if ($(this).val()=="") $(this).css({color: "#aaa"});
         //   else $(this).css({color: "#000"});
         // });
         $('.selectcol').select2();
         
         });



$(document).on("click",".addcondidate",function(){
	var id=$(this).attr('candidate-id');
	$("#candidate_id").attr("value",id);
	//alert(id);
});


$(document).on("click",".showdocument",function(){
	var id=$(this).attr('data-id');
	var name=$(this).attr('data-name');
	$("#ccname").html(name);
	$(".documentappend").empty();
	$.ajax({
		url : '/showdocument',
		type:'GET',
		data:{id:id},
		success:function(data){
			$(".documentappend").append(data);
		}
	});
});


$(document).on("click",".candidateremarkedit",function(){
	var id=$(this).attr('data-eid');
	var remark=$(this).attr('data-remartk');
	$("#remark_id").attr('value',id);
	$("#remark_edit").attr("value",remark);
	//alert(id);

	// $("#remark_id").val(id);
	// $("#remark_edit").val(remark);
});


$(document).on("click",".nameupdate",function(){
	var id=$(this).attr('data-cid');
	var name=$(this).attr('data-cname');
	$("#cid").attr('value',id);
	$("#cname").attr("value",name);
	// alert(id);


});

// $("#remark-form").on("submit",function(e){
// 	e.preventDefault();
// 	$.ajax({
// 		url : '/remark-update',
// 		type: 'POST',
// 		data: new FormData(this),
// 		success:function(data){
// 			alert(data);
// 		}
// 	});
// });


$(".opt-send").click(function(){
    $.ajax({
        url:'/sendotp',
        type:'GET',
        success:function(data){
            alert('OTP Send Successfully');
        }
    });
});



