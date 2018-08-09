<!--  <div id="websignupform">
           
           	<form method="post" action="https://app.icontact.com/icp/signup.php" name="icpsignup" id="icpsignup4292" accept-charset="UTF-8" onsubmit="return verifyRequired4292();" >
            <input type="hidden" name="redirect" value="http://www.leanagiletraining.com/bw/thank/">
            <input type="hidden" name="errorredirect" value="http://www.icontact.com/www/signup/error.html">

            <div id="SignUp">

                    <input type="text" id="newsletters" name="fields_email" value= "sign up for our newsletter" onblur="if (this.value == '') {this.value = 'sign up for our newsletter';}"
             onfocus="if (this.value == 'sign up for our newsletter') {this.value = '';}">
                
                <input type="hidden" name="listid" value="__multi">
                <input type="hidden" name="lists" value="15660:18105:59016">
                <input type="hidden" name="specialid:15660" value="1AOH">
                <input type="hidden" id="listid:15660" name="listid:15660" value="listid:15660">
                <input type="hidden" name="specialid:59016" value="78BX">
                <input type="hidden" id="listid:59016" name="listid:59016" value="listid:59016">
                <input type="hidden" name="clientid" value="198130">
                <input type="hidden" name="formid" value="4292">
                <input type="hidden" name="reallistid" value="1">
                <input type="hidden" name="doubleopt" value="0">
                
                  <input type="submit" id="go" name="Submit" value="Go">
                
            </div>
            </form>

            <script type="text/javascript">

            var icpForm4292 = document.getElementById('icpsignup4292');

            if (document.location.protocol === "https:")

            	icpForm4292.action = "https://app.icontact.com/icp/signup.php";
            function verifyRequired4292() {
              if (icpForm4292["fields_email"].value == "") {
                icpForm4292["fields_email"].focus();
                alert("The Email field is required.");
                return false;
              }


            return true;
            }
            </script>
           
           
       </div> websignupform -->
<?php
            if (isset($_POST['submit']))
              {
              // Execute this code if the submit button is pressed.
              $formvalue = $_POST['email_name'];
              }
            ?>
<form action="<?php bloginfo('url'); ?>/contact-lean-agile-training/newsletters/?email=<?php echo $_GET['Email']; ?>" method="_GET">
    <div id="websignupform">
        <input type="text" id="newsletters" name="Email" value= "sign up for our newsletter" onblur="if (this.value == '') {this.value = 'sign up for our newsletter';}"
             onfocus="if (this.value == 'sign up for our newsletter') {this.value = '';}"></input>
        <input type="submit" id="go" name="submit" value="Go">
        
    </div>
</form>




