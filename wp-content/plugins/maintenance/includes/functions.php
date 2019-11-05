<?php
global $standart_fonts;
$standart_fonts = array(
  'Arial, Helvetica, sans-serif'                     => 'Arial, Helvetica, sans-serif',
  'Arial Black, Gadget, sans-serif'                  => 'Arial Black, Gadget, sans-serif',
  'Bookman Old Style, serif'                         => 'Bookman Old Style, serif',
  'Comic Sans MS, cursive'                           => 'Comic Sans MS, cursive',
  'Courier, monospace'                               => 'Courier, monospace',
  'Garamond, serif'                                  => 'Garamond, serif',
  'Georgia, serif'                                   => 'Georgia, serif',
  'Impact, Charcoal, sans-serif'                     => 'Impact, Charcoal, sans-serif',
  'Lucida Console, Monaco, monospace'                => 'Lucida Console, Monaco, monospace',
  'Lucida Sans Unicode, Lucida Grande, sans-serif'   => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
  'MS Sans Serif, Geneva, sans-serif'                => 'MS Sans Serif, Geneva, sans-serif',
  'MS Serif, New York, sans-serif'                   => 'MS Serif, New York, sans-serif',
  'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
  'Tahoma,Geneva, sans-serif'                        => 'Tahoma, Geneva, sans-serif',
  'Times New Roman, Times,serif'                     => 'Times New Roman, Times, serif',
  'Trebuchet MS, Helvetica, sans-serif'              => 'Trebuchet MS, Helvetica, sans-serif',
  'Verdana, Geneva, sans-serif'                      => 'Verdana, Geneva, sans-serif',
);

function mtnc_get_plugin_options($is_current = false)
{
  $saved = (array) get_option('maintenance_options', array());

  if (!$saved) {
    $saved = mtnc_get_default_array();
  }

  if (!$is_current) {
    $options = wp_parse_args(get_option('maintenance_options', array()), mtnc_get_default_array());
  } else {
    $options = $saved;
  }
  return $options;
}

function mtnc_generate_input_filed($title, $id, $name, $value, $placeholder = '')
{
  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row"><label for="' . esc_attr($id) . '">' . esc_attr($title) . '</label></th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  $out_filed .= '<input type="text" id="' . esc_attr($id) . '" name="lib_options[' . $name . ']" value="' . esc_attr(stripslashes($value)) . '" placeholder="' . esc_attr($placeholder) . '"/>';
  $out_filed .= '</fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_generate_number_filed($title, $id, $name, $value, $placeholder = '')
{
  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row"><label for="' . esc_attr($id) . '">' . esc_attr($title) . '</label></th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  $out_filed .= '<input type="number" class="small-text" min="0" step="1" pattern="[0-9]{10}" id="' . esc_attr($id) . '" name="lib_options[' . $name . ']" value="' . esc_attr(stripslashes($value)) . '" placeholder="' . esc_attr($placeholder) . '"/>';
  $out_filed .= '</fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_generate_textarea_filed($title, $id, $name, $value)
{
  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row"><label for="' . esc_attr($id) . '">' . esc_attr($title) . '</label></th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  $out_filed .= '<textarea name="lib_options[' . $name . ']" id="' . esc_attr($id) . '" cols="30" rows="10">' . esc_textarea($value) . '</textarea>';
  $out_filed .= '</fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}


function mtnc_generate_tinymce_filed($title, $id, $name, $value)
{
  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row">' . esc_attr($title) . '</th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  ob_start();
  wp_editor(
    $value,
    $id,
    array(
      'textarea_name' => 'lib_options[' . $name . ']',
      'teeny'         => 1,
      'textarea_rows' => 5,
      'media_buttons' => 0,
    )
  );
  $out_filed .= ob_get_contents();
  ob_clean();
  $out_filed .= '</fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}


function mtnc_generate_check_filed($title, $label, $id, $name, $value)
{
  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row">' . esc_attr($title) . '</th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  $out_filed .= '<label for=' . esc_attr($id) . '>';
  $out_filed .= '<input type="checkbox"  id="' . esc_attr($id) . '" name="lib_options[' . $name . ']" value="1" ' . checked(true, $value, false) . '/>';
  $out_filed .= $label;
  $out_filed .= '</label>';
  $out_filed .= '</fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_generate_image_filed($title, $id, $name, $value, $class, $name_btn, $class_btn)
{
  $out_filed = '';

  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row">' . esc_attr($title) . '</th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  $out_filed .= '<input type="hidden" id="' . esc_attr($id) . '" name="lib_options[' . $name . ']" value="' . esc_attr($value) . '" />';
  $out_filed .= '<div class="img-container">';
  $url        = '';
  if ($value !== '') {
    $image = wp_get_attachment_image_src($value, 'full');
    $url   = esc_url($image[0]);
  }

  $out_filed .= '<div class="' . esc_attr($class) . '" style="background-image:url(' . $url . ')">';
  if ($value) {
    $out_filed .= '<input class="button button-primary delete-img remove" type="button" value="x" />';
  }
  $out_filed .= '</div>';
  $out_filed .= '<input type="button" class="' . esc_attr($class_btn) . '" value="' . esc_attr($name_btn) . '"/>';

  $out_filed .= '</div>';
  $out_filed .= '</fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_get_color_field($title, $id, $name, $value, $default_color)
{
  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row"><label for="' . esc_attr($id) . '">' . esc_attr($title) . '</label></th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  $out_filed .= '<input type="text" id="' . esc_attr($id) . '" name="lib_options[' . $name . ']" data-default-color="' . esc_attr($default_color) . '" value="' . wp_kses_post(stripslashes($value)) . '" />';
  $out_filed .= '<fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_get_google_font($font = null)
{
  $font_params = $full_link = $gg_fonts = '';

  $gg_fonts = json_decode(mtnc_get_google_fonts());

  if (property_exists($gg_fonts, $font)) {
    $curr_font = $gg_fonts->{$font};
    if (!empty($curr_font)) {
      foreach ($curr_font->variants as $values) {
        if (!empty($values->id)) {
          $font_params .= $values->id . ',';
        } elseif (!empty($values)) {
          $font_params .= $values . ',';
        }
      }

      $font_params = trim($font_params, ',');
      $full_link   = $font . ':' . $font_params;
    }
  }

  return $full_link;
}

/*
 * Function get_fonts_field is backward compatibility with Maintenance PRO Version 3.6.2 and below */
function get_fonts_field($title, $id, $name, $value)
{
  return mtnc_get_fonts_field($title, $id, $name, $value);
}

function mtnc_get_fonts_field($title, $id, $name, $value)
{
  global $standart_fonts;
  $out_items = $gg_fonts = '';

  $gg_fonts = json_decode(mtnc_get_google_fonts());

  $out_filed  = '';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th scope="row">' . esc_attr($title) . '</th>';
  $out_filed .= '<td>';
  $out_filed .= '<fieldset>';
  if (!empty($standart_fonts)) {
    $out_items .= '<optgroup label="' . __('Standard Fonts', 'maintenance') . '">';
    foreach ($standart_fonts as $key => $options) {
      $out_items .= '<option value="' . $key . '" ' . selected($value, $key, false) . '>' . $options . '</option>';
    }
  }

  if (!empty($gg_fonts)) {
    $out_items .= '<optgroup label="' . __('Google Web Fonts', 'maintenance') . '">';
    foreach ($gg_fonts as $key => $options) {
      $out_items .= '<option value="' . $key . '" ' . selected($value, $key, false) . '>' . $key . '</option>';
    }
  }

  if (!empty($out_items)) {
    $out_filed .= '<select class="select2_customize" name="lib_options[' . $name . ']" id="' . esc_attr($id) . '">';
    $out_filed .= $out_items;
    $out_filed .= '</select>';
  }
  $out_filed .= '<fieldset>';
  $out_filed .= '</td>';
  $out_filed .= '</tr>';
  return $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_get_fonts_subsets($title, $id, $name, $value)
{
  global $standart_fonts;
  $out_items = $gg_fonts = $curr_font = $mt_option = '';
  $mt_option = mtnc_get_plugin_options(true);
  $curr_font = esc_attr($mt_option['body_font_family']);
  $vars      = 'subsets';

  $gg_fonts = json_decode(mtnc_get_google_fonts(), true);

  if (!empty($gg_fonts)) {

    $out_filed  = '';
    $out_filed .= '<tr valign="top">';
    $out_filed .= '<th scope="row">' . esc_attr($title) . '</th>';
    $out_filed .= '<td>';
    $out_filed .= '<fieldset>';
    $out_filed .= '<select class="select2_customize" name="lib_options[' . $name . ']" id="' . esc_attr($id) . '">';
    if (!empty($gg_fonts[$curr_font])) {
      foreach ($gg_fonts[$curr_font]['variants'] as $key => $v) {
        $out_filed .= '<option value="' . $v . '" ' . selected($value, $v, false) . '>' . $v . '</option>';
      }
    }
    $out_filed .= '</select>';

    $out_filed .= '<fieldset>';
    $out_filed .= '</td>';
    $out_filed .= '</tr>';
  }
  return $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_page_create_meta_boxes()
{
  global $mtnc_variable;
  $mt_option = mtnc_get_plugin_options(true);

  if (!$mt_option['default_settings'] || $mt_option['gg_analytics_id']) {
    add_meta_box('review-top', __('Please help us keep the plugin free &amp; maintained', 'maintenance'), 'mtnc_add_review_top', $mtnc_variable->options_page, 'normal', 'high');
  }
  add_meta_box('mtnc-general', __('General Settings', 'maintenance'), 'mtnc_add_data_fields', $mtnc_variable->options_page, 'normal', 'default');
  add_meta_box('mtnc-themes', __('Ready To Use Themes', 'maintenance'), 'mtnc_add_themes_fields', $mtnc_variable->options_page, 'normal', 'default');
  add_meta_box('mtnc-css', __('Custom CSS', 'maintenance'), 'mtnc_add_css_fields', $mtnc_variable->options_page, 'normal', 'default');
  add_meta_box('mtnc-excludepages', __('Exclude pages from maintenance mode', 'maintenance'), 'mtnc_add_exclude_pages_fields', $mtnc_variable->options_page, 'normal', 'default');
}
add_action('add_mt_meta_boxes', 'mtnc_page_create_meta_boxes', 10);

function mtnc_page_create_meta_boxes_widget_pro()
{
  global $mtnc_variable;

}
add_action('add_mt_meta_boxes', 'mtnc_page_create_meta_boxes_widget_pro', 15);

function mtnc_add_review_top() {
  $promo_text  = '';
  $promo_text .= '<p><b>Your review means a lot!</b> Please help us spread the word so that others know the Maintenance plugin is free and well maintained!<br>
  Thank you very much for using our plugin and helping us out!</p>';
  $promo_text .= '<p><br><a href="https://wordpress.org/support/plugin/maintenance/reviews/#new-post" target="_blank" class="button button-primary">Leave a Review</a> &nbsp;&nbsp; <a href="#" class="hide-review-box">I already left a review ;)</a></p>';
  echo $promo_text;
}

function mtnc_page_create_meta_boxes_widget_support()
{
  global $mtnc_variable;
  add_meta_box('promo-content', __('Something is not working? Do you need our help?', 'maintenance'), 'mtnc_contact_support', $mtnc_variable->options_page, 'side', 'default');
  add_meta_box('promo-extended', __('Translate Maintanance page to 100+ languages', 'maintenance'), 'mtnc_extended_version', $mtnc_variable->options_page, 'side', 'default');
  add_meta_box('promo-review', __('Help us keep the plugin free &amp; maintained', 'maintenance'), 'mtnc_review_box', $mtnc_variable->options_page, 'side', 'default');
}
add_action('add_mt_meta_boxes', 'mtnc_page_create_meta_boxes_widget_support', 13);

function mtnc_add_data_fields($object, $box)
{
  $mt_option = mtnc_get_plugin_options(true);
  $is_blur   = false;

  /*Deafult Variable*/
  $page_title = $heading = $description = $logo_width = $logo_height = '';

  $allowed_tags = wp_kses_allowed_html('post');
  if (isset($mt_option['page_title'])) {
    $page_title = wp_kses(stripslashes($mt_option['page_title']), $allowed_tags);
  }
  if (isset($mt_option['heading'])) {
    $heading = wp_kses_post($mt_option['heading']);
  }
  if (isset($mt_option['description'])) {
    $description = wp_kses(stripslashes($mt_option['description']), $allowed_tags);
  }
  if (isset($mt_option['footer_text'])) {
    $footer_text = wp_kses_post($mt_option['footer_text']);
  }
  if (isset($mt_option['logo_width'])) {
    $logo_width = wp_kses_post($mt_option['logo_width']);
  }
  if (isset($mt_option['logo_height'])) {
    $logo_height = wp_kses_post($mt_option['logo_height']);
  }
  ?>
  <table class="form-table">
    <tbody>
      <?php
        mtnc_generate_input_filed(__('Page title', 'maintenance'), 'page_title', 'page_title', $page_title);
        mtnc_generate_input_filed(__('Headline', 'maintenance'), 'heading', 'heading', $heading);
        mtnc_generate_tinymce_filed(__('Description', 'maintenance'), 'description', 'description', $description);
        mtnc_generate_input_filed(__('Footer Text', 'maintenance'), 'footer_text', 'footer_text', $footer_text);
        mtnc_weglot_option();
        mtnc_generate_check_filed(__('Show Some Love', 'maintenance'), __('Show a small link in the footer to let others know you\'re using this awesome &amp; free plugin', 'maintenance'), 'show_some_love', 'show_some_love', !empty($mt_option['show_some_love']));
        mtnc_generate_number_filed(__('Set Logo width', 'maintenance'), 'logo_width', 'logo_width', $logo_width);
        mtnc_generate_number_filed(__('Set Logo height', 'maintenance'), 'logo_height', 'logo_height', $logo_height);
        mtnc_generate_image_filed(__('Logo', 'maintenance'), 'logo', 'logo', (int) $mt_option['logo'], 'boxes box-logo', __('Upload Logo', 'maintenance'), 'upload_logo upload_btn button');
        mtnc_generate_image_filed(__('Retina logo', 'maintenance'), 'retina_logo', 'retina_logo', (int) $mt_option['retina_logo'], 'boxes box-logo', __('Upload Retina Logo', 'maintenance'), 'upload_logo upload_btn button');
        do_action('mtnc_background_field');
        mtnc_generate_image_filed(__('Background image (portrait mode)', 'maintenance'), 'bg_image_portrait', 'bg_image_portrait', isset($mt_option['bg_image_portrait']) ? (int) $mt_option['bg_image_portrait'] : '', 'boxes box-logo', __('Upload image for portrait device orientation', 'maintenance'), 'upload_logo upload_btn button');
        mtnc_generate_image_filed(__('Page preloader image', 'maintenance'), 'preloader_img', 'preloader_img', isset($mt_option['preloader_img']) ? (int) $mt_option['preloader_img'] : '', 'boxes box-logo', __('Upload preloader', 'maintenance'), 'upload_logo upload_btn button');

        do_action('mtnc_color_fields');
        do_action('mtnc_font_fields');
        mtnc_mailoptin_option();
        mtnc_generate_check_filed(__('503 Response Code', 'maintenance'), __('Service temporarily unavailable, Google analytics will be disabled.', 'maintenance'), '503_enabled', '503_enabled', !empty($mt_option['503_enabled']));

        $gg_analytics_id = '';
        if (!empty($mt_option['gg_analytics_id'])) {
          $gg_analytics_id = esc_js($mt_option['gg_analytics_id']);
        }

        mtnc_generate_input_filed(__('Google Analytics ID', 'maintenance'), 'gg_analytics_id', 'gg_analytics_id', $gg_analytics_id, __('UA-XXXXX-X', 'maintenance'));

        if (isset($mt_option['is_blur'])) {
          if ($mt_option['is_blur']) {
            $is_blur = true;
          }
        }

        mtnc_generate_check_filed(__('Apply background blur', 'maintenance'), '', 'is_blur', 'is_blur', $is_blur);
        mtnc_generate_number_filed(__('Set blur intensity', 'maintenance'), 'blur_intensity', 'blur_intensity', (int) $mt_option['blur_intensity']);

        mtnc_generate_check_filed(__('Enable frontend login', 'maintenance'), '', 'is_login', 'is_login', isset($mt_option['is_login']));

        echo '<tr><td colspan="2"><p><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p></td></tr>'
        ?>
    </tbody>
  </table>
<?php
}

// check if MailOptin plugin is active and min version installed
function mtnc_is_mailoptin_active() {
  if (!function_exists('is_plugin_active') || !function_exists('get_plugin_data')) {
   require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }

  if (is_plugin_active('mailoptin/mailoptin.php')) {
    $mailoptin_info = get_plugin_data(ABSPATH . 'wp-content/plugins/mailoptin/mailoptin.php');
    if( version_compare($mailoptin_info['Version'], '1.2.10.1', '<')) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
} // is_mailoptin_active

function mtnc_mailoptin_option() {
  $mt_option = mtnc_get_plugin_options(true);

  if (mtnc_is_mailoptin_active()) {
    global $wpdb;

    $mailoptin_campaigns = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'mo_optin_campaigns');
    $campaigns = array();

    if (!empty($mailoptin_campaigns)) {
      $campaigns[] = array('val' => -1, 'label' => 'Disable optins');
      foreach ($mailoptin_campaigns as $mailoptin_campaign) {
        if ($mailoptin_campaign->optin_type == 'lightbox') {
          $type = 'lightbox optin';
        } else {
          $type = 'content box optin';
        }
        $campaigns[] = array('val' => $mailoptin_campaign->id, 'label' => $mailoptin_campaign->name . ' - ' . $type);
      } // foreach
    } // if campaigns

    echo '<tr id="mailoptin-settings">';
    echo '<th><label for="mailoptin_campaign">Optin Boxes &amp; Popups</label></th>';
    echo '<td>';
    if ($campaigns) {
      echo '<select name="lib_options[mailoptin_campaign]" id="mailoptin_campaign">';
      echo mtnc_create_select_options($campaigns, $mt_option['mailoptin_campaign']);
      echo '</select>';
    } else {
      echo '<p><a href="' . admin_url('admin.php?page=mailoptin-optin-campaigns') . '">Create your first optin</a> to start collecting leads and subscribers</p>';
    }
    echo '<p class="description">Create, edit and manage optins on the <a href="' . admin_url('admin.php?page=mailoptin-optin-campaigns') . '">MailOptin campaigns page</a>. Lightbox optins are more prominent but some users find them annoying. Content box optins tend to generate leads of higher quality.</p>';
    echo '</td>';
    echo '</tr>';
  } else {
    echo '<tr>';
    echo '<th><label for="">Optin Boxes &amp; Popups</label></th>';
    echo '<td>';
    echo '<input type="checkbox" id="mailoptin_support" type="checkbox" value="1" class="skip-save open-mailoptin-upsell">';
    echo '<p class="description">Collecting leads and subscribers is one of the most important aspect of any business. ';
    echo 'To add optin boxes &amp; optin popups compatible with Mailchimp and many other autoresponders <a href="#" class="open-mailoptin-upsell">install the free MailOptin plugin</a>. It seamlessly integrates with Maintenance, offers numerous options and will enable you to collect leads without any additional costs.</p>';
    echo '</td>';
    echo '</tr>';
  } // mailoptin not active
}

// helper function for creating dropdowns
function mtnc_create_select_options($options, $selected = null, $output = true) {
  $out = "\n";

  if(!is_array($selected)) {
    $selected = array($selected);
  }

  foreach ($options as $tmp) {
    $data = '';
    if (isset($tmp['disabled'])) {
      $data .= ' disabled="disabled" ';
    }
    if (in_array($tmp['val'], $selected)) {
      $out .= "<option selected=\"selected\" value=\"{$tmp['val']}\"{$data}>{$tmp['label']}&nbsp;</option>\n";
    } else {
      $out .= "<option value=\"{$tmp['val']}\"{$data}>{$tmp['label']}&nbsp;</option>\n";
    }
  } // foreach

  if ($output) {
    echo $out;
  } else {
    return $out;
  }
} // create_select_options

function mtnc_weglot_option() {
  if (mtnc_is_weglot_active()) {
    echo '<tr id="weglot-settings">';
    echo '<th><label for="weglot_lang">Multilingual Support</label></th>';
    echo '<td>';

    if (mtnc_is_weglot_setup()) {
      $tmp = '';
      $active_languages = weglot_get_destination_language();
      $languages = weglot_get_languages_available();
      $original_language = weglot_get_original_language();

      echo '<p>Your maintenance page is currently available in the following languages.<br>To add more languages and configure translations open <a href="' . admin_url('admin.php?page=weglot-settings') . '">Weglot settings</a>.</p>';
      echo '<ul class="mtnc-list">';
      foreach ($languages as $language) {
        if ($language->getIso639() == $original_language) {
          $tmp = '<li>' . esc_html($language->getEnglishName()) . ' - original language</li>' . $tmp;
        }
        if (in_array($language->getIso639(), $active_languages, true )) {
          $tmp .= '<li>' . esc_html($language->getLocalName()) . '</li>';
        }
      } // foreach language
      echo $tmp;
      echo '</ul>';
    } else {
      echo '<p>Your under construction page is currently not translated.<br>Open <a href="' . admin_url('admin.php?page=weglot-settings') . '">Weglot settings</a> to select languages you want to translate to.</p>';
    }
    echo '</td>';
    echo '</tr>';
    } else {
      echo '<tr>';
      echo '<th><label for="weglot_support">Multilingual Support</label></th>';
      echo '<td>';
      echo '<input type="checkbox" id="weglot_support" type="checkbox" value="1" class="skip-save open-weglot-upsell">';
      echo '<p class="description">55% of online visitors prefer to browse in their mother tongue. If you have an audience speaking multiple languages, making your website multilingual is a must-have. To instantly translate your site and your maintenance page, <a href="#" class="open-weglot-upsell">install the Weglot plugin</a> (free plan &amp; free trial available). It seamlessly integrates with Maintenance plugin and is compatible with all themes &amp; plugins.</p>';
      echo '</td>';
      echo '</tr>';
    } // weglot not active
}

// check if Weglot is completely set up
function mtnc_is_weglot_setup() {
  if (!mtnc_is_weglot_active()) {
    return false;
  }

  $active_languages = weglot_get_destination_language();
  if (!empty($active_languages)) {
    return true;
  } else {
    return false;
  }
} // is_weglot_setup

// check if Weglot plugin is active and min version installed
function mtnc_is_weglot_active() {
  if (!function_exists('is_plugin_active') || !function_exists('get_plugin_data')) {
   require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }

  if (is_plugin_active('weglot/weglot.php')) {
    $weglot_info = get_plugin_data(ABSPATH . 'wp-content/plugins/weglot/weglot.php');
    if( version_compare($weglot_info['Version'], '2.5', '<')) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
} // is_weglot_active

function mtnc_add_css_fields()
{
  $mt_option = mtnc_get_plugin_options(true);
  echo '<table class="form-table">';
  echo '<tbody>';
  mtnc_generate_textarea_filed(__('CSS Code', 'maintenance'), 'custom_css', 'custom_css', wp_kses_stripslashes($mt_option['custom_css']));
  echo '<tr><td colspan="2"><p><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p></td></tr>';
  echo '</tbody>';
  echo '</table>';
}

function mtnc_add_themes_fields()
{
  $themes =
    array(
      0 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Thu, 22 Feb 2018 18:45:00 +0000',
        'name' => 'Aeroplane Company',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'aeroplane-company',
      ),
      1 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 09 Sep 2018 16:06:39 +0000',
        'name' => 'Air Balloon',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'air-balloon',
      ),
      2 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 12:43:04 +0000',
        'name' => 'Animated Clock',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'animated-clock',
      ),
      3 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 29 May 2019 18:26:27 +0000',
        'name' => 'Architecture INC.',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'architecture-inc',
      ),
      4 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 08 Sep 2018 14:42:03 +0000',
        'name' => 'Architecture',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'architecture',
      ),
      5 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 07 Jul 2019 16:22:50 +0000',
        'name' => 'Art Gallery',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'art-gallery',
      ),
      6 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 23 Sep 2018 12:44:52 +0000',
        'name' => 'Auto Service',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'auto-service',
      ),
      7 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 09 Jun 2018 13:26:02 +0000',
        'name' => 'Beach',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'beach',
      ),
      8 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.05',
        'last_edit' => 'Wed, 28 Feb 2018 10:30:46 +0000',
        'name' => 'Bicycle Race',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'agency',
        'name_clean' => 'bicycle-race',
      ),
      9 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 23 Mar 2019 14:44:52 +0000',
        'name' => 'Bike Shop',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'bike-shop',
      ),
      10 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Sat, 24 Feb 2018 11:48:50 +0000',
        'name' => 'Bitcoin Miners',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'bitcoin-miners',
      ),
      11 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:50:26 +0000',
        'name' => 'Blogging',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'blogging',
      ),
      12 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 29 May 2019 18:05:04 +0000',
        'name' => 'Blue Ocean',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'blue-ocean',
      ),
      13 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 03 Jul 2019 12:01:57 +0000',
        'name' => 'Body Transformation',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'body-transformation',
      ),
      14 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Tue, 27 Feb 2018 09:56:05 +0000',
        'name' => 'Book Lovers',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'book-lovers',
      ),
      15 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.001',
        'last_edit' => 'Thu, 15 Feb 2018 16:24:58 +0000',
        'name' => 'Business Company',
        'description' => '',
        'frontpage' => '0',
        'status' => 'agency',
        'name_clean' => 'business-company',
      ),
      16 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 16 Jun 2019 20:05:59 +0000',
        'name' => 'Business Meeting (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'business-meeting-video',
      ),
      17 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:06:41 +0000',
        'name' => 'Business',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'business',
      ),
      18 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 30 Jan 2019 19:31:32 +0000',
        'name' => 'Café',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'cafe',
      ),
      19 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 10 Mar 2019 11:24:47 +0000',
        'name' => 'City Nighttime',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'city-nighttime',
      ),
      20 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 29 Jul 2018 12:52:06 +0000',
        'name' => 'Cityscape',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'cityscape',
      ),
      21 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.14',
        'last_edit' => 'Fri, 23 Mar 2018 16:46:05 +0000',
        'name' => 'Clouds Screensaver (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'clouds-screensaver-video',
      ),
      22 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Thu, 22 Feb 2018 18:45:40 +0000',
        'name' => 'Coffee Shop',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'coffee-shop',
      ),
      23 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 04 May 2018 08:57:40 +0000',
        'name' => 'Cold Lake',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'cold-lake',
      ),
      24 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Mon, 07 Jan 2019 08:25:36 +0000',
        'name' => 'Computer Repair Service',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'computer-repair-service',
      ),
      25 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 27 Feb 2019 20:04:27 +0000',
        'name' => 'Concert',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'concert',
      ),
      26 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 23 Apr 2019 08:43:55 +0000',
        'name' => 'Conference Event',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'conference-event',
      ),
      27 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Nov 2018 10:25:04 +0000',
        'name' => 'Custom Decor',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'custom-decor',
      ),
      28 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 20:41:31 +0000',
        'name' => 'Default',
        'description' => 'Default settings, nothing more.',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'default',
      ),
      29 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:24:59 +0000',
        'name' => 'Dental Clinic',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'dental-clinic',
      ),
      30 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Mon, 26 Nov 2018 18:41:25 +0000',
        'name' => 'Dog Shelter',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'dog-shelter',
      ),
      31 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.001',
        'last_edit' => 'Tue, 20 Feb 2018 09:14:59 +0000',
        'name' => 'Dog Training and Behavior Consulting',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'dog-training-and-behavior-consulting',
      ),
      32 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Mon, 07 Jan 2019 08:27:22 +0000',
        'name' => 'Employment',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'employment',
      ),
      33 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 23 Dec 2018 09:56:23 +0000',
        'name' => 'Essay Writing Service',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'essay-writing-service',
      ),
      34 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 29 Aug 2018 16:00:04 +0000',
        'name' => 'Fall (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'fall-video',
      ),
      35 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 21 Jul 2018 22:37:09 +0000',
        'name' => 'Fashion',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'fashion',
      ),
      36 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 30 Oct 2018 18:11:40 +0000',
        'name' => 'Financial District',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'financial-district',
      ),
      37 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 18 Aug 2019 16:33:36 +0000',
        'name' => 'Fitness E-Shop',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'fitness-e-shop',
      ),
      38 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 12:33:55 +0000',
        'name' => 'Flower Shop',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'flower-shop',
      ),
      39 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 02 May 2018 09:37:48 +0000',
        'name' => 'Food Blog',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'food-blog',
      ),
      40 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Mon, 18 Jun 2018 16:40:10 +0000',
        'name' => 'Football',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'football',
      ),
      41 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 23 Dec 2018 10:16:53 +0000',
        'name' => 'Frozen Nature',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'frozen-nature',
      ),
      42 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Thu, 28 Feb 2019 08:14:36 +0000',
        'name' => 'Future Technology',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'future-technology',
      ),
      43 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 25 Aug 2019 09:03:15 +0000',
        'name' => 'Greenlife',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'greenlife',
      ),
      44 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 23 Oct 2018 17:23:42 +0000',
        'name' => 'Halloween',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'halloween',
      ),
      45 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 30 Jul 2019 14:26:58 +0000',
        'name' => 'Healthy Eating',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'healthy-eating',
      ),
      46 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 28 Jul 2018 15:16:26 +0000',
        'name' => 'Holiday Resort',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'holiday-resort',
      ),
      47 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:26:42 +0000',
        'name' => 'Homemade Chocolate Gifts',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'homemade-chocolate-gifts',
      ),
      48 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 30 Jan 2019 19:33:31 +0000',
        'name' => 'Ice Cream Shop',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'ice-cream-shop',
      ),
      49 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 12:59:44 +0000',
        'name' => 'Interior Design',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'interior-design',
      ),
      50 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.14',
        'last_edit' => 'Fri, 23 Mar 2018 16:42:15 +0000',
        'name' => 'Journey (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'journey-video',
      ),
      51 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Mon, 11 Mar 2019 18:11:04 +0000',
        'name' => 'Ladies Accessories',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'ladies-accessories',
      ),
      52 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:28:28 +0000',
        'name' => 'LEGO Bricks',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'lego-bricks',
      ),
      53 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 29 Aug 2018 16:36:44 +0000',
        'name' => 'Loneliness',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'loneliness',
      ),
      54 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:04:55 +0000',
        'name' => 'Lonely Road',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'lonely-road',
      ),
      55 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:30:37 +0000',
        'name' => 'Luxury Car',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'luxury-car',
      ),
      56 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 18:31:18 +0000',
        'name' => 'Maintenance Mode',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'maintenance-mode',
      ),
      57 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 17:59:30 +0000',
        'name' => 'Makeup Artist Training',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'makeup-artist-training',
      ),
      58 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 23 Sep 2018 13:09:03 +0000',
        'name' => 'Misty Forest (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'misty-forest-video',
      ),
      59 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:08:31 +0000',
        'name' => 'Mobile Designer',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'mobile-designer',
      ),
      60 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 30 Oct 2018 18:10:11 +0000',
        'name' => 'Mobile Meeting',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'mobile-meeting',
      ),
      61 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 18:04:32 +0000',
        'name' => 'Modern Blog',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'modern-blog',
      ),
      62 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 10:14:21 +0000',
        'name' => 'Modern Office',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'agency',
        'name_clean' => 'modern-office',
      ),
      63 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Mon, 26 Nov 2018 18:42:35 +0000',
        'name' => 'Modern Recipes',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'modern-recipes',
      ),
      64 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:48:23 +0000',
        'name' => 'Mountain Slide',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'mountain-slide',
      ),
      65 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.05',
        'last_edit' => 'Thu, 01 Mar 2018 10:49:52 +0000',
        'name' => 'Mountain',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'mountain',
      ),
      66 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:12:56 +0000',
        'name' => 'Movie Trailer (Video)',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'movie-trailer-video',
      ),
      67 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 16 Jun 2019 16:57:44 +0000',
        'name' => 'Music',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'music',
      ),
      68 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 10:17:02 +0000',
        'name' => 'Nature',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'agency',
        'name_clean' => 'nature',
      ),
      69 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.14',
        'last_edit' => 'Fri, 23 Mar 2018 16:37:55 +0000',
        'name' => 'Office Meeting (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'office-meeting-video',
      ),
      70 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 12:35:44 +0000',
        'name' => 'Office Theme',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'office-theme',
      ),
      71 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 18:07:28 +0000',
        'name' => 'Online Learning',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'online-learning',
      ),
      72 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 25 Aug 2019 10:00:21 +0000',
        'name' => 'Organic Cosmetics',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'organic-cosmetics',
      ),
      73 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:10:44 +0000',
        'name' => 'Pancake House',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'pancake-house',
      ),
      74 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:15:19 +0000',
        'name' => 'Parenting',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'parenting',
      ),
      75 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 28 Aug 2018 15:03:08 +0000',
        'name' => 'Passage',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'passage',
      ),
      76 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 23 Oct 2018 18:08:17 +0000',
        'name' => 'Peaceful River',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'peaceful-river',
      ),
      77 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 18 May 2019 12:49:23 +0000',
        'name' => 'Personal Trainer',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'personal-trainer',
      ),
      78 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:35:07 +0000',
        'name' => 'Photography',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'photography',
      ),
      79 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 07 Jul 2019 17:17:37 +0000',
        'name' => 'Podcast',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'podcast',
      ),
      80 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 10 Mar 2019 11:20:31 +0000',
        'name' => 'Romantic Travels',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'romantic-travels',
      ),
      81 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:41:09 +0000',
        'name' => 'Running Blog',
        'description' => '',
        'frontpage' => '0',
        'status' => 'agency',
        'name_clean' => 'running-blog',
      ),
      82 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.14',
        'last_edit' => 'Sat, 24 Mar 2018 10:23:40 +0000',
        'name' => 'Running (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'running-video',
      ),
      83 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Thu, 25 Apr 2019 08:11:16 +0000',
        'name' => 'Scholar University',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'scholar-university',
      ),
      84 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 26 Jun 2019 16:55:04 +0000',
        'name' => 'SEO & Digital Marketing',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'seo-digital-marketing',
      ),
      85 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 11:17:32 +0000',
        'name' => 'Shoes Store',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'shoes-store',
      ),
      86 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:17:21 +0000',
        'name' => 'Simple Beige Design',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'simple-beige-design',
      ),
      87 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 15 Sep 2019 17:58:36 +0000',
        'name' => 'Skincare',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'skincare',
      ),
      88 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:19:34 +0000',
        'name' => 'Snow Screensaver (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'snow-screensaver-video',
      ),
      89 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 11:44:39 +0000',
        'name' => 'Snowboarding Blog',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'snowboarding-blog',
      ),
      90 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:21:19 +0000',
        'name' => 'Snowy Mountain',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'snowy-mountain',
      ),
      91 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Nov 2018 10:24:22 +0000',
        'name' => 'Snowy Oasis',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'snowy-oasis',
      ),
      92 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 10 Apr 2019 17:03:10 +0000',
        'name' => 'Social Media Service',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'social-media-service',
      ),
      93 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 17 Feb 2019 12:27:43 +0000',
        'name' => 'Spa & Beauty Studio',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'spa-beauty-studio',
      ),
      94 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Thu, 30 May 2019 17:05:57 +0000',
        'name' => 'Spa',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'spa',
      ),
      95 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Fri, 30 Mar 2018 09:59:40 +0000',
        'name' => 'Spring',
        'description' => '',
        'frontpage' => '0',
        'status' => 'agency',
        'name_clean' => 'spring',
      ),
      96 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 26 Jan 2019 16:30:01 +0000',
        'name' => 'Startup',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'startup',
      ),
      97 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 19 Aug 2018 07:48:14 +0000',
        'name' => 'Stylish Workplace',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'stylish-workplace',
      ),
      98 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 26 Jun 2019 17:26:44 +0000',
        'name' => 'TechExpo',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'techexpo',
      ),
      99 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 18 Aug 2019 17:19:12 +0000',
        'name' => 'Telecommunication',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'telecommunication',
      ),
      100 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:22:49 +0000',
        'name' => 'The Big City Newsletter',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'the-big-city-newsletter',
      ),
      101 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.14',
        'last_edit' => 'Thu, 22 Mar 2018 11:33:57 +0000',
        'name' => 'The Sunny View',
        'description' => 'Andrea',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'the-sunny-view',
      ),
      102 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.001',
        'last_edit' => 'Tue, 20 Feb 2018 10:57:27 +0000',
        'name' => 'Travel Agency',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'travel-agency',
      ),
      103 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 12:39:22 +0000',
        'name' => 'Travel Blog',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'travel-blog',
      ),
      104 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:24:56 +0000',
        'name' => 'Tulips',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'tulips',
      ),
      105 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sun, 27 Jan 2019 08:47:12 +0000',
        'name' => 'Valentine&#39;s Day',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'valentines-day',
      ),
      106 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.001',
        'last_edit' => 'Mon, 19 Feb 2018 12:31:48 +0000',
        'name' => 'Video Production',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'video-production',
      ),
      107 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Thu, 04 Apr 2019 16:55:28 +0000',
        'name' => 'Virtual Assistant Service',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'virtual-assistant-service',
      ),
      108 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Sat, 07 Jul 2018 15:15:19 +0000',
        'name' => 'Walking Away (Video)',
        'description' => '',
        'frontpage' => '0',
        'status' => 'pro',
        'name_clean' => 'walking-away-video',
      ),
      109 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Mon, 26 Feb 2018 19:54:07 +0000',
        'name' => 'Webinar',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'webinar',
      ),
      110 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.005',
        'last_edit' => 'Fri, 23 Feb 2018 11:53:23 +0000',
        'name' => 'Wedding Blog',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'wedding-blog',
      ),
      111 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Tue, 22 May 2018 12:41:04 +0000',
        'name' => 'White Orchids',
        'description' => '',
        'frontpage' => '1',
        'status' => 'pro',
        'name_clean' => 'white-orchids',
      ),
      112 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '5.14',
        'last_edit' => 'Thu, 22 Mar 2018 11:29:56 +0000',
        'name' => 'Working Out',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'working-out',
      ),
      113 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.05',
        'last_edit' => 'Fri, 02 Mar 2018 12:36:42 +0000',
        'name' => 'Workplace',
        'description' => 'Andrea',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'workplace',
      ),
      114 =>
      array(
        'type' => 'CSMM PRO',
        'version' => '15.17',
        'last_edit' => 'Wed, 25 Apr 2018 11:00:38 +0000',
        'name' => 'Writing Service (Video)',
        'description' => '',
        'frontpage' => '1',
        'status' => 'agency',
        'name_clean' => 'writing-service-video',
      ),
    );
  //$themes = array_reverse($themes);

  echo '<p>Are you in a hurry? Looking for something that looks great for your site? Pick one of <b>110+ premium pre-built themes</b> and be done in 5 minutes! Our PRO plugin comes with built-in SEO analyzer, a collection of one million images and it can connect to any mailing system like Mailchimp so you can start collecting emails from day one!</p>';

  $i = 1;
  foreach ($themes as $theme) {
    if ($i > 6) {
      echo '<div class="theme-thumb hidden" data-theme="' . $theme['name_clean'] . '">';
    } else {
      echo '<div class="theme-thumb" data-theme="' . $theme['name_clean'] . '">';
    }
    $i++;
    if ($theme['status'] != 'free') {
      echo '<a href="' . mtnc_csmm_generate_web_link('preview-theme-thumb-' . $theme['name_clean'], 'theme-preview', array('theme' => $theme['name_clean'])) . '" target="_blank"><img src="' . MTNC_URI . '/images/pro-templates/' . $theme['name_clean'] . '.jpg" alt="Preview ' . $theme['name'] . '" title="Preview ' . $theme['name'] . '"></a>';
    }
    echo '<span class="name">' . $theme['name'] . ' <small>' . $theme['status'] . ' theme</small></span>';
    echo '<span name="actions">';
    if ($theme['status'] != 'free') {
      echo '<a href="' . mtnc_csmm_generate_web_link('buy-with-25', '/', array('coupon' => 'maintenance')) . '" target="_blank" class="button button-primary">BUY with 25% discount</a>&nbsp; &nbsp;';
      echo '<a target="_blank" class="button button-secondary" href="' . mtnc_csmm_generate_web_link('preview-theme-' . $theme['name_clean'], 'theme-preview', array('theme' => $theme['name_clean'])) . '">Preview</a>';
    }
    echo '</span>';
    if ($theme['status'] != 'free') {
      echo '<div class="ribbon" title="' . ucfirst($theme['status']) . ' theme. Click \'Get this theme\' for more info."><i><span class="dashicons dashicons-star-filled"></span></i></div>';
    }
    echo '</div>';
  } // foreach theme

  echo '<p class="textcenter"><a href="#" class="button button-primary" id="show-all-themes">Show All 110+ Themes</a><br><br></p>';
}

function mtnc_csmm_generate_web_link($placement = '', $page = '/', $params = array(), $anchor = '') {
  $base_url = 'https://comingsoonwp.com';

  if ('/' != $page) {
    $page = '/' . trim($page, '/') . '/';
  }
  if ($page == '//') {
    $page = '/';
  }

  $parts = array_merge(array('utm_source' => 'maintenance-free', 'utm_medium' => 'plugin', 'utm_content' => $placement, 'utm_campaign' => 'maintenance-free-v' . MTNC_VERSION), $params);

  if (!empty($anchor)) {
    $anchor = '#' . trim($anchor, '#');
  }

  $out = $base_url . $page . '?' . http_build_query($parts, '', '&amp;') . $anchor;

  return $out;
} // csmm_generate_web_link


function mtnc_add_exclude_pages_fields()
{
  $mt_option = mtnc_get_plugin_options(true);
  $out_filed = '';

  $post_types = get_post_types(
    array(
      'show_ui' => true,
      'public'  => true,
    ),
    'objects'
  );

  $out_filed .= '<table class="form-table">';
  $out_filed .= '<tbody>';
  $out_filed .= '<tr valign="top">';
  $out_filed .= '<th colspan="2" scope="row">' . __('Select the page(s) to be displayed normally, excluded by maintenance mode:', 'maintenance') . '</th>';
  $out_filed .= '</tr>';

  foreach ($post_types as $post_slug => $type) {

    if (($post_slug === 'attachment') || ($post_slug === 'revision') || ($post_slug === 'nav_menu_item')
    ) {
      continue;
    }

    $args = array(
      'posts_per_page' => -1,
      'orderby'        => 'NAME',
      'order'          => 'ASC',
      'post_type'      => $post_slug,
      'post_status'    => 'publish',
    );

    $posts_array = get_posts($args);
    $db_pages_ex = array();

    if (!empty($posts_array)) {

      /*Exclude pages from maintenance mode*/
      if (!empty($mt_option['exclude_pages']) && isset($mt_option['exclude_pages'][$post_slug])) {
        $db_pages_ex = $mt_option['exclude_pages'][$post_slug];
      }

      $out_filed .= '<tr valign="top">';
      $out_filed .= '<th scope="row">' . $type->labels->name . '</th>';

      $out_filed .= '<fieldset>';
      $out_filed .= '<td>';

      $out_filed .= '<select id="exclude-pages-' . $post_slug . '" name="lib_options[exclude_pages][' . $post_slug . '][]" style="width:100%;" class="exclude-pages multiple-select-mt" multiple="multiple">';

      foreach ($posts_array as $post_values) {
        $current = null;
        if (!empty($db_pages_ex) && in_array($post_values->ID, $db_pages_ex, false)) {
          $current = $post_values->ID;
        }
        $selected   = selected($current, $post_values->ID, false);
        $out_filed .= '<option value="' . $post_values->ID . '" ' . $selected . '>' . $post_values->post_title . '</option>';
      }

      $out_filed .= '</select>';

      $out_filed .= '</fieldset>';
      $out_filed .= '</td>';
      $out_filed .= '</tr>';
    }
  }

  $out_filed .= '<tr><td colspan="2"><p><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p></td></tr>';
  $out_filed .= '</tbody>';
  $out_filed .= '</table>';

  echo $out_filed; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_get_background_fileds_action()
{
  $mt_option = mtnc_get_plugin_options(true);
  mtnc_generate_image_filed(__('Background image', 'maintenance'), 'body_bg', 'body_bg', esc_attr($mt_option['body_bg']), 'boxes box-bg', __('Upload Background', 'maintenance'), 'upload_background upload_btn button');
}
add_action('mtnc_background_field', 'mtnc_get_background_fileds_action', 10);

function mtnc_get_color_fileds_action()
{
  $mt_option = mtnc_get_plugin_options(true);
  mtnc_get_color_field(__('Background color', 'maintenance'), 'body_bg_color', 'body_bg_color', esc_attr($mt_option['body_bg_color']), '#111111');
  mtnc_get_color_field(__('Font color', 'maintenance'), 'font_color', 'font_color', esc_attr($mt_option['font_color']), '#ffffff');
  mtnc_get_color_field(__('Login block background color', 'maintenance'), 'controls_bg_color', 'controls_bg_color', isset($mt_option['controls_bg_color']) ? esc_attr($mt_option['controls_bg_color']) : '', '#000000');
}
add_action('mtnc_color_fields', 'mtnc_get_color_fileds_action', 10);


function mtnc_get_font_fileds_action()
{
  $mt_option = mtnc_get_plugin_options(true);
  echo mtnc_get_fonts_field(__('Font family', 'maintenance'), 'body_font_family', 'body_font_family', esc_attr($mt_option['body_font_family'])); // phpcs:ignore WordPress.Security.EscapeOutput
  $subset = '';

  if (!empty($mt_option['body_font_subset'])) {
    $subset = $mt_option['body_font_subset'];
  }
  echo mtnc_get_fonts_subsets(__('Subsets', 'maintenance'), 'body_font_subset', 'body_font_subset', esc_attr($subset)); // phpcs:ignore WordPress.Security.EscapeOutput
}
add_action('mtnc_font_fields', 'mtnc_get_font_fileds_action', 10);


function mtnc_contact_support()
{
  $promo_text  = '';
  $promo_text .= '<div class="sidebar-promo">';
  $promo_text .= '<p>We\'re here for you! We know how frustrating it is when things don\'t work!<br>Please <a href="https://wordpress.org/support/plugin/maintenance/" target="_blank">open a new topic in our official support forum</a> and we\'ll get back to you ASAP! We answer all questions, and most of them within a few hours.</p>';
  $promo_text .= '<p><a href="https://wordpress.org/support/plugin/maintenance/" target="_blank" class="button button-secondary">Ask for Help</a></p>';
  $promo_text .= '</div>';
  echo $promo_text; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_review_box()
{
  $promo_text  = '';
  $promo_text .= '<div class="sidebar-promo">';
  $promo_text .= '<p><b>Your review means a lot!</b> Please help us spread the word so that others know this plugin is free and well maintained! Thank you very much for <a href="https://wordpress.org/support/plugin/maintenance/reviews/#new-post" target="_blank">reviewing the Maintanance plugin with ★★★★★ stars</a>!</p>';
  $promo_text .= '<p><a href="https://wordpress.org/support/plugin/maintenance/reviews/#new-post" target="_blank" class="button button-primary">Leave a Review</a> &nbsp;&nbsp; <a href="#" class="hide-review-box2">I already left a review ;)</a></p>';
  $promo_text .= '</div>';
  echo $promo_text; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_extended_version()
{
  $promo_text  = '';
  if (mtnc_is_weglot_active()) {
    $promo_text .= '<p>You are minutes away from having your site translated to 100+ languages thanks to <a href="https://wordpress.org/plugins/weglot/" target="_blank">Weglot</a>! Make sure you configure everything in <a href="' . admin_url('admin.php?page=weglot-settings') . '" target="_blank">Weglot options</a> so that visitors can browse in their native language.</p>';
  } else {
    $promo_text .= '<a title="Install Weglot and translate your site to 100+ languages" href="#" class="open-weglot-upsell"><img src="' . MTNC_URI . 'images/weglot-banner.png" alt="Install Weglot and translate your site to 100+ languages" title="Install Weglot and translate your site to 100+ languages"></a>';
  }
  echo $promo_text; // phpcs:ignore WordPress.Security.EscapeOutput
}

function mtnc_cur_page_url()
{
  $page_url = 'http';
  if (isset($_SERVER['HTTPS'])) {
    $page_url .= 's';
  }
  $page_url .= '://';
  if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] !== '80') {
    $page_url .= wp_unslash($_SERVER['SERVER_NAME']) . ':' . wp_unslash($_SERVER['SERVER_PORT']) . wp_unslash($_SERVER['REQUEST_URI']);
  } else {
    $page_url .= wp_unslash($_SERVER['SERVER_NAME']) . wp_unslash($_SERVER['REQUEST_URI']);
  }
  return $page_url;
}

function mtnc_check_exclude()
{
  global $mt_options, $post;
  $mt_options = mtnc_get_plugin_options(true);
  $is_skip    = false;
  $cur_url    = mtnc_cur_page_url();
  if (is_page() || is_single()) {
    $curr_id = $post->ID;
  } else {
    if (is_home()) {
      $blog_id = get_option('page_for_posts');
      if ($blog_id) {
        $curr_id = $blog_id;
      }
    }

    if (is_front_page()) {
      $front_page_id = get_option('show_on_front');
      if ($front_page_id) {
        $curr_id = $front_page_id;
      }
    }
  }

  if (isset($mt_options['exclude_pages']) && !empty($mt_options['exclude_pages'])) {
    $exlude_objs = $mt_options['exclude_pages'];
    foreach ($exlude_objs as $objs_id) {
      foreach ($objs_id as $obj_id) {
        if ($curr_id === (int) $obj_id) {
          $is_skip = true;
          break;
        }
      }
    }
  }

  return $is_skip;
}


function mtnc_load_maintenance_page($original_template)
{
  global $mt_options;

  $v_curr_date_start = $v_curr_date_end = $v_curr_time = '';
  $vdate_start       = $vdate_end = date_i18n('Y-m-d', strtotime(current_time('mysql', 0)));
  $vtime_start       = date_i18n('h:i:s A', strtotime('01:00:00 am'));
  $vtime_end         = date_i18n('h:i:s A', strtotime('12:59:59 pm'));

  if (file_exists(MTNC_LOAD . 'index.php') && isset($_GET['maintenance-preview'])) {
    add_filter('script_loader_tag', 'mtnc_defer_scripts', 10, 2);
    return MTNC_LOAD . 'index.php';
  }

  if (!is_user_logged_in()) {
    if (!empty($mt_options['state'])) {

      if (!empty($mt_options['expiry_date_start'])) {
        $vdate_start = $mt_options['expiry_date_start'];
      }
      if (!empty($mt_options['expiry_date_end'])) {
        $vdate_end = $mt_options['expiry_date_end'];
      }
      if (!empty($mt_options['expiry_time_start'])) {
        $vtime_start = $mt_options['expiry_time_start'];
      }
      if (!empty($mt_options['expiry_time_end'])) {
        $vtime_end = $mt_options['expiry_time_end'];
      }

      $v_curr_time = strtotime(current_time('mysql', 0));

      $v_curr_date_start = strtotime($vdate_start . ' ' . $vtime_start);
      $v_curr_date_end   = strtotime($vdate_end . ' ' . $vtime_end);

      if (mtnc_check_exclude()) {
        return $original_template;
      }

      if (($v_curr_time < $v_curr_date_start) || ($v_curr_time > $v_curr_date_end)) {
        if (!empty($mt_options['is_down'])) { // is down - is flag for "Open website after countdown expired"
          return $original_template;
        }
      }
    } else {
      return $original_template;
    }

    if (file_exists(MTNC_LOAD . 'index.php')) {
      add_filter('script_loader_tag', 'mtnc_defer_scripts', 10, 2);
      return MTNC_LOAD . 'index.php';
    } else {
      return $original_template;
    }
  } else {
    return $original_template;
  }
}

function mtnc_defer_scripts($tag, $handle)
{
  if (strpos($handle, '_ie') !== 0) {
    return $tag;
  }
  return str_replace(' src', ' defer="defer" src', $tag);
}

function mtnc_metaboxes_scripts()
{
  global $mtnc_variable;
  ?>
  <script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function() {
      jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');
      postboxes.add_postbox_toggles('<?php echo esc_js($mtnc_variable->options_page); ?>');
    });
    //]]>
  </script>
<?php
}

function mtnc_add_toolbar_items()
{
  global $wp_admin_bar, $wpdb;
  $mt_options = mtnc_get_plugin_options(true);
  $check      = '';
  if (!is_super_admin() || !is_admin_bar_showing()) {
    return;
  }
  $url_to = admin_url('admin.php?page=maintenance');

  if ($mt_options['state']) {
    $check = 'On';
  } else {
    $check = 'Off';
  }
  $wp_admin_bar->add_menu(
    array(
      'id'    => 'maintenance_options',
      'title' => __('Maintenance', 'maintenance') . __(' is ', 'maintenance') . $check,
      'href'  => $url_to,
      'meta'  => array(
        'title' => __(
          'Maintenance',
          'maintenance'
        ) . __(
          ' is ',
          'maintenance'
        ) . $check,
      ),
    )
  );
}


function mtnc_hex2rgb($hex)
{
  $hex = str_replace('#', '', $hex);

  if (strlen($hex) === 3) {
    $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
    $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
    $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
  } else {
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
  }
  $rgb = array($r, $g, $b);
  return implode(',', $rgb);
}


function mtnc_insert_attach_sample_files()
{
  global $wpdb;
  $title            = '';
  $attach_id        = 0;
  $is_attach_exists = $wpdb->get_results("SELECT p.ID FROM $wpdb->posts p WHERE  p.post_title LIKE '%mt-sample-background%'", OBJECT);

  if (!empty($is_attach_exists)) {
    $attach_id = current($is_attach_exists)->ID;
  } else {
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $image_url    = MTNC_DIR . 'images/mt-sample-background.jpg';
    $file_name    = basename($image_url);
    $file_content = file_get_contents($image_url);
    $upload       = wp_upload_bits($file_name, null, $file_content, current_time('mysql', 0));

    if (!$upload['error']) {
      $title = preg_replace('/\.[^.]+$/', '', $file_name);

      $wp_filetype = wp_check_filetype(basename($upload['file']), null);
      $attachment  = array(
        'guid'           => $upload['url'],
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'inherit',
      );

      $attach_id   = wp_insert_attachment($attachment, $upload['file']);
      $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
      wp_update_attachment_metadata($attach_id, $attach_data);
    }
  }

  if (!empty($attach_id)) {
    return $attach_id;
  } else {
    return '';
  }
}

function mtnc_get_default_array()
{
  $defaults = array(
    'state'             => true,
    'page_title'        => __('Site is undergoing maintenance', 'maintenance'),
    'heading'           => __('Maintenance mode is on', 'maintenance'),
    'description'       => __('Site will be available soon. Thank you for your patience!', 'maintenance'),
    'footer_text'       => '&copy; ' . get_bloginfo('name') . ' ' . date('Y'),
    'show_some_love'    => '',
    'logo_width'        => 220,
    'logo_height'       => '',
    'logo'              => '',
    'retina_logo'       => '',
    'body_bg'           =>  mtnc_insert_attach_sample_files(),
    'bg_image_portrait' => '',
    'preloader_img'     => '',
    'body_bg_color'     => '#111111',
    'controls_bg_color' => '#111111',
    'font_color'        => '#ffffff',
    'body_font_family'  => 'Open Sans',
    'body_font_subset'  => 'Latin',
    'is_blur'           => false,
    'blur_intensity'    => 5,
    '503_enabled'       => false,
    'gg_analytics_id'   => '',
    'is_login'          => true,
    'custom_css'        => '',
    'exclude_pages'     => '',
    'mailoptin_campaign'=> '-1',
    'default_settings'  => true
  );

  return apply_filters('mtnc_get_default_array', $defaults);
}

if (!function_exists('mtnc_get_google_fonts')) {
  function mtnc_get_google_fonts()
  {
    $gg_fonts = file_get_contents(MTNC_DIR . 'includes/fonts/googlefonts.json');
    return $gg_fonts;
  }
}
