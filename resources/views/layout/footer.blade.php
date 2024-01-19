<section class="footer-section">
      <div class="container">
         <div class="row">
            <div class="text-center footerlinks">
               <p class="mb-0">Copyright © 2008-2023 Croma Campus(P)Ltd.All rights Reserved.</p>
            </div>
         </div>
      </div>
   </section>


      <!-- data table here company list end -->

<!-- popup model change password  -->

 <!-- Modal -->
 <div class="modal mymodel fade" id="changepassword" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="form-content text-center d-grid">
         <h5 class="modal-title">Reset Password</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   
         </div>
         <div class="form-changepassword">

            <form action="" method="post" class="d-grid gap-3" autocomplete="off">
                @csrf
                  <div class="form-re">
                     <input type="password" name="current_password" class="my-from-control" placeholder="Old Password" >

                  </div>
                  <div class="form-re">

                  <input type="password" class="my-from-control" placeholder="New Password">
                  <i class="fa-light fa-circle-check"></i>
                  </div>
                  <div class="form-re">

                  <input type="password" class="my-from-control" placeholder="Confirm Password">
                  <i class="fa-light fa-circle-xmark"></i>                 
                </div>
                  <div class="form-re text-center">

                  <button type="button" class="btn btn-green w175 m-auto">Update</button>
</div>
            </form>
         </div>
     </div>
 </div>
 </div>

                         <!-- popup model change password end -->

<!-- popup model upload Company logo section start   -->

 <div class="modal mymodel fade" id="documentomodel" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="form-content text-center d-grid">
         <h5 class="modal-title">Document Upload</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   
         </div>
         <div class="documentupload form-changepassword">   

            <form action="{{Route('document.save')}}" method="post" enctype="multipart/form-data">   
                @csrf
                <input type="hidden" name="candidate_id" id="candidate_id">
                  <div class="upload-tab d-flex align-items-center gap-2">
                              <figure>                            
                                 <img src="{{basepath('images/iconprofile.svg')}}" class="img-fluid photo-upload-img" id="iconprofile" style="max-width:25px;">
                             </figure>
                               <input type="file" name="docfile[]" multiple style="line-height:initial;" required>
                                 
                  </div>   

                  <div class="form-re text-center">

                     <input type="submit" class="btn btn-green w175 m-auto" value="Upload">
                  </div>                   
            </form>
         </div>
     </div>
 </div>
 </div>

<!-- popup model upload Company logo section end   -->

<!-- popup model Add Candidate section start   -->

<div class="modal mymodel fade" id="addcandidatepopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Add Candidate</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword">
               <form action="{{Route('candidate.save')}}" method="post" class="d-grid gap-3" autocomplete="off">
                @csrf
                     <div class="form-re">
                        <label for="" class="form-label">Comapany</label>
                        <select class="my-from-control selectcol" name="company" aria-label="Default select example" required>
                           <option value="">Select Company Name</option>
                           @php
                           $compines=App\Models\Company::where('status','1')->get();
                           @endphp
                           @if(!empty($compines))
                           @foreach($compines as $value)
                           <option value="{{$value->id}}">{{$value->company_name}}</option>
                           @endforeach
                           @endif
                        </select>
    
                     </div>
                     <div class="form-re">
                        <label for="" class="form-label">Candidate Details</label>
                        <input type="text" class="my-from-control" name="name" placeholder="Enter Student Name Here" required>
                     </div>          
                     <div class="form-re text-center">   
                         <input type="submit" class="btn btn-green w175 m-auto" value="Submit">
                     </div>
               </form>
            </div>

     </div>
 </div>
 </div>

<!-- popup model upload Company logo section end   -->

<!-- popup model Remark Edit Candidate section start   -->

<div class="modal mymodel fade" id="remarkeditstudentpopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Candidate Remark Update</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword">
               <form method="post" action="/remark-update" class="d-grid gap-3" autocomplete="off">
                    @csrf
                    <input type="hidden" name="getid" id="remark_id">
                     <div class="form-re">
                        <label for="" class="form-label">Remark</label>
                        <input type="text" class="my-from-control" name="remark" id="remark_edit" placeholder="Enter Your Remark">
                     </div>          
                     <div class="form-re text-center">   
                         <input type="submit" class="btn btn-green w175 m-auto" value="Submit">
                     </div>
               </form>
            </div>

     </div>
 </div>
 </div>

<!-- popup model Remark Edit Candidate section end   -->

<!-- popup model Cadidate Name Edit section start   -->

<div class="modal mymodel fade" id="cadidatnameeditpopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Candidate Edit Name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword">
               <form action="/name-update" method="post" class="d-grid gap-3" autocomplete="off">
                @csrf
                    <input type="hidden" name="getid" id="cid">
                     <div class="form-re">
                        <label for="" class="form-label">Candidate Name</label>
                        <input type="text" class="my-from-control" name="name" id="cname" placeholder="Enter Student Name Here">
  
                     </div>
        
                     <div class="form-re text-center">   
                         <input type="submit" class="btn btn-green w175 m-auto" value="Update">
                     </div>
               </form>
            </div>

     </div>
 </div>
 </div>

<!-- popup model Cadidate Name Edit section end   -->

<!-- popup model Company Edit Form section start   -->

<div class="modal mymodel fade" id="companyeditformpopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title">Company Edit Name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword">
               <form action="{{Route('update.company')}}" method="post" class="d-grid gap-3" autocomplete="off" enctype="multipart/form-data">
                 @csrf

                    <div class="form-re">
                        <input type="hidden" name="edit_company_id" id="edit_company_id">
                        <label for="" class="form-label">Company Name</label>
                        <input type="text" name="comapny_name" id="edit_company_name" class="my-from-control" placeholder="Enter Company Name Here" required>
                    </div>

                    <div class="form-re">
                        
                         <div class="my-from-control d-flex align-items-center gap-2">

                              <figure class="mb-0">                            
                                 <img src="{{basepath('images/iconprofile.svg')}}" class="img-fluid photo-upload-img" id="iconprofile" style="max-width:19px;">
                             </figure>
                              <input type="file" name="logo">
                                 
                  </div>
                    </div>
                    
                    
        
                     <div class="form-re text-center">   
                         <input type="submit" class="btn btn-green w175 m-auto" value="Update">
                     </div>
               </form>
            </div>

     </div>
 </div>
 </div>

<!-- popup model Company Edit Form section end   -->

<!-- popup model Candidate Data Popup section start   -->

<div class="modal candidatedocumentspopup fade" id="candidatedocumentspopup" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
         <div class="form-content text-center d-grid">
           <h5 class="modal-title" id="ccname"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
            <div class="form-changepassword d-grid gap-3 documentappend">
                        <!--<div class="student-document">
                           <img src="images/document/pdficon.svg" alt="pdficon">
                            <h3>Sunil Sharma Appointment Letter</h3>
                            <div class="list-document ms-auto">
                              <ul>
                                 <li><a href=""><img src="images/document/docu-st-calandericon.svg" alt="calandericon"></a></li>
                                 <li><a href=""><img src="images/document/docu-st-viewicon.svg" alt="viewicon"></a></li>
                                 <li><a href=""><img src="images/document/docu-st-closeicon.svg" alt="closeicon"></a></li>

                              </ul>
                            </div>
                        </div>-->
                        
                        
                        
                        
       
            </div>

     </div>
 </div>
 </div>

<!-- popup model Candidate Data Popup section End   -->
