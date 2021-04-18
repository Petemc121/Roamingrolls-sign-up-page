<?php

global $wpdb;
global $current_user;
wp_get_current_user();


$kv_author =get_the_author_meta('ID'); 	

 if($current_user->ID != $kv_author){
    echo "<style>#coverPhotoUp{display:none !important;}</style>";
    echo "<style>#profilePicUp{display:none !important;}</style>";
    
 } 

 
function uploadInstructFile($file, $meta_key, $fileIn) {

$post_id = get_the_ID();
  $uploadsDir = wp_upload_dir();
  $allowedFileType = array('jpg','png','jpeg');
  $filename = $file['name'];
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));



      $check = getimagesize($file["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "<script>alert('invalid file!')</script>";
        $uploadOk = 0;
      }
  
    

    if(in_array($imageFileType, $allowedFileType)) {
      $uploadOk = 1;
    } else {
      echo "<script>alert('incorrect file type!')</script>";
      $uploadOk = 0;
    }

    if ($file["size"] > 600000) {
      echo "<script>alert('Too large')</script>";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "<script>alert('Your file was not uploaded!')</script>";
      return false;
    } else {


      $attach_id = insert_attachment($fileIn, $post_id);
      update_post_meta($post_id, $meta_key, $attach_id);
      
    }
  
  }

  if (isset($_POST['sdfhjrcjkllcrknjcrk'])) {
  
  if(wp_verify_nonce($_POST['sdfhjrcjkllcrknjcrk'], 'cover_form' )) {
  
if (!empty($_FILES['cover_photo']['name'])) {

  $coverImg = $_FILES['cover_photo'];

  uploadInstructFile($coverImg, 'cover_photo', 'cover_photo');

}
  }
}

  if (isset($_POST['svnlvnknvjklkjdbfjkd'])) {
  
  if(wp_verify_nonce($_POST['svnlvnknvjklkjdbfjkd'], 'profile_img_form' )) {
  
if (!empty($_FILES['profile_photo']['name'])) {

  $profileImg = $_FILES['profile_photo'];

  uploadInstructFile($profileImg, 'profile_photo', 'profile_photo');

}
  }
}


if (isset($_POST['cskbhcsjlkjasdknhkvlknklj'])) {
  $post_id = get_the_ID();

  if(wp_verify_nonce($_POST['cskbhcsjlkjasdknhkvlknklj'], 'details_form' )) {

         if($_POST['profileNameIn'] != "") {

          $profileName =  sanitize_text_field($_POST['profileNameIn']);

          update_post_meta($post_id, 'profile_name', $profileName);
         }

            if($_POST['profileBelt'] != "") {

              $profileBelt =  sanitize_text_field($_POST['profileBelt']);

               update_post_meta($post_id, 'profile_belt', $profileBelt);
            }


  }
}
?>

<body>
<div class="mySlideD">
<form id="coverForm" enctype="multipart/form-data" method="post">
<?php wp_nonce_field( 'cover_form', 'sdfhjrcjkllcrknjcrk' ); ?>
    <img  id="coverPhoto" src="
    <?php 
    $post_id = get_the_ID();

      $cover = get_post_meta($post_id, 'cover_photo', true );

    if ($cover == "") {

          echo "https://www.roamingrolls.com/wp-content/uploads/2020/08/Untitled-design-20.png";
    } else {
    $coverURL = wp_get_attachment_url($cover);
      echo $coverURL;
    }

    ?>">
    <input id="DisUpload" onchange="fasterPreview(this, '#coverPhoto', 'cancelCover', 'saveCover', 'coverPhotoUp')" type="file" 
    name="cover_photo" placeholder="Photo" required="" capture style="display:none;">

    
  </div>
   <button id="saveCover" class="plusPic" type="submit">Save</button>
</form>
<button id="cancelCover" class="plusPic" >Cancel</button>
  <button onclick="$('#DisUpload').click()" id ="coverPhotoUp"><i class="fas fa-file-upload"></i>
    </button>


<div id="profile-pic">
  <form id="profileForm" enctype="multipart/form-data" method="post">
<?php wp_nonce_field( 'profile_img_form', 'svnlvnknvjklkjdbfjkd' ); ?>

    <img id = "ProfileImg" src="
     <?php 
    $post_id = get_the_ID();

      $profile = get_post_meta($post_id, 'profile_photo', true );

    if ($profile == "") {

          echo "https://www.roamingrolls.com/wp-content/uploads/2020/11/avatar.gif";
    } else {
    $profileURL = wp_get_attachment_url($profile);
      echo $profileURL;
    }

    ?>">

  

    <input id="profilePicIn" onchange="fasterPreview(this, '#ProfileImg','cancelProfilePic','saveProfilePic','profilePicUp')" type="file" 
    name="profile_photo" placeholder="Photo" required="" style="display:none" capture>
   <button id="saveProfilePic" class="plusPic" type="submit">Save</button>

  </form>
      <button onclick="$('#profilePicIn').click()" id ="profilePicUp"><i class="fas fa-file-upload"></i>
    </button>
    <button id="cancelProfilePic" class="plusPic" >Cancel</button>

</div>

 <button id ="editDetailsButton"><i class="fas fa-file-upload"></i>
    </button>

    <form method="post">
      <?php wp_nonce_field( 'details_form', 'cskbhcsjlkjasdknhkvlknklj' ); ?>
<div id="nameInput" class="center">
    <input type="text" id="profileNameIn" name="profileNameIn" style="text-align:center; display:none;" placeholder="Name">

</div>

<div id="nameOutput" class="center">
 <div id="profileNameOut"> 
   <h1>
    <?php

     $post_id = get_the_ID();

      $profileName = get_post_meta($post_id, 'profile_name', true );

        if ($profileName == "") {
       $userID = $current_user->user_login;
       echo $userID;
         
    } else {
      echo $profileName;
    }
    
    ?>
    </h1>
  </div>

</div>


<div id="beltInput" class="center">
<label id="pBeltsLabel" for="profileBelt">Belt Level:</label>
<select id="Belts" name="profileBelt">
  <option value="notSelected">Not Selected</option>
  <option value="white">White</option>
  <option value="blue">Blue</option>
  <option value="purple">Purple</option>
  <option value="brown">Brown</option>
  <option value="black">Black</option>
  <option value="coral">Coral</option>
  <option value="red">Red</option>
</select>
</div>

<div id="whitebeltIconCon" class="beltIcons center">
<div id="notchCon" >
<div id="whiteBeltNotchBot" class="whitebelt"> </div>
<div id="whiteBeltNotchTop" class="whitebelt"> </div>
<!-- <div id="whiteBeltNotchVert"> </div> -->
  </div>
<div id="whiteBeltLeft" class="whitebelt"> </div>
<div id="whiteBeltRight" class="whitebelt"> <div class="beltBand"></div> </div>
<div id="whiteBelt" class="whitebelt"> </div>

  </div>

  <div id="bluebeltIconCon" class="beltIcons center">
<div id="notchCon" >
<div id="whiteBeltNotchBot" class="bluebelt"> </div>
<div id="whiteBeltNotchTop" class="bluebelt"> </div>
<!-- <div id="whiteBeltNotchVert"> </div> -->
  </div>
<div id="whiteBeltLeft" class="bluebelt"> </div>
<div id="whiteBeltRight" class="bluebelt"> <div class="beltBand"></div> </div>
<div id="whiteBelt" class="bluebelt"> </div>

  </div>

  <div id="purplebeltIconCon" class="beltIcons center">
<div id="notchCon" >
<div id="whiteBeltNotchBot" class="purplebelt"> </div>
<div id="whiteBeltNotchTop" class="purplebelt"> </div>
<!-- <div id="whiteBeltNotchVert"> </div> -->
  </div>
<div id="whiteBeltLeft" class="purplebelt"> </div>
<div id="whiteBeltRight" class="purplebelt"> <div class="beltBand"></div> </div>
<div id="whiteBelt" class="purplebelt"> </div>

  </div>

  <div id="brownbeltIconCon" class="beltIcons center">
<div id="notchCon" >
<div id="whiteBeltNotchBot" class="brownbelt"> </div>
<div id="whiteBeltNotchTop" class="brownbelt"> </div>
<!-- <div id="whiteBeltNotchVert"> </div> -->
  </div>
<div id="whiteBeltLeft" class="brownbelt"> </div>
<div id="whiteBeltRight" class="brownbelt"> <div class="beltBand"></div> </div>
<div id="whiteBelt" class="brownbelt"> </div>

  </div>

  <div id="blackbeltIconCon" class="beltIcons center">
<div id="notchCon" >
<div id="whiteBeltNotchBot" class="blackbelt"> </div>
<div id="whiteBeltNotchTop" class="blackbelt"> </div>
<!-- <div id="whiteBeltNotchVert"> </div> -->
  </div>
<div id="whiteBeltLeft" class="blackbelt"> </div>
<div id="whiteBeltRight" class="blackbelt"> <div id= "blackBand" class="beltBand"></div> </div>
<div id="whiteBelt" class="blackbelt"> </div>

  </div>
<div id="GymInput" class="center">
    <input type="text" style="text-align:center;" placeholder="Main Gym">
</input>
</div>

<div id="beltInput" class="center">
<label id="pBeltsLabel" for="cars">Position:</label>
<select id="Belts" name="cars">
  <option value="volvo"><div id="WBCon"><div id="stCon"></div>Student</div></option>
  <option value="saab">No-gi instructor</option>
  <option value="fiat">Gi instructor</option>
  <option value="audi">Head instructor</option>
</select>
</div>
   <button id="saveProfileDetails" class="plusPic" type="submit">Save</button>
  </form>
      <button id="cancelProfileDetails" class="plusPic" >Cancel</button>


<script>

    // var slideContain = 

    // function showslide() {
    // slideContain.style.display = "block";
    // displayImg.style.display ="none";
    // }

    editDetailsButton = document.getElementById('editDetailsButton');
    profileNameIn =  document.getElementById('profileNameIn'); 
    profileNameOut =  document.getElementById('profileNameOut'); 
    saveDetails = document.getElementById('saveProfileDetails'); 
    cancelDetails = document.getElementById('cancelProfileDetails'); 
    beltSelect = document.getElementById('Belts'); 
    beltLabel = document.getElementById('pBeltsLabel'); 


    editDetailsButton.addEventListener('click', function() {
        profileNameIn.style.display = "block";
        profileNameOut.style.display = "none";
        saveDetails.style.display = "block";
        cancelDetails.style.display = "block";
        beltSelect.style.display = "block";
        beltLabel.style.display = "block";
           cancelDetails.addEventListener("click", function () {
          window.location.reload();
});
    });

    
  function fasterPreview( uploader, image, cancelID, saveID, upID ) {
    if ( uploader.files && uploader.files[0] ){
          $(image).attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );


    }

     var save = document.getElementById(saveID);
        var cancel = document.getElementById(cancelID);
        var upload = document.getElementById(upID);

        save.style.display = "block";
        cancel.style.display = "block";
        upload.style.display = "none";

          cancel.addEventListener("click", function () {
          window.location.reload();
});
  }

//      var cancelPP = document.getElementById('cancelProfilePic');

//  cancelPP.addEventListener("click", function () {
//           window.location.reload();
// });




   

</script>

</body>

<div>

<?php

get_footer();

?>

</div>
