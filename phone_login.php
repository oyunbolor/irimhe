<?php /* Starts the session */
/* Check Login form submitted */if(isset($_POST['Submit'])){
/* Define username and associated password array */$logins = array('Irimhe' => '123456','username1' => 'password1','username2' => 'password2');

/* Check and assign submitted Username and Password to new variable */$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

/* Check Username and Password existence in defined array */if (isset($logins[$Username]) && $logins[$Username] == $Password){
/* Success: Set session variables and redirect to Protected page  */$_SESSION['UserData']['Username']=$logins[$Username];
header("location:phone.php");
exit;
} else {
/*Unsuccessful attempt: Set error message */$msg="<span style='color:red'>Invalid Login Details</span>";
}
}
?>
<?php
require("config/inc.functions.php");
require("config/inc.session.php");
require("config/inc.language.php");
require("config/inc.cfg.php");
require("config/inc.db.php");
require("notification/inc.alerts.php");
require("templates/inc.main_head.php");
?>

<section class="section contact">
  <!-- container start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-5 ">
        <!-- address start -->
        <div class="address-block">
          <!-- Email -->
          <div class="media">
            <i class="fa fa-exclamation-circle"></i>
            <div class="media-body">
              <h3><?php echo _p("LoginTitle"); ?></h3>
              <p>
				<?php echo _p("PhoneLmsj"); ?>
              </p>
            </div>
          </div>
        </div>
        <!-- address end -->
      </div>
      <div class="col-lg-8 col-md-7">
        <div class="contact-form">
          <!-- contact form start -->
          <form action="" method="post" name="Login_Form">
		  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
			<?php if(isset($msg)){?>
			<tr>
			  <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
			</tr>
			<?php } ?>
			<tr>
			  <td align="right" valign="top"><?php echo _p("LoginName"); ?></td>
			  <td><input name="Username" type="text" class="Input"></td>
			</tr>
			<tr>
			  <td align="right"><?php echo _p("LoginPassword"); ?></td>
			  <td><input name="Password" type="password" class="Input"></td>
			</tr>
			<tr>
			  <td> </td>
			  <td><input name="Submit" type="submit" value="<?php echo _p("LoginButton"); ?>" class="Button3"></td>
			</tr>
		  </table>
		</form>
          <!-- contact form end -->
        </div>
      </div>
    </div>
  </div>
  <!-- container end -->
</section>
