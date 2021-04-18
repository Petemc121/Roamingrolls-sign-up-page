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

<div id="nameInput" class="center">
    <input type="text" style="text-align:center;" placeholder="Name">
</input>
</div>

<div id="beltInput" class="center">
<label id="pBeltsLabel" for="cars">Belt Level:</label>
<select id="Belts" name="cars">
  <option value="volvo"><div id="WBCon"><div id="stCon"></div>White</div></option>
  <option value="saab">Blue</option>
  <option value="fiat">Brown</option>
  <option value="audi">Black</option>
  <option value="audi">Coral</option>
  <option value="audi">Red</option>
</select>
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




<script>

    // var slideContain = 

    // function showslide() {
    // slideContain.style.display = "block";
    // displayImg.style.display ="none";
    // }

    
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
