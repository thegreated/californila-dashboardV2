<?php

wp_logout();
$page = get_page_by_title('login');
wp_redirect(get_permalink($page->ID));