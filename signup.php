
<?php
/* Template Name: Sign_up*/

get_header();

global $wpdb;

function my_theme_create_new_user(){
  
  if (isset($_POST['djie3gehj3edub3u']) || wp_verify_nonce($_POST['djie3gehj3edub3u'], 'create_user_form_submit' ))
   {
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_text_field($_POST['email']);
    $password = $_POST['password'];
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

        margin:120 0 0 0;
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

    background-color:#6d878f;
    border-radius:5px;
    margin-bottom:100px
    padding:10px;

}



label {

    color:white;
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
    <form action='' method = "post">
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
    <input type="password" name="password" class="form-control"  placeholder="Must be at least 8 characters long" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password'];}?>">
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
<button id="sub" type="submit" name="submit" class="btn btn-primary">Submit</button>
<div></div>
</form>

</div>


<script>

  
document.getElementById("sub").onmouseover = function() {

document.getElementById("sub").style.backgroundImage = "linear-gradient(#AD0E2C, black)";

};

document.getElementById("sub").onmouseout = function() {

document.getElementById("sub").style.backgroundImage = "linear-gradient(#0A0A23, #071A4B)";

};

</script>



</body>

<div>

<?php

get_footer();

?>

</div>
