var $ = jQuery.noConflict();

var crop_max_width = 400;
var crop_max_height = 400;
var jcrop_api;
var canvas;
var context;
var image;
var prefsize;

/* Upload floor planner image */
jQuery(document).on("change", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image input#local-upload", function(e) {

  // jQuery("#bfpc_floor_planner_main .bfpc_first_popup_row").hide();
  // jQuery("#bfpc_floor_planner_main .bfpc_second_popup_row").show();

  var imageCropView = $(".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #views");
  var imageCropViewWidth = imageCropView.naturalWidth || imageCropView.outerWidth();
  var imageCropViewHeight = imageCropView.naturalHeight || imageCropView.outerHeight();

  if ( crop_max_width < imageCropViewWidth ) {
    crop_max_width = imageCropViewWidth;
  }
  if ( crop_max_height < imageCropViewHeight ) {
    crop_max_height = imageCropViewHeight;
  }

  loadImage(this);

});

/* Load image from uploaded input */
function loadImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    canvas = null;
    reader.onload = function(e) {
      image = new Image();
      image.onload = validateImage;
      image.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}

/* Conver Canvas cropped image URL to PHP uploaded image data */
function dataURLtoBlob(dataURL) {
  var BASE64_MARKER = ';base64,';
  if (dataURL.indexOf(BASE64_MARKER) == -1) {
    var parts = dataURL.split(',');
    var contentType = parts[0].split(':')[1];
    var raw = decodeURIComponent(parts[1]);

    return new Blob([raw], {
      type: contentType
    });
  }
  var parts = dataURL.split(BASE64_MARKER);
  var contentType = parts[0].split(':')[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);
  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], {
    type: contentType
  });
}

/* Create Image on Canvas */
function validateImage() {
  if (canvas != null) {
    image = new Image();
    image.onload = restartJcrop;
    image.src = canvas.toDataURL('image/png');
  } else restartJcrop();
}

/* When cropped image then remove old image canvas and create new */
function restartJcrop() {
  if (jcrop_api != null) {
    jcrop_api.destroy();
  }
  $(".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #views").empty();
  $(".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #views").append("<canvas id=\"canvas\">");
  canvas = $("#canvas")[0];

console.log("image width="+image.width+" | image height="+image.height);

  context = canvas.getContext("2d");
  canvas.width = image.width;
  canvas.height = image.height;
  context.drawImage(image, 0, 0);
  /*Before canvas Jcrop */
  $("#canvas").Jcrop({
    onSelect: selectcanvas,
    onRelease: clearcanvas,
    boxWidth: crop_max_width,
    boxHeight: crop_max_height
  }, function() {
    jcrop_api = this;
  });
  clearcanvas();
}

/* Clear the canvas data */
function clearcanvas() {
  prefsize = {
    x: 0,
    y: 0,
    w: canvas.width,
    h: canvas.height,
  };
}

/* Select the canvas */
function selectcanvas(coords) {
  prefsize = {
    x: Math.round(coords.x),
    y: Math.round(coords.y),
    w: Math.round(coords.w),
    h: Math.round(coords.h)
  };
}

/* Crop the selected scale */
function applyCrop() {
  canvas.width = prefsize.w;
  canvas.height = prefsize.h;
  context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
  validateImage();
}

/* Apply scale */
function applyScale(scale) {
  if (scale == 1) return;
  canvas.width = canvas.width * scale;
  canvas.height = canvas.height * scale;
  context.drawImage(image, 0, 0, canvas.width, canvas.height);
  validateImage();
}

/* Apply the rotation for cropped image */
function applyRotate() {
  canvas.width = image.height;
  canvas.height = image.width;
  context.clearRect(0, 0, canvas.width, canvas.height);
  context.translate(image.height / 2, image.width / 2);
  context.rotate(Math.PI / 2);
  context.drawImage(image, -image.width / 2, -image.height / 2);
  validateImage();
}

/* Apply the Horizontal Flip */
function applyHflip() {
  context.clearRect(0, 0, canvas.width, canvas.height);
  context.translate(image.width, 0);
  context.scale(-1, 1);
  context.drawImage(image, 0, 0);
  validateImage();
}

/* Apply the Vertical Flip */
function applyVflip() {
  context.clearRect(0, 0, canvas.width, canvas.height);
  context.translate(0, image.height);
  context.scale(1, -1);
  context.drawImage(image, 0, 0);
  validateImage();
}

/* Define the action button to call function */
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #cropbutton", function(e) {
  applyCrop();
});
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #scalebutton", function(e) {
  var scale = prompt("Scale Factor:", "1");
  applyScale(scale);
});
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #rotatebutton", function(e) {
  applyRotate();
});
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #hflipbutton", function(e) {
  applyHflip();
});
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #vflipbutton", function(e) {
  applyVflip();
});

/* Want upload image again */
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #UploadAgainButton", function(e) {
  event.preventDefault();
  if ( jQuery(".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image input#local-upload").val().length ) {
    if (confirm(" Are you sure to Restart with new image?") == true) {
      jQuery(".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image input#local-upload").val('').trigger( "click" );
    }
  } else {
      jQuery(".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image input#local-upload").val('').trigger( "click" );
  }
  return false;
});

/* when click on the finish Crop */
jQuery(document).on("click", ".bfpc_second_popup_row .bfpc-component-body .bfpc-crop-image #finishCropButton", function() {
  event.preventDefault();

    jQuery('#bfpc_floor_planner_main').addClass( 'bfpc_ajax_loader' );
    var NewImageURL = canvas.toDataURL('image/png');
    var NewImageData = dataURLtoBlob(NewImageURL);

    setTimeout(function(){
      var link_element = document.createElement('a');
      link_element.setAttribute('href', NewImageURL );
      link_element.setAttribute('download', 'New-Image.png');
      link_element.style.display = 'none';
      document.body.appendChild(link_element);
      link_element.click();
      document.body.removeChild(link_element);

      jQuery( '#bfpc_floor_planner_main').removeClass( 'bfpc_ajax_loader' );
    }, 1000);

  return false;
});
