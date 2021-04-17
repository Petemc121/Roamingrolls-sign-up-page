function fasterPreview(uploader, image) {
  if (uploader.files && uploader.files[0]) {
    $(image).attr("src", window.URL.createObjectURL(uploader.files[0]));
  }

  var save = document.getElementById("savePics");
  var cancel = document.getElementById("cancelPics");
  var upload = document.getElementById("coverPhotoUp");

  save.style.display = "block";
  cancel.style.display = "block";
  upload.style.display = "none";
}
