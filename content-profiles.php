
<body>
<div class="mySlideD">

    <img onclick="showslide()" id="displayImg" src="https://www.roamingrolls.com/wp-content/uploads/2020/08/Untitled-design-20.png">
    <input id="DisUpload" onchange="fasterPreview(this, '#displayImg')" type="file" 
    name="profile_photo" placeholder="Photo" required="" capture style="display:none;">

    
  </div>

  <button onclick="$('#DisUpload').click()" id ="DPup"><i class="fas fa-file-upload"></i>
    </button>

<div id="profile-pic">

    <img id = "ProfileImg" src="https://www.roamingrolls.com/wp-content/uploads/2020/11/avatar.gif">

  

    <input id="imageUpload1" onchange="fasterPreview(this, '#ProfileImg')" type="file" 
    name="profile_photo" placeholder="Photo" required="" capture>

      <button onclick="$('#imageUpload1').click()" id ="PPup"><i class="fas fa-file-upload"></i>
    </button>

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

    var slideContain = 

    function showslide() {
    slideContain.style.display = "block";
    displayImg.style.display ="none";
    }

    
  function fasterPreview( uploader, image ) {
    if ( uploader.files && uploader.files[0] ){
          $(image).attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );
    }
  }



   

</script>

</body>

<div>

<?php

get_footer();

?>

</div>
