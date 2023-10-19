<?php

// Turn off plugin autoupdates. Allows for more precise admin of plugins and easier troubleshooting.
add_filter( 'auto_update_plugin', '__return_false' );