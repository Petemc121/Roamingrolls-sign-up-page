
<?php
/* Template Name: Sign_up*/

get_header();

global $wpdb;


define('SITE_KEY', "6LeIgKUaAAAAADnCskrtL8C-Bbo17h1z0OhPvXTP");
define('SECRET_KEY',"6LeIgKUaAAAAAD_NLyIM17NQggDrVarf02QVbPtz");

 function getCaptcha($secretKey) {
  
  $ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'secret' => SECRET_KEY,
        'response' => $secretKey,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ],
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);
curl_close($ch);
  $return = json_decode($response);
  return $return;
}

function my_theme_create_new_user(){

  
  
  if (isset($_POST['djie3gehj3edub3u']) || wp_verify_nonce($_POST['djie3gehj3edub3u'], 'create_user_form_submit' ))
   {






    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_text_field($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $user_id = username_exists( $username );
    

    if ($user_id) {
      echo '<style type="text/css">
      #alertusere {
          display: block !important;
      }
      </style>';
    }else

    if(email_exists($email) == true ) {
      echo '<style type="text/css">
          #alertemailhave{
              display: block !important;
          }
          </style>';
      
    } else
    
      if ($_POST['password']  == '') {
  
             echo '<style type="text/css">
             #alertpasswordm {
                display: block !important;
            }
            </style>';
            
          } else
        
          
          if ($_POST['password'] != $_POST['password2']) {
        
           echo '<style type="text/css">
            #alertpasswordsame {
                 display: block !important;
            }
            </style>';
            
          } else
          
          if (strlen($_POST['password']) < 8) {
            
            echo '<style type="text/css">
          #alertpasswordx {
                 display: block !important;
             }
           </style>';
         
            } else {

              $return = getCaptcha($_POST['g-recaptcha-response']); 

              if($return->success == true && $return->score >0.5) 
              {
              
    
  
        $user_id = wp_create_user( $username, $password, $email );
        $new_post = array(
              'post_title' =>$username,
              'post_author' =>$user_id,
              'post_type' => 'Profiles',
              'post_name' => $username,
                    
    );

    wp_mail($email, 'Welcome to Roaming Rolls!', 'Hi '.$username.', You can now add as many gyms as you like to our database.');

    $pid = wp_insert_post($new_post);

    wp_publish_post($pid);

        echo '<style type="text/css">
              #success {
                  display: block !important;
              }
              </style>';

               echo '<style type="text/css">
              #fullArrow {
                  display: block !important;
              }
              </style>';

              wp_redirect( 'https://www.roamingrolls.com/Profiles/'.$username );
            }  else {
              echo "<script>alert('Your session timed out')</script>";
            }       
  
        }
  }
    }
  

  add_action('init', 'my_theme_create_new_user');

if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {


  if ($_POST['username'] == '') {

    echo '<style type="text/css">
    #alertuserm {
        display: block !important;
    }
    </style>';

  } else

  if ($_POST['email'] == '') {

    echo '<style type="text/css">
    #alertemailm {
        display: block !important;
    }
    </style>';

  } else {

  my_theme_create_new_user();
  }
}






// if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {


  // if ($_POST['username'] == '') {

  //   echo '<style type="text/css">
  //   #alertuserm {
  //       display: block !important;
  //   }
  //   </style>';

  // } else

  // if ($_POST['email'] == '') {

  //   echo '<style type="text/css">
  //   #alertemailm {
  //       display: block !important;
  //   }
  //   </style>';

  // } else
  
//   if ($_POST['password']  == '') {

//     echo '<style type="text/css">
//     #alertpasswordm {
//         display: block !important;
//     }
//     </style>';

//   } else

  
//   if ($_POST['password'] != $_POST['password2']) {

//     echo '<style type="text/css">
//     #alertpasswordsame {
//         display: block !important;
//     }
//     </style>';

//   } else
  
//   if (strlen($_POST['password']) < 8) {
    
//     echo '<style type="text/css">
//     #alertpasswordx {
//         display: block !important;
//     }
//     </style>';


//   } else
  
//   {

//     $query = "SELECT `id` FROM `_S9Q_RRusers` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

//     $query2 = "SELECT `id` FROM `_S9Q_RRusers` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."'";
    
//     $result = mysqli_query($link, $query);
//     $result2 = mysqli_query($link, $query2);

//     if (mysqli_num_rows($result2) > 0) {

      // echo '<style type="text/css">
      // #alertusere {
      //     display: block !important;
      // }
      // </style>';


//     } else if (mysqli_num_rows($result) > 0) {

//       echo '<style type="text/css">
//     #alertemailhave{
//         display: block !important;
//     }
//     </style>';

//     } else {

//       $password = $_POST["password"];
//       $id = "SELECT `id` FROM `_S9Q_RRusers`";
//       $password = md5($id.$password);
//       $query = "INSERT INTO `_S9Q_RRusers`(`Username`,`Email`,`Password`) VALUES ('".mysqli_real_escape_string($link, $_POST['username'])."','".mysqli_real_escape_string($link, $_POST['email'])."', '$password')";

//       mysqli_query($link, $query);

//       if ($query) {
        
//         echo '<style type="text/css">
//       #success {
//           display: block !important;
//       }
//       </style>';

//     } else {
//       echo "<script>alert('error')</script>";
//     }

//     }

//   } 


// }



?>


  <head>

  <style type="text/css">


    body {

        margin-top:120px;
        overflow-x:hidden;
    }

    #alertpasswordx {

        display:none;

    }

    #alertpasswordm {

display:none;

}
#alertemailx {

display:none;

}
#alertemailm {

display:none;

}
#alertuserm {

display:none;

}
#alertusere {

display:none;

}

#alertpasswordsame {

    display:none;
}

#success {
  display:none;


}

#arrowTop {
  transition: all 0.5s;
  width: 0; 
  height: 0; 
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  border-bottom: 15px solid #7ace86;
  position:relative;
  
}
#arrowBottom {
  transition: all 0.5s;
  width:12px;
  height:20px;
  background-color:#7ace86;
  position:relative;
  left:9px;
}

#fullArrow {
  position:absolute;
  top:85px;
  right:70px;
  transition:all 0.5s;
  display:none;
}

#alertemailhave {

  display:none;

}

.register {

    background-image: linear-gradient(#c1c1c4, #aabff5);
    border-radius:5px;
    margin-bottom:100px
    padding:10px;
    width:50% !important;
}

.recap {
  margin-top:-80px;
  margin-bottom:50px;
  line-height:50px;
}

#recapImg {
  width:50px;
  height:50px;
}


@media only screen and (max-width: 700px) {
  .register {


    width:70% !important;
}
}



.signLabel {

    color:#081640;
}

#sub {

  margin-bottom:20px;
  background-image: linear-gradient(#0A0A23, #071A4B);
	color:white;
margin-top:10px;
border:none;
border-radius:5px;
height:40px;
width:100px;
font-size:20px;


}

#signcon {

  margin-bottom:100px;
}

.grecaptcha-badge {
 visibility: collapse !important;  


  
}



</style>
   
 <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
  </head>

  <body>

  <div class="container">
  <div id="alertuserm" class="alert alert-danger" role="alert">
          Username field is empty.
        </div>
        <div id="alertusere" class="alert alert-danger" role="alert">
          That username has already been taken.
        </div>
        <div id="alertemailm" class="alert alert-danger" role="alert">
          Email field is empty. 
        </div>
        <div id="alertemailx" class="alert alert-danger" role="alert">
          Email doesn't exist.
        </div>
        <div id="alertpasswordx" class="alert alert-danger" role="alert">
          Your password must be at least 8 characters long.
        </div>
        <div id="alertpasswordm" class="alert alert-danger" role="alert">
        Password field is missing.</div>
        <div id="alertemailhave" class="alert alert-danger" role="alert">
          That email has already been taken. 
        </div>
        <div id="success" class="alert alert-success" role="alert">
          Congratulations! You've successfully registered with us! You can now log in.       </div>

</div>

<div id="fullArrow">
<div id="arrowTop"></div>
<div id ="arrowBottom"></div>
</div>


    <div id="signcon" class="container register">
    
   
    <h1 class = "titles">Sign up</h1>
    <form id="signUp" action='?' method = "POST">
    <?php wp_nonce_field( 'create_user_form_submit', 'djie3gehj3edub3u' ); ?>
    <div class="form-group">
    <label class = "signLabel" for="Username">Username</label>
    <input type="username" name="username" class="form-control" id="userin" placeholder="Make sure it's unique!" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username'];}?>">
</div>
  <div class="form-group">
    <label class = "signLabel" for="emailin">Email address</label>
    <input type="email" name="email" class="form-control" id="emailin" aria-describedby="emailHelp" placeholder="E.g: name@example.com" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email'];}?>">
</div>
  <div class="form-group">
    <label class = "signLabel" for="passwordin">Password</label>
    <input type="password" name="password" class="form-control"  placeholder="At least 8 characters long" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password'];}?>">
  </div>
<div class="form-group">
    <label class = "signLabel" for="passwordin">Confirm password</label>
    <input type="password" name="password2" class="form-control" placeholder="Type your password again."value="<?php if(isset($_SESSION['password2'])) { echo $_SESSION['password2'];}?>">
  </div>
  <div id="alertpasswordsame" class="alert alert-danger" role="alert">
  Your passwords don't match.
</div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Keep me logged in</label>
  </div>
  <p></p>
  <input type="text" name="g-recaptcha-response" id="g-recaptcha-response">
<input id="sub" 
        name="submit" 
       type="submit"      
        >

</input>

</form>



</div>

<div class="recap center">
<div id = "recaptchaMessage">Protected by google reCAPTCHA V3</div>
<img id = "recapImg" src="https://www.roamingrolls.com/wp-content/uploads/2021/04/download.png">
</div>



<script>

  const arrow = document.getElementById('fullArrow');


function error() {
  alert('error')
}

const sub = document.getElementById("sub")
  
sub.onmouseover = function() {

sub.style.backgroundImage = "linear-gradient(#AD0E2C, black)";

};

sub.onmouseout = function() {

sub.style.backgroundImage = "linear-gradient(#0A0A23, #071A4B)";

};

function arrowInit() {


   setInterval(function() {arrow.style.top = "85px"}, 300);
   setInterval(function() {arrow.style.top = "80px"}, 600);
}

arrowInit();




        grecaptcha.ready(function() {
          grecaptcha.execute("<?php echo SITE_KEY ?>", {action: 'submit'}).then(function(token) {
console.log(token)    
const input = document.getElementById('g-recaptcha-response');

input.value = token;
 });
        });
    




</script>

</body>

<div>

<?php

get_footer();

?>

</div>


