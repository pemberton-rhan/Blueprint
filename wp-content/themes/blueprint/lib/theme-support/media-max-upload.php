<?php

// Update media library max upload directions
function max_upload_directions() {
  echo '
  <script type="text/javascript">
    var hasModifiedUploadSizeText = false;
    jQuery(document).on("DOMNodeInserted", function() {
      if (!hasModifiedUploadSizeText && jQuery(".max-upload-size").length > 0) {
        jQuery(".max-upload-size").html("Uploads are limited to 3 MB Images / 10 MB Videos");
        hasModifiedUploadSizeText = true;
      }
    });
  </script>';
}
add_action( 'admin_footer', 'max_upload_directions' );

// This function forces a limit to the size of media library uploads
function custom_upload_size_limit($file) {
  $size = $file['size'];
  $type = $file['type'];
  $is_image = strpos($type, 'image') !== false;
  $is_video = strpos($type, 'video') !== false;
  $limit = 3 * 1024 * 1024; // 3MB

  if ($is_video) {
    $limit = 10 * 1024 * 1024; // 10MB
  }

  // Bypass the file size check if the current upload action is for a plugin
  if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'upload-plugin') {
    return $file;
  }

  if ($size > $limit) {
    $file["error"] = "File size must be less than " . ($limit / (1024 * 1024)) . "MB for " . ($is_image ? "images" : "videos");
  }

  return $file;
}

add_filter('wp_handle_upload_prefilter', 'custom_upload_size_limit', 10, 1);