<header class="topheader bg-green">
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-lg-8 col-6">
                  <ul class="nav nav-pills logo-here align-items-center" id="pills-tab" role="tablist">
                     <img src="{{basepath('images/logowhitecroma.svg')}}" alt="logocroma" class="img-fluid me-5">
                     <li class="nav-item" role="presentation">
                        <a href="{{URL::to('all-company')}}" class="@yield('companies')">Companies</a>
                       <a href="{{URL::to('all-condidate')}}" class="@yield('documents')" >Documents</a>
                     </li>
                    
                   </ul>
             
               </div>
               <div class="col-lg-4 col-6">
                  <div class="urser-details">
                     <div class="dropdown img-user d-flex justify-content-end align-items-center">
                        <h2 class="mb-0 dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="{{basepath('images/user-logo.svg')}}" alt="user">{{Session::get('Auth_name')}}
                        </h2>
                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton4">
                           <li><a class="dropdown-item " href="#">{{Session::get('Auth_name')}} <img src="{{basepath('images/Edit_fill.svg')}}" alt="Edit_fill"></a> </li>
                           <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changepassword">Change Password</a></li>
                           <li>
                              <hr class="dropdown-divider">
                           </li>                   
                           <li><a class="dropdown-item" href="/logout"><i class="fa-solid fa-arrow-left-from-arc"></i> Logout</a></li>
                        </ul>  
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>

      