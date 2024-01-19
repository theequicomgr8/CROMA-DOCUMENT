@extends('layout.app')
@section('main')
@section('companies','active')
<header class="second-header-area bg-green2">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <form method="post" action="{{Route('add.company')}}" enctype="multipart/form-data" autocomplete="off">
                     @csrf
                  <div class="add-company-name-main d-flex align-items-center gap-2 pl-tab">
                     <input type="text" class="my-from-control w-40" name="company_name" required placeholder="Enter Company Name Here" style="border: 1.5px solid #fff;padding: 6px 13px;    background-color: #fff;
    line-height: inherit;">
                     <!-- <a>
                        <input type="file">
                        <img src="images/document/uploadicon.svg" alt="uploadicon">

                     </a> -->
                    <!-- <div class="avatar-upload">-->
                    <!--    <div class="avatar-edit">-->
                    <!--        <input type='file' required name="logo" id="imageUpload" accept=".png, .jpg, .jpeg" />-->
                    <!--        <label for="imageUpload"></label>-->
                    <!--    </div>-->
                    <!--    <div class="avatar-preview">-->
                    <!--        <div id="imagePreview" style="background-image: url(https://document.cromacampus.com/public/images/document/uploadicon.svg);">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                     <div class="file-upload">
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' required name="logo" id="imageUpload" onchange="readURL(this);" accept="image/*" />
                                    <figure>
                                        
                                        <img src="https://document.cromacampus.com/public/images/document/uploadicon.svg" class="img-fluid photo-upload-img" id="pic">
                                    </figure>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" />
                                    <!--<div class="image-title-wrap">-->
                                    <!--    <a type="button" onclick="removeUpload()" class="remove-image">Remove-->
                                    <!--    </a>-->
                                    <!--</div>-->
                                </div>
                                <span class="pic_err error"></span>
                            </div>
                     <input type="submit" class="active text-captilize" value="Add Company" style="padding: 7px 26px 8px;">
                  </div>
               </form>
               </div>
          




            </div>
         </div>
      </header>

<div class="tab-content1" id="pills-tabContent">
         <div class="tab-pane fade show active" id="pills-rankview" role="tabpanel" aria-labelledby="pills-rankview-tab">  

            <div class="filter-section">
                 
               <a data-bs-toggle="collapse" class="accordion-button collapsed" href="#add-company-tab" role="button" aria-expanded="false" aria-controls="add-company-tab">
               <img src="{{basepath('images/document/filter.svg')}}" alt="filter" class="img-fluid me-2">Filter</a>
            </div>
            <div id="add-company-tab" class="filter-data-list collapse">
               <div class="container">
                  <div class="row">
                     <form action="">
                     <ul style="justify-content:inherit;">
       
                        <li>
                           <a class="d-flex align-items-center">
                              <select class="my-from-control selectcol" aria-label="Default select example">
                                 <option value="">Comapany Name</option>
                                 <option>#1</option>
                                 <option>#2</option>
                                 <option>#3</option>
                                 <option>#4</option>
                              </select>
                           </a>
                        </li>
                                              
                        
                        <button class="btn-green my-btn" style="width:150px;">Filter</button>
                     </ul>
                  </form>
                  </div>
               </div>
            </div>

   <div class="tab-pane fade show active">
      <table id="companylist" class="display companylist" style="width:100%">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Brand Logo</th>
                 <th>Comapany Name</th>
                 <th>Count</th>
                 <th>Actions</th>
             </tr>
         </thead>
      </table>
   </div>
      <!-- data table here company list end -->


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
         // $('#companylist').DataTable({
         //     ajax: '/companylistdata',
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
        var userTable=$("#companylist").DataTable({
            "serverSide":true,
            "processing":true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            dom: 'Bfrtip',
            buttons: [
                'pageLength'
            ],
            "ajax": {
                "url" : '/companylistdata',
                "type":'GET',
                "dataType":'json',
                data: function(data){
                    // data.filter_keyword = $('#filter_keyword').val();
                    // data.course_filter = $('#course_filter').val();
                    // data.category_filter = $('#category_filter').val();
                    // data.priority_filter = $('#priority_filter').val();
                    // data.location_filter = $('#location_filter').val();
                }
            },
            "columns":[
                {"data":"id"},
                {"data":"logo"},
                {"data":"company_name"},
                {"data":"count"},
                {"data":"action"}
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
         //   $( ".dt-buttons" ).before( '' );
         $(".filter-section").prependTo(".data-filtertab");
         $(".filter-data-list").appendTo(".tablefilter");
         
         $('.dataTables_info').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12"></div></div></div>');
         
         $('.dataTables_paginate').wrapAll('<div class="container"><div class="row d-flex align-items-center justify-content-between"><div class="col-lg-12 col-lg-12 panigation"></div></div></div>');
         
         //  $(".filter-section a").append('.filter-data-list');
         
         
         
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


         });             
      </script>
//       <script>
//          function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('#imagePreview').css('background-image', 'url('+e.target.result +')');
//             $('#imagePreview').hide();
//             $('#imagePreview').fadeIn(650);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#imageUpload").change(function() {
//     readURL(this);
// });
//       </script>

@endsection