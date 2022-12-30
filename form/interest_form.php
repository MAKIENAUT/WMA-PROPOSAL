<?php
   include 'database.php';
   $id = 0;
   $lastname = "";
   $firstname = "";
   $address = "";
   $country = "";
   $state = "";
   $phone_number = "";
   $back_up = "";
   $email = "";
   $profession = "";
   $file;


   if (isset($_POST['submit'])) {
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $address = $_POST['address'];
      $country = $_POST['country'];
      $state = $_POST['state'];
      $phone_number = $_POST['phone_number'];
      $back_up = $_POST['back_up'];
      $email = $_POST['email'];
      $profession = $_POST['profession'];

      $file = $_FILES['file']['name'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $foldername = '../admin/applicant_files/' . $_POST['lastname'] . ", " . $_POST['firstname'];


      $sql = "INSERT INTO form VALUES (NULL, '$lastname', '$firstname', '$address', '$country', '$state', '$phone_number', '$back_up', '$email', '$profession', '$foldername')";
      if (mysqli_query($conn, $sql)) {
         if (!file_exists($foldername)) {
            mkdir($foldername, 0777, true);
            if (count($file) > 1) {
               for ($i = 0; $i < count($_FILES["file"]['name']); $i++) {
                  $filen = $_FILES["file"]['name']["$i"]; //file name
                  $path = $foldername . "/" . $filen; //generate the destination path
                  if (move_uploaded_file($_FILES["file"]['tmp_name']["$i"], $path)) {
                     echo "<script>alert('Success!')</script>";
                  }
               }
            } else {
               echo "<script>alert('Upload the Necessary files!')</script>";
            }
         } else {
            echo "<script>alert('INVALID!')</script>";
         }
      }
   }
   ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="index.css">
   <script src="index.js"></script>
   <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
   <title>Interest Form</title>
</head>

<body>
   <!-- NAVIGATION BAR SECTION [ START ] -->
   <nav class="navbar" id="myNavBar">

      <!-- LOGO SECTION [ START ] -->
      <div class="logo_holder">
         <a class="nav_logo" href="https://westmigrationagency.com/">
            <img src="../photos/wma-logo.png" />
         </a>
      </div>
      <!-- LOGO SECTION [ START ] -->

      <!-- LINKS SECTION [ START ] -->
      <div class="link_holder" id="link_holder">
         <div class="nav_links">
            <a href="../news/news.html">News</a>
         </div>
         <div class="nav_links">
            <a href="../form/interest_form.php">Forms</a>
         </div>
         <div class="nav_links">
            <a href="../process/process.html">Process</a>
         </div>
         <div class="nav_links">
            <a href="../about/about.html">About Us</a>
         </div>
         <div class="nav_links">
            <a href="../contact/contact.html">Contact Us</a>
         </div>
      </div>
      <!-- LINKS SECTION [ END ] -->

      <!-- BURGER MENU SECTION [ START ] -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
         <i class="fa fa-bars"></i>
      </a>
      <!-- BURGER MENU SECTION [ START ] -->

   </nav>
   <!-- NAVIGATION BAR SECTION [ END ] -->

   <!-- ------------------------------------ -->

   <!-- FORM SECTION -->
   <section id="section">
      <div class="container">
         <form name="myForm" action="interest_form.php" method="post" enctype="multipart/form-data">
            <div class="personal_tab" id="personal_tab">
               <label id="personal-info">1. Personal Info *</label>
               <label id="name-title">Name *</label>
               <input type="text" id="lastname" name="lastname" onchange="validate()" onclick="validate()"
                  placeholder="Last Name">
               <input type="text" id="firstname" name="firstname" onchange="validate()" onclick="validate()"
                  placeholder="First Name">

               <label id="address-title">Address *</label>
               <input type="text" id="address" name="address" onchange="validate()" onclick="validate()"
                  placeholder="Address">
               <input type="text" id="country" name="country" onchange="validate()" onclick="validate()"
                  placeholder="Country">
               <input type="text" id="state" name="state" onchange="validate()" onclick="validate()" placeholder="State">
            </div>

            <div class="contact_tab" id="contact_tab">
               <label id="contact-info">2. Contact Info *</label>
               <label id="contact-title">Contacts *</label>
               <input type="text" id="phone_number" name="phone_number" onchange="validate()" onclick="validate()"
                  placeholder="Phone Number">
               <input type="text" id="back_up" name="back_up" onchange="validate()" onclick="validate()"
                  placeholder="BackUp Number" value="BackUp #: Edit if available.">
               <input type="email" id="email" name="email" onchange="validate()" onclick="validate()"
                  placeholder="Email Address" required>
            </div>
            <div class="interest_tab" id="interest_tab">
               <label id="contact-info">3. Interest Form *</label>
               <label id="contact-title">Current Profession *</label>

               <div class="profession">
                  <select id="profession" name="profession" onclick="validate()"
                     onchange="showfield(this.options[this.selectedIndex].value)">
                     <option value="" disabled selected hidden>Choose Profession</option>
                     <option value="Teacher">Teacher</option>
                     <option value="Physician">Physician</option>
                     <option value="Professor or Research Scholar">Professor or Research Scholar</option>
                     <option value="Short-term Scholar">Short-term Scholar</option>
                     <option value="Student: College/University">Student: College/University</option>
                     <option value="Trainee">Trainee</option>
                     <option value="Au Pair/Educare">Au Pair/Educare</option>
                     <option value="Specialist">Specialist</option>
                     <option value="Intern">Intern</option>
                     <option value="Other" id="other">Other</option>
                  </select>
                  <div id="div1">If Other: <input type="text" name="other_option" id="other_option" onclick="change()"
                        onchange="change()" />
                  </div>
               </div>

               <div class="eligibility">
                  <label id="eligibility-title">
                     Do you meet the eligibility requirement for the specific program? *
                     <br>
                     Press "Yes" to proceed.
                  </label>
                  <div class="yes">
                     <input type="radio" id="yes" name="eligible" value="Yes" onchange="submitActivator()" onclick="termsAgree()" disabled>
                     <label for="yes" id="yes_label">YES - If unclickable, please check form.</label>
                  </div>
                  <div class="no">
                     <input type="radio" id="no" name="eligible" value="No" checked onclick="termsAgree()">
                     <label for="no">Not Sure - Refer to Image </label>
                  </div>
               </div>

               <div class="reference">
                  <p>Program Category Requirements</p>
                  <img class="reference_content" src="../photos/category.jpg">
                  <img class="reference_content" src="../photos/category2.PNG">
               </div>
            </div>
            <div class="upload_tab">
               <div class="upload" id="upload">
                  <label id="upload-info">4. Document Upload *</label>

                  <label id="valid-title1">!!! Please upload PDF format of files.</label>
                  <label id="valid-title">Resume / Curriculum Vitae *</label>
                  <label for="resume" class="valid-input" id="resume_label">
                     Resume / Curriculum Vitae
                     <input type="file" name="file[]" id="resume" onchange="fileChecker()" accept="application/pdf">

                  </label>

                  <label id="valid-title">Credential Evaluation <br>
                     (if applicable)</label>
                  <label for="credential" class="valid-input" id="credential_label">
                     NACES-approved credential evaluation agency
                     <input type="file" name="file[]" id="credential" onchange="fileChecker()" accept="application/pdf">
                  </label>

                  <label id="valid-title">Reputation and Character <br>(if applicable)</label>
                  <label for="reference" class="valid-input" id="reference_label">
                     Reference letter from a colleague and <br>
                     immediate supervisor
                     <input type="file" name="file[]" id="reference" onchange="fileChecker()" accept="application/pdf">
                  </label>

                  <label id="valid-title">Passport *</label>
                  <label for="passport" class="valid-input" id="passport_label">
                     First Page and Last Page
                     <input type="file" name="file[]" id="passport" onchange="fileChecker()" accept="application/pdf">
                  </label>
               </div>
            </div>
            <div class="privacy_tab">
               <label id="contact-info">5. Privacy Policy *</label>
               <p>
                  Read the Privacy Policy and give permission for West Migration Agency LLC to share my information and
                  discuss my candidacy with any US Sponsors as part of the visa process.
               </p>

               <label id="contact-title">Terms and Conditions *</label>
               <a href="https://docs.google.com/document/d/1WMAgSCGvUyVnzKEelKPdI4RcKVJ5v4KCrGwe4w60PNk/edit">Click And
                  Read!</a>

               <div class="terms">
                  <input 
                     type="checkbox" 
                     id="terms" 
                     name="terms" 
                     onchange="validate()"
                     onclick="termsAgree(); submitActivator()">
                  <label> Terms and Conditions *</label>
               </div>

               <div class="submit">
                  <label onmouseover="submitActivator()" for="submit" id="validity_check">If submit button is still
                     disabled, Please check the form's validity!</label>
                  <br>
                  <br>
                  <button type="submit" name="submit" id="submit" disabled
                     onmouseover="submitActivator()">SUBMIT</button>
               </div>
            </div>
         </form>
      </div>
   </section>
</body>

</html>