<?php
/**
*
*
*/
?>

<!-- Floor Plan Image uploader start -->

<div class="bfpc_second_popup_row">

	<div class="bfpc-component-body">
		<div class="bfpc-crop-image">

			<button id="UploadAgainButton" type="button" title="<?php echo __('Reupload', BFPC_Text_Domain); ?>"><i class="fa fa-upload" aria-hidden="true"></i></button>
			<button id="rotatebutton" type="button" title="<?php echo __('Rotate', BFPC_Text_Domain); ?>"><span class="dashicons dashicons-image-rotate-right"></span></button>
			<button id="hflipbutton" type="button" title="<?php echo __('H-flip', BFPC_Text_Domain); ?>"><span class="dashicons dashicons-image-flip-horizontal"></span></button>
			<button id="vflipbutton" type="button" title="<?php echo __('V-flip', BFPC_Text_Domain); ?>"><span class="dashicons dashicons-image-flip-vertical"></span></button>
			<button id="cropbutton" type="button" title="<?php echo __('Crop', BFPC_Text_Domain); ?>"><span class="dashicons dashicons-image-crop"></span></button>
			<button id="finishCropButton" type="button" title="<?php echo __('Finish Cropping', BFPC_Text_Domain); ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
			<div id="views"></div>
			<input accept="image/gif,image/jpg,image/jpeg,image/bmp,image/png" type="file" id="local-upload" style="display: none !important;">

		</div>
	</div>

</div>
<!-- Floor Plan Image uploader End -->
