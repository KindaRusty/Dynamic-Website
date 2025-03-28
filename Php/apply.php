<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link rel="stylesheet" href="styles/apply.css">
</head>

<body class="apply-page">
    
    <?php include 'header_apply.inc'; ?>
    <div class="container apply-container">
        <div class="apply_box">
          <h1>Job Application Form</h1> 

          <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post" id="job-application-form">

          <div class="form_container">

            <!-- Job Reference Number -->
              <div class="form_control">
                <label for="job-reference" class="apply-label">Applying for</label>
                <input type="text" id="job-reference" name="job-reference" maxlength="5" required placeholder="Job Reference Number" >
              </div>

            <!-- First Name -->  
              <div class="form_control">
                <label for="first-name" class="apply-label">First Name</label>
                <input type="text" id="first-name" name="first-name" maxlength="20" required pattern="[A-Za-z]+" title="Only letters allowed" placeholder="Enter your first name">
              </div>

            <!-- Last Name -->
              <div class="form_control">
                <label for="last-name" class="apply-label">Last Name</label>
                <input type="text" id="last-name" name="last-name" maxlength="20" required pattern="[A-Za-z]+" title="Only letters allowed" placeholder="Enter your last name">
              </div>

            <!-- Date of Birth -->
             <div class="form_control">
              <label for="dob" class="apply-label">Date of Birth</label>
              <input type="date" id="dob" name="dob">
           </div>
            
            <!-- Street Address -->
             <div class="form_control">
              <label for="address" class="apply-label">Street Address</label>
              <input type="text" id="address" name="address" maxlength="40" required placeholder="Enter your street address">
           </div>

            <!-- Suburb/Town -->
             <div class="form_control">
              <label for="suburb" class="apply-label">Suburb/Town</label>
              <input type="text" id="suburb" name="suburb" maxlength="40" required placeholder="Enter your suburb/town">
           </div>  

            <!-- State -->
             <div class="form_control">
              <label for="state" class="apply-label">State</label>
              <select id="state" name="state" required>
                  <option value="" disabled selected>Choose your state</option> 
                  <option value="VIC">VIC</option>
                  <option value="NSW">NSW</option>
                  <option value="QLD">QLD</option>
                  <option value="NT">NT</option>
                  <option value="WA">WA</option>
                  <option value="SA">SA</option>
                  <option value="TAS">TAS</option>
                  <option value="ACT">ACT</option>
              </select>  
           </div> 

            <!-- Postcode -->
             <div class="form_control">
              <label for="postcode" class="apply-label">Postcode</label>
              <input type="text" id="postcode" name="postcode" pattern="\d{4}" required title="Exactly 4 digits" maxlength="4" placeholder="XXXX">  
           </div>

            <!-- Email -->
             <div class="form_control">
              <label for="email" class="apply-label">Email Address</label>
              <input type="email" id="email" name="email" required placeholder="youremail@domain.tld">
           </div>


            <!-- Phone Number -->
              <div class="form_control">
                <label for="phone" class="apply-label">Phone Number</label>
                <input type="text" id="phone" name="phone" pattern="^[0-9 ]{8,12}$" required title="8 to 12 digits or spaces" minlength="8" maxlength="12" placeholder="(+XX) XX-XXX-XXX"> 
              </div>    
            
            <!-- Gender -->
            <div class="form_control">
              <fieldset class="gender-fieldset">
               <legend class="apply-label">Gender <span class="required"></span></legend>
               <div class="radio-group">
               <label for="male">
              <input type="radio" id="male" name="gender" value="Male" required> Male
               </label>
               <label for="female">
              <input type="radio" id="female" name="gender" value="Female" required> Female
               </label>
               <label for="other">
              <input type="radio" id="other" name="gender" value="Other" required> Other
               </label>
               </div>
              </fieldset>
            </div>

            <!-- Skills -->
            <div class="form_control">
              <label class="apply-label">Skills<span class="required"></span></label>
               <div class="checkbox-group">
             <label><input type="checkbox" name="skills" value="HTML" required> HTML</label>
             <label><input type="checkbox" name="skills" value="CSS"> CSS</label>
             <label><input type="checkbox" name="skills" value="JavaScript"> JavaScript</label>
             <label><input type="checkbox" name="skills" value="Other skills"> Other Skills</label>
               </div>
            </div>
            
            <!-- Other Skills Textarea -->  
              <div class="textarea_control">
                <label for="other-skills" class="apply-label">Other Skills (if applicable)</label>
                <textarea id="other-skills" name="other-skills" rows="4" cols="50" placeholder="Text your other skills"></textarea>
              </div>

              <div class="button_container">
                <button type="submit">Apply</button>
              </div>

           </div>
              
          </form>
    
        </div>

      </div> 
         
    </body>
 
  </html>
    
