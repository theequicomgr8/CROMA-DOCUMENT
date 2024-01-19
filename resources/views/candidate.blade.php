@extends('layout.app')
@section('main')
@section('documents','active')
<style>
    table.dataTable tr th:first-child {
  text-align: end;
  width: 135px !important;
}
table.dataTable tr th:nth-child(2)
{
    width:65px !important;
}
table.dataTable tr th:nth-child(3)
{
    width:310px !important;
}
table.dataTable tr th:nth-child(4)
{
    width:25px !important;
}
table.dataTable tr th:nth-child(5)
{
    width:310px !important;
}
table.dataTable tr th:nth-child(6)
{
    width:25px !important;
}
table.dataTable tr th:nth-child(7)
{
    width:25px !important;
}
table.dataTable tbody tr td .main
{
    display:flex;
}
.display tbody tr td.dataTables_empty
{
    text-align:center !important;
}
</style>
<header class="bg-green2 ">
         <div class="container">
            <div class="row">
                <div class="grid-two">
                    <div class="total-documentcount">
                          <span>Total Candidate : <span id="count">{{$candidatecount }}</span></span>
                    </div>
                <div class="documentcounttab second-header-area">
                  <form >
                    <ul>              
                        <li>
                              <select class="my-from-control selectcol" name="filter_company_name" id="filter_company_name" aria-label="Default select example">
                                 <option value="">Select Company Name</option>
                                 @if(!empty($compines))
                                 @foreach($compines as $value)
                                 <option value="{{$value->id}}">{{$value->company_name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                        </li>
                        <li>
                              <input type="date" name="Form" id="from_filter" class="my-from-control2" placeholder="Select a Date">
                        </li>
                        <li>
                           <input type="date" name="to" id="to_filter" class="my-from-control2" placeholder="Select a Date">

                        </li>
                                              
                        
                        <input type="submit" value="Filter" class="btn-green my-btn" id="filter_btn">
                     </ul>
                  </form>
                </div>
            </div>
            </div>
         </div>
      </header>



      <div class="tab-content1" id="pills-tabContent">
         <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">  

            <div class="filter-section add-candidatepopup">                 
               <a data-bs-toggle="modal" data-bs-target="#addcandidatepopup">
               <img src="{{basepath('images/document/add-candidateicon.svg')}}" alt="add-candidateicon" class="img-fluid me-2">Add Candidate </a>
            </div>
    

   <div class="tab-pane fade show active">
      <table id="candidatedocumentslist" class="display companylist" style="width:100%">
          
         <thead class="trc">
             <tr>
                 <th>#</th>
                 <th>Date</th>
                 <th>Candidate Name</th>
                 <th>Count</th>
                 <th>Company Name</th>
                 <th>Actions</th>
                 <th>Remark</th>
             </tr>
         </thead>
       
      </table>
    
   </div>

   </div>
   </div>


      
@include('layout.footer')
@endsection

@section('script')
<script>
             function readURL(input) {
           if (input.files && input.files[0]) {
         
             var reader = new FileReader();
         
             reader.onload = function(e) {
               $('.image-upload-wrap').hide();
         
               $('.file-upload-image').attr('src', e.target.result);
               $('.file-upload-content').show();
         
               $('.image-title').html(input.files[0].name);
             };
         
             reader.readAsDataURL(input.files[0]);
         
           } else {
             removeUpload();
           }
         }
         
         
         function removeUpload() {
           $('.file-upload-input').replaceWith($('.file-upload-input').clone());
           $('.file-upload-content').hide();
           $('.image-upload-wrap').show();
         }
         $('.image-upload-wrap').bind('dragover', function () {
             $('.image-upload-wrap').addClass('image-dropping');
           });
           $('.image-upload-wrap').bind('dragleave', function () {
             $('.image-upload-wrap').removeClass('image-dropping');
         });
         </script>
      <script>
         // $('#candidatedocumentslist').DataTable({
         //     ajax: '/condidatedata',
         //     serverSide: true, 
         //     lengthMenu: [
         //     [ 10, 25, 50, -1 ],
         //     [ '10', '25', '50', 'all' ]
         // ],          
         //     dom: 'Bfrtip',
         //     buttons: [
         //           'pageLength'
         //     ]
         // });
         
      </script>



      <script>
        var userTable=$("#candidatedocumentslist").DataTable({
            "serverSide":true,
            "processing":true,
            lengthMenu: [
                [10, 25, 50,1000,],
                [10, 25, 50,1000,],
                // [10, 25, 50,500, 'All'],
            ],
            order: [[0, 'desc']],
            dom: 'Bfrtip',
            buttons: [
                'pageLength'
            ],
            "ajax": {
                "url" : '/condidatedata',
                "type":'GET',
                "dataType":'json',
                data: function(data){
                    data.filter_company_name = $('#filter_company_name').val();
                    data.from_filter = $('#from_filter').val();
                    data.to_filter = $('#to_filter').val();
                    // data.priority_filter = $('#priority_filter').val();
                    // data.location_filter = $('#location_filter').val();
                }
            },
            "columns":[
                {"data":"id"},
                {"data":"date"},
                {"data":"name"},
                {"data":"count"},
                {"data":"company_name"},
                {"data":"action"},
                {"data":"remark"}
            ]
         });
        $("#filter_btn").click(function(e){
            e.preventDefault();
            userTable.draw();
          });

      </script>













      <script>
         $(document).ready(function(){
         function demo(){
         $('.dt-buttons,.dataTables_filter').wrapAll('<div class="tablefilter"><div class="container"><div class="row"><div class="col-lg-12 col-lg-12 mb-3 d-flex justify-content-between data-filtertab"></div></div></div></div>');
         }
         demo();
         $( ".dataTables_filter label" ).append( '<div class="iconsearch"><i class="fa-regular fa-magnifying-glass"></i></div>' );
         $(".filter-section").prependTo(".data-filtertab");
         $(".filter-data-list").appendTo(".tablefilter");
         
         $('.dataTables_info').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12"></div></div></div>');
         
         $('.dataTables_paginate').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12 panigation"></div></div></div>');
         

         
         
         
         }); 
         
         
      </script>
      <script>
         $(document).ready(function(){
            $("#companylist_paginate").after('<div class="search-tabs"><input type="search" class="search-tab" id="gsearch" name="gsearch">of 400 iteams</div>');
            $( ".panigation" ).wrapAll( '<div class="search-list"></div>' );
            // $( ".paginate_button" ).html( '<i class="fa-solid fa-chevron-right"></i>dfsd' );
            $(".dt-buttons").appendTo('.dataTables_filter');
            $(".buttons-copy").append('<img src="images/copyicon-ex.svg">');
            $(".buttons-csv").append('<img src="images/excelicon.svg">');
            $(".buttons-pdf").append('<img src="images/pdficon.svg">');
            $(".buttons-print").append('<img src="images/printicon.svg">');
            // $( ".display thead" ).wrapAll( '<div class="container"></div>' );
            // $( ".display tbody" ).wrapAll( '<div class="container"></div>' );

         });             
      </script>
      <script>
         function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});


$("#filter_btn").click(function(){
	var company=$("#filter_company_name").val();
    var from=$("#from_filter").val();
    var to=$("#to_filter").val();
	$.ajax({
		url : '/totalcount',
		type: 'GET',
		data: {company:company,from:from,to:to},
		success:function(data){
			//alert(data);
			$("#count").html(data);
		}
	});
});






$(document).on("click",".deletecompany_",function(e){
	e.preventDefault();
	if(confirm("Are You Sure, You want to delete")){
		var id=$(this).attr('data-cid');
		var table=$(this).attr('data-table');
		$.ajax({
			url : '/delete',
			type:'GET',
			data:{id:id,table:table},
			success:function(data){
				//alert(data);
				//location.reload();
				//$('#companylist').DataTable().ajax.reload();
				$('#candidatedocumentslist').DataTable().ajax.reload();
				//$("#candidatedocumentspopup").show();
				location.reload()
			}
		});
	}else{
		$('#candidatedocumentslist').DataTable().ajax.reload();
		$('#companylist').DataTable().ajax.reload();
	}
	
});

      </script>

@endsection