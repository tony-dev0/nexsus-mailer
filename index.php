<!doctype html>
<?php 
require 'include/config.php';
require 'include/mail/PHPMailer.php';
require 'include/mail/SMTP.php';
require 'include/mail/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$status = array();
$name = array();
$query = "SELECT * FROM email_config WHERE status ='active'";
$res = $conn->query($query); 
if ($res->num_rows > 0)  
{ 
$info = $res->fetch_assoc();
$ss = $info['smtp_server'];
$pt = $info['port'];
$sec = $info['security'];
$uname = $info['username'];
$pwd0 = str_split($info['password'],3);
$pwd1 = $info['password'];
$pwd2 = $pwd1[strlen($pwd1)-1];
$pwd = $pwd0[0].'*****'.$pwd2;
}
else{
  echo"<script>
  document.addEventListener('DOMContentLoaded', () => {
    setTimeout(()=>{
      alert('DataBase Info Unable to display')
    },2000)
    setTimeout(()=>{
      if(window.innerWidth < 760){
      swal('Use Desktop view for better experience') 
    }},5000)
  });
     </script>";
  }
$sql = "SELECT status,config_name FROM email_config"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0)  
{
 while($row = $result->fetch_assoc())  
 { 
  $status[] = $row['status'];
  $name[] = $row['config_name'];
 } 
}  
else  
{ 
  echo"<script>alert('DataBase Unable to display available configurations')</script>";
} 
?>
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Nexsus</title>
      <!-- Favicon --> 
      <link rel="shortcut icon" href="image/un.svg" type="image/x-icon">
      <link rel="stylesheet" href="css/libs.min.css">
      <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css"> 
   </head>
  <body class=" ">
    <aside class="sidebar sidebar-default navs-rounded ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
             <a href="#" class="navbar-brand dis-none align-items-center justify-content-center gap-2">
      
              <img width="25" height="25" src="image/un.svg" alt="">  <h5 class="logo-title m-0 fw-bold">Nexsus Mailer</h5> 
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                 </i>
            </div>
        </div>
        <div class="sidebar-body p-0 data-scrollbar">
            <div class="collapse navbar-collapse pe-3" id="sidebar">
                <ul class="navbar-nav iq-main-menu">
                  <li class="nav-item">
                     <a class="nav-link" href="index">
                         <i class="icon">
                         <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                            
                         </i>
                        <span class="item-name">Dashboard </span> 
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link " href="#">
                         <i class="icon">
                            <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                
                             </svg>                                                     
                        </i>
                         <span class="item-name">About</span>
                     </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="icon">
                           <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                
                            </svg>                                                     
                       </i>
                        <span class="item-name">Help</span>
                    </a>
                </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                         <i class="icon">
                            <svg width="18" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                <rect width="22" id="icon-bound" fill="none" />
                                <path d="M16,14L16,16L0,16L0,14L16,14ZM11,5L11,13L9,13L9,5L11,5ZM15,1L15,13L13,13L13,1L15,1ZM3,9L3,13L1,13L1,9L3,9ZM7,3L7,13L5,13L5,3L7,3Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>                                                       
                         </i>
                             <span class="item-name">Tutorial</span></a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="icon">
                            <svg width="18" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.0714 19.0699C16.0152 22.1263 11.4898 22.7867 7.78642 21.074C7.23971 20.8539 6.79148 20.676 6.36537 20.676C5.17849 20.683 3.70117 21.8339 2.93336 21.067C2.16555 20.2991 3.31726 18.8206 3.31726 17.6266C3.31726 17.2004 3.14642 16.7602 2.92632 16.2124C1.21283 12.5096 1.87411 7.98269 4.93026 4.92721C8.8316 1.02443 15.17 1.02443 19.0714 4.9262C22.9797 8.83501 22.9727 15.1681 19.0714 19.0699Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M15.9393 12.4131H15.9483" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.9306 12.4131H11.9396" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.92128 12.4131H7.93028" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>                            
                        </i>                            
                        <span class="item-name">Mailer</span>
                    </a>
                </li> 
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                     <i class="icon">
                        <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    
                            <path d="M15.016 7.38948V6.45648C15.016 4.42148 13.366 2.77148 11.331 2.77148H6.45597C4.42197 2.77148 2.77197 4.42148 2.77197 6.45648V17.5865C2.77197 19.6215 4.42197 21.2715 6.45597 21.2715H11.341C13.37 21.2715 15.016 19.6265 15.016 17.5975V16.6545" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M21.8096 12.0215H9.76855" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M18.8813 9.1062L21.8093 12.0212L18.8813 14.9372" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                         </svg>                                                        
                     </i>
                         <span class="item-name">Sign Out</span>
                     </a>
                 </li>
             </ul> 
          </div>
        </div>
   </aside> 
     <main class="main-content">
       <div class="position-relative">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar border-bottom">
          <div class="container-fluid navbar-inner">
            <a href="#" class="navbar-brand">
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                 <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
                </i>
            </div>
              <h4 class="title">
              <div class="d-flex"> <span>Hello&nbsp;</span> <img src="image/waving-hand.png" width="30" height="30" alt=""></div>
              </h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
                  <span class="navbar-toggler-bar bar1 mt-2"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
          </div>
        </nav>        
        <!--Nav End-->
        <!-- content start -->
        <div class="container-fluid pb-0">
                <div class="card px-3 py-2">
                     <div class="card-body-small">
      <div class="mb-2 d-flex justify-content-between align-items-center">
        <div></div>
        <h4>SMTP BULK EMAIL SENDER</h4>
        <div class="d-flex gap-4">
        <div id="info" data-bs-toggle="modal" data-bs-target="#db_info">  
        <i class="icon" style="cursor:pointer">                              
        <svg width="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C17.108 2.75 21.25 6.891 21.25 12C21.25 17.108 17.108 21.25 12 21.25C6.891 21.25 2.75 17.108 2.75 12C2.75 6.891 6.891 2.75 12 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M11.9951 8.2041V12.6231" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M11.995 15.7959H12.005" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg></i></div>
        <div id="settings" data-bs-toggle="modal" data-bs-target="#sel">
          <i class="icon" style="cursor:pointer">
        <svg width="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                  
            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8064 7.62361L20.184 6.54352C19.6574 5.6296 18.4905 5.31432 17.5753 5.83872V5.83872C17.1397 6.09534 16.6198 6.16815 16.1305 6.04109C15.6411 5.91402 15.2224 5.59752 14.9666 5.16137C14.8021 4.88415 14.7137 4.56839 14.7103 4.24604V4.24604C14.7251 3.72922 14.5302 3.2284 14.1698 2.85767C13.8094 2.48694 13.3143 2.27786 12.7973 2.27808H11.5433C11.0367 2.27807 10.5511 2.47991 10.1938 2.83895C9.83644 3.19798 9.63693 3.68459 9.63937 4.19112V4.19112C9.62435 5.23693 8.77224 6.07681 7.72632 6.0767C7.40397 6.07336 7.08821 5.98494 6.81099 5.82041V5.82041C5.89582 5.29601 4.72887 5.61129 4.20229 6.52522L3.5341 7.62361C3.00817 8.53639 3.31916 9.70261 4.22975 10.2323V10.2323C4.82166 10.574 5.18629 11.2056 5.18629 11.8891C5.18629 12.5725 4.82166 13.2041 4.22975 13.5458V13.5458C3.32031 14.0719 3.00898 15.2353 3.5341 16.1454V16.1454L4.16568 17.2346C4.4124 17.6798 4.82636 18.0083 5.31595 18.1474C5.80554 18.2866 6.3304 18.2249 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6516 8.2191 17.7822C8.70725 17.9128 9.12299 18.233 9.37392 18.6717C9.53845 18.9489 9.62686 19.2646 9.63021 19.587V19.587C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5001 14.7053 20.6491 14.7103 19.5962V19.5962C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6807 16.6233 17.6831C16.9449 17.6917 17.2594 17.7798 17.5387 17.9394V17.9394C18.4515 18.4653 19.6177 18.1544 20.1474 17.2438V17.2438L20.8064 16.1454C21.0615 15.7075 21.1315 15.186 21.001 14.6964C20.8704 14.2067 20.55 13.7894 20.1108 13.5367V13.5367C19.6715 13.284 19.3511 12.8666 19.2206 12.3769C19.09 11.8873 19.16 11.3658 19.4151 10.928C19.581 10.6383 19.8211 10.3982 20.1108 10.2323V10.2323C21.0159 9.70289 21.3262 8.54349 20.8064 7.63277V7.63277V7.62361Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <circle cx="12.1747" cy="11.8891" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
        </svg> </i> </div> </div></div>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="Input0" class="form-label">Name</label>
  <input type="text" class="form-control" id="Input0" name="name" placeholder="Company/Person Name (Optional)">
</div>
        <div class="mb-3">
  <label for="Input1" class="form-label">Send to</label>
  <div><input type="email" class="form-control" id="Input1" name="email" placeholder="name@example.com"> <span class="text-muted"> <b style="color:tomato">* </b>To input multiple email address Load from a txt file </span><input type="file" name="txt" id="txt" accept="txt"></div>
</div>
<div class="mb-3">
  <label for="Input2" class="form-label">BCC</label>
  <div><input type="email" class="form-control" id="Input2" name="bcc" placeholder="optional"><span class="text-muted"> <b style="color:tomato">* </b>To input multiple email address Load from a txt file </span><input type="file" name="bcctxt" id="btctxt" accept="txt"><div>
</div>
<div class="mb-3">
  <label for="Input3" class="form-label">CC</label>
  <div><input type="email" class="form-control" id="Input3" name="cc" placeholder="optional"><span class="text-muted"> <b style="color:tomato">* </b>To input multiple email address Load from a txt file </span><input type="file" name="cctxt" id="cctxt" accept="txt"></div>
</div>
<div class="mb-4">
  <label for="Input4" class="form-label">Subject</label>
  <input type="text" class="form-control" id="Input4" name="subject" placeholder="Message Title" required>
</div>
<div class="mb-3">
 <select name="temp" class="form-select" arial-label="No template selected">
  <option selected>Select template (Option Not Available)</option>
 </select>
</div>
 <div class="mb-3 form-check form-switch">
  <input type="checkbox" id="debug" class="form-check-input" name="debug">
  <label class="form-check-label" for="debug">Debugger</label>
</div> 
    <div class="mb-3">
        <h6 class="mb-2">Message (html format)</h6>
        <textarea name="editor" id="editor" rows="20" cols="70"></textarea>                       
    </div>
    <input type="submit" name="submit" class="btn btn-primary" value="Send Message">
    </form>
      </div>
          </div>
           </div></div></div>
        <!-- content end -->
      <footer class="footer">
          <div class="footer-body">
            <ul class="left-panel list-inline mb-0 p-0">
                <li class="list-inline-item"><a href="#" class="text-white">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Terms of Use</a></li>
            </ul>
              <div class="right-panel">All Rights Reserved
               &copy; Nexsus 2023 - <script>document.write(new Date().getFullYear())</script>
           </div>
          </div>
      </footer>
   </main>
     <!-- modal #1 start-->
     <div class="modal fade" id="config" tabindex="-1" aria-labelledby="settings-modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="settings-modal">Smtp Config</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="form-data" name="form-data" role="form">
                <div class="row mb-4"> 
                  <div class="col-md-6"> 
                  <label for="server" class="col-form-label">Smtp Server:</label>
                  <input type="text" name="server" class="form-control" placeholder="smtp.site.com" id="server" required>
                </div> 
                <div class="col-md-6">
                  <label for="port" class="col-form-label">Port:</label>
                  <input type="text" name="port" class="form-control" id="port" required>
                  <sub style='color:rgb(209, 73, 49); margin-top: 5px; margin-left:4px'>25 2525 465 587</sub>
                </div>
                <div class="col-md-6">
               <label for="security" class="col-form-label">Security:</label>
               <select name="security" class="form-select form-select-option">
                  <option selected value='auto'>Auto</option>
                  <option value='none'>None</option>
                  <option value='tls'>Tls</option>
                  <option value='ssl'>SSL</option>
                  <option value='tls_0'>Tls when available</option>
               </select>
                </div>
                <div class="col-md-6">
                <label for="timeout" class="col-form-label">Timeout:</label>
                <input type="text" name="timeout" class="form-control" id="timeout" value="5000" placeholder="optional">
                <sub style='color:rgb(209, 73, 49); margin-top: 5px; margin-left:4px'>In milliseconds e.g for 3s input 3000</sub>
              </div>
              <div class="col-md-6">
                <label for="username" class="col-form-label">Username:</label>
                <input type="text" name="username" class="form-control" id="username" required>
              </div>  
              <div class="col-md-6">
                <label for="password" class="col-form-label">Password:</label>
                <input type="text" name="password" class="form-control" id="password" required>
              </div>  
              <div class="col-md-12">
                <label for="cname" class="col-form-label">Configuration Name:</label>
                <input type="text" name="cname" class="form-control" id="cname" required>
              </div> 
              </div>
               <p class="text-center"> <button type="submit" name="submit" id="btn" class="btn btn-success">Save</button></p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-target="#sel" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="hide_config()">Back</button>
            </div>
          </div>
        </div>
      </div>
       <!-- modal #1 end-->
         <!-- modal #2 start-->
         <div class="modal fade" tabindex="-1" aria-labelledby="info-modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="info-modal">Email Info</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Smtp Server: <?php echo $ss; ?></h6>
                <h6>Port: <?php echo $pt; ?></h6>
                <h6>Security: <?php echo $sec; ?></h6>
                <h6>Username: <?php echo $uname; ?></h6>
                <h6>Password: <?php echo $pwd; ?></h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
              </div>
                 </div>
                    </div>
           <!-- modal #2 end-->
                    <!-- modal #3 start-->
         <div class="modal fade" id="load" tabindex="-1" aria-labelledby="load-modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="load-modal">Load Config</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mdb">
              <?php
              if(isset($name) && !empty($name))
              for($i=0; $i<count($name); $i++){
          echo "<div class='modalbox item' data-stat='$status[$i]'><h3><button class='btn btn-outline-primary'>$name[$i]</button></h3></div>
            <hr>";}
            else {
              echo "<h6>no settings to show</h6>";
            }
            ?>
            </div>
            <div class="modal-footer">
              <button type="button"class="btn btn-primary" data-bs-dismiss="modal" data-bs-target="#sel" data-bs-toggle="modal" onclick="hide_load()">Back</button>
            </div>
              </div>
                 </div>
                    </div>
           <!-- modal #3 end-->
                    <!-- modal #4 start-->
         <div class="modal fade" tabindex="-1" aria-labelledby="sel-modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sel-modal">Settings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <div class="modalbox"><h3> <button class="btn btn-outline-primary mb-3" data-bs-target="#config" data-bs-toggle="modal" onclick="hide_sel()" data-bs-dismiss="modal">New Config</button></h3></div>
                  <hr>
                  <div class="modalbox"><h3><button class="btn btn-outline-primary mb-3" data-bs-target="#load" data-bs-toggle="modal" onclick="hide_sel()" data-bs-dismiss="modal">Load Config</button></h3></div>
                  <hr>
                  <div class="modalbox"><h3><button class="btn btn-outline-primary mb-3" data-bs-target="#delete" data-bs-toggle="modal" onclick="hide_sel()" data-bs-dismiss="modal">Delete Config</button></h3></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
              </div>
                 </div>
                    </div>
           <!-- modal #4 end-->
            <!-- modal #5 start-->
         <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="delete_modal">Delete Configuration</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-md-12 mb-3">
                <label for="del" class="col-form-label">Enter Configuration Name:</label>
                <input type="text" name="del" class="form-control" id="del" required>
              </div>
              <p class="text-center"> <button type="submit" id="delbtn" class="btn btn-success col-md-6">Delete</button></p>
            </div>
            <div class="modal-footer">
            <button type="button"class="btn btn-primary" data-bs-dismiss="modal" data-bs-target="#sel" data-bs-toggle="modal" onclick="hide_del()">Back</button>
            </div>
              </div>
                 </div>
                    </div>
           <!-- modal #5 end-->
                   <!-- modal #2.1 start-->
         <div class="modal fade" id="db_info" tabindex="-1" aria-labelledby="info-modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="info-modal">Message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <p><h4>Option Not Available</h4></p>
                 <p>Visit the link on Readme.md to get the full version</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
              </div>
                 </div>
                    </div>
           <!-- modal #2.1 end-->
                    <!-- modal #4.1 start-->
         <div class="modal fade" id="sel" tabindex="-1" aria-labelledby="sel-modal" aria-hidden="true">
        <div class="modal-dialog">   
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sel-modal">Message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <p><h4>Option Not Available</h4></p>
                 <p>Visit the link on Readme.md to get the full version</p>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
              </div>
                 </div>
                    </div>
           <!-- modal #4 end-->
    <script src="js/libs.min.js"></script>
    <script src="js/app.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>
 CKEDITOR.replace( 'editor', { uiColor: '#d2cabd' });
     </script>
<?php
if (isset($_POST['submit'])){
    if (empty($_POST['editor']) || empty($_POST['subject'])){
        echo "<script>alert('message or title of message cannot be left empty')</script>"; 
        exit("Try again");
    }
    if((empty($_POST['cc']) && empty($_POST['bcc']) && empty($_POST['email']))
    && (empty($_FILES['cctxt']) && empty($_FILES['bcctxt']) && empty($_FILES['txt']))){
             echo "<script>alert('email, bcc and cc cannot all be left empty')</script>"; 
             exit("Try again");
            }
    $message = $_POST['editor']; 
    include_once 'actions/email_config.php';
    $mail = new PHPMailer();
    $mail->isSMTP();
    if (isset($_POST['debug'])){
    $mail->SMTPDebug = 4;}
    $mail->Host="{$mail_info['smtp_server']}";
    $mail->Port= $mail_info['port'];
    $mail->SMTPAuth=true;
    $mail->SMTPSecure="{$mail_info['security']}";
    $mail->Username="{$mail_info['username']}";
    $mail->Password="{$mail_info['password']}";
    if (isset($_POST['name'])){
      $mail->setFrom("{$mail_info['username']}","{$_POST['name']}");
    }
    else { $mail->setFrom("{$mail_info['username']}"); }
    include 'actions/sendto.php';
    $mail->isHTML(true);
    $mail->Subject=$_POST['subject'];
    $temp = filter_input(INPUT_POST, 'temp', FILTER_SANITIZE_STRING);
    if (isset($_POST['temp']))
    {
    $html = file_get_contents("template/${temp}_temp.html");
    $html = str_replace("{message}",$message,$html);
    $mail->Body=$html;
    }
    else
    {
      $mail->Body=$message;
    }
    if(!$mail->send())
    { echo "<script>swal({
      icon: 'error',
      title: 'Failed to send',
      text: '{$mail->ErrorInfo}'
      })</script>"; }
    else {
        echo "<script>alert('Message Successfully sent')</script>";
    }
    $mail->smtpClose();
    if($conn){
      $conn->close();
    }
}
?>
  </body>
</html>
