<?php
/* Template Name: password-reset-email*/
get_header();



    $email = sanitize_text_field($_POST['']);

   if ( email_exists($email))
   {
        $userID = email_exists($email);

        $resetKey =get_password_reset_key($userID);

        $url = get_site_url(). '?act=' .base64_encode( serialize($resetKey));

        $html = 'please click the link to reset your password: <br/><br/> <a href="'.$url.'">'.$url.'</a>';

         $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($email, 'Roamingrolls Password Reset', $html, $headers);

   } else {

    echo "<style>#noEmailAlert {display:block !important}</style>";

   }

 }

?>

<body>
 <form name="resetPasswordEmail" method="POST" enctype="multipart/form-data">
  <?php wp_nonce_field( 'reset_password_email', 'scfhhdsnjknlsdknkl'); ?>
      <div id="resetMessage" class="center">Enter the email you signed up with and we'll send you a verification link to reset your password.
</div>
<div class="center">
<div id="noEmailAlert" class="alert alert-danger" role="alert">
  This email isn't in our records.
</div>
</div>
<div id="resetEmailCon" class="center">
    <input id="resetEmail" name="resetEmail" class="form-control" type="text" placeholder="Enter the email you first signed up with.">

    </div>

    <div id="resetEmailSendCon" class="center">
<button type="submit" id="resetEmailSend">
Send
</button>

</form>
</div>




</body>



<?php

get_footer();


?>
