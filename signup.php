
<?php
/* Template Name: Sign_up*/

get_header();

global $wpdb;


 $siteKey = "6LeIgKUaAAAAADnCskrtL8C-Bbo17h1z0OhPvXTP";
 $secretKey = "6LeIgKUaAAAAAD_NLyIM17NQggDrVarf02QVbPtz";

 function getCaptcha($secretKey) {
  $response = file_get_contents("https://www.google.com/recaptcha/apisiteverify?secret=".$secretKey."&response=($secretKey)");
  $return = json_decode($response);
  return $return;
}

function my_theme_create_new_user(){

  
  
  if (isset($_POST['djie3gehj3edub3u']) || wp_verify_nonce($_POST['djie3gehj3edub3u'], 'create_user_form_submit' ))
   {

$return = getCaptcha($_POST['g-recaptcha-response']);
$returnObj = var_dump($return);

echo "<script>console.log('".$returnObj."')</script>";



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
    
  
        $user_id = wp_create_user( $username, $password, $email );
        $new_post = array(
              'post_title' =>$username,
              'post_author' =>$user_id,
              'post_type' => 'Profiles',
              'post_name' => $username,
                    
    );

    $pid = wp_insert_post($new_post);

        echo '<style type="text/css">
              #success {
                  display: block !important;
              }
              </style>';
              
  
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


@media only screen and (max-width: 700px) {
  .register {


    width:70% !important;
}
}



label {

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
  position:absolute !important;
  bottom:100px;

  
}



</style>
   
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
          Congratulations! You've successfully registered with us!       </div>

</div>

    <div id="signcon" class="container register">
    
   
    <h1 class = "titles">Sign up</h1>
    <form id="signUp" action='?' method = "POST">
    <?php wp_nonce_field( 'create_user_form_submit', 'djie3gehj3edub3u' ); ?>
    <div class="form-group">
    <label for="Username">Username</label>
    <input type="username" name="username" class="form-control" id="userin" placeholder="Make sure it's unique!" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username'];}?>">
</div>
  <div class="form-group">
    <label for="emailin">Email address</label>
    <input type="email" name="email" class="form-control" id="emailin" aria-describedby="emailHelp" placeholder="E.g: name@example.com" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email'];}?>">
</div>
  <div class="form-group">
    <label for="passwordin">Password</label>
    <input type="password" name="password" class="form-control"  placeholder="At least 8 characters long" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password'];}?>">
  </div>
<div class="form-group">
    <label for="passwordin">Confirm password</label>
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
<button id="sub" 
        name="submit" 
       type="submit"
        >
  Submit
</button>

</form>

</div>


<script>

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


sub.addEventListener("click", function() {
        grecaptcha.ready(function() {
          grecaptcha.execute("<?php echo $siteKey ?>", {action: 'submit'}).then(function(token) {
//console.log(token)    
const input = document.getElementById('g-recaptcha-response');

input.value = token;
 });
        });
      });
      



</script>



</body>

<div>

<?php

get_footer();

?>

</div>
