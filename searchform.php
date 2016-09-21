<?php
/*
 * Use bootstrap style form
 * 
 * Used by get_search_form() in general-template.php
 * 
 * Theme templates content-none.php and 404.php call get_search_form()
 */

$abs = 
'<form role="search" method="get" class="search-form form-inline" action="' . esc_url(home_url('/')) . '">
    <div class="form-group">
        <label>
            <span class="screen-reader-text">' . _x('Search for:', 'label') . '</span>
            <input type="search" class="search-field form-control" placeholder="' . esc_attr_x('Search &hellip;', 'placeholder') . '" value="' . get_search_query() . '" name="s" />
        </label>
    </div>
    <input type="submit" class="search-submit btn btn-default" value="' . esc_attr_x('Search', 'submit button') . '" />
</form>';

echo $abs;