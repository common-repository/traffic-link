<?php
/*

  Plugin Name: Traffic Link
  Plugin URI: http://wpthings.dinopress.net/2010/10/traffic-link-wordpress-plugin/
  Author: Turcu Ciprian
  License: GPL
  Version: 0.1
  Author URI: http://www.chipree.com
  Description: Smart clean linking platform for similar websites or blogs.
 */

function tl_WidgetShow($args) {
    extract($args);

    $tl_Arr = null;

    $tl_url = get_bloginfo('url');
    $tl_Arr = unserialize(get_option('tl_values'));

    $tl_title = $tl_Arr[0];
    $tl_size = $tl_Arr[1];
    $tl_style = $tl_Arr[2];

    if ($tl_title == "") {
        $tl_title = "Simmilar";
    }
    if ($tl_size == "") {
        $tl_size = "1";
    }
    if ($tl_style == "") {
        $tl_style = "1";
    }
    $tl_width = "125";
    $tl_height = "125";
    switch ($tl_size) {
        case "1":
            $tl_width = "125";
            $tl_height = "125";
            break;
        case "2":
            $tl_width = "175";
            $tl_height = "175";
            break;
        case "3":
            $tl_width = "250";
            $tl_height = "250";
            break;
    }
    echo $before_widget;
    echo $before_title . $tl_title . $after_title;
?><div class="TrafficLink">
        <center>
            <IFRAME SRC="http://wordpress.chipree.com/TrafficLink/script/script.php?url=<?php echo base64_encode($tl_url); ?>&size=<?php echo $tl_size; ?>&style=<?php echo $tl_style; ?>" width="<?php echo $tl_width; ?>" height="<?php echo $tl_height; ?>" frameborder="no"></IFRAME>
        </center>
    </div><?php
    /*

     */
    echo $after_widget;
}

function tl_WidgetForm() {

    if ($_POST['tl_size'] != "") {

        $tl_title = $_POST['tl_title'];
        $tl_size = $_POST['tl_size'];
        $tl_style = $_POST['tl_style'];

        if ($tl_title == "")
            $tl_title = "Simmilar";

        if ($tl_size == "")
            $tl_size = "1";

        if ($tl_style == "")
            $tl_style = "1";

        $tl_Arr[0] = $tl_title;
        $tl_Arr[1] = $tl_size;
        $tl_Arr[2] = $tl_style;

        update_option('tl_values', serialize($tl_Arr));
    }else {
        $tl_Arr = null;
        $tl_Arr = get_option('tl_values');
        $tl_Arr = unserialize($tl_Arr);

        $tl_title = $tl_Arr[0];
        $tl_size = $tl_Arr[1];
        $tl_style = $tl_Arr[2];

        if ($tl_title == "") {
            $tl_title = "Advertisements";
        }
?>
        <strong>Widget Title:</strong> <br/>
        <input type="text" name="tl_title" value="<?php echo $tl_title; ?>" /><br/><br />
        <strong>Sizes:</strong><br />
        <input type="radio" name="tl_size" value="1" <?php if ($tl_size == 1)
            echo "checked"; ?> /> 125 x 125<br/>
 <input type="radio" name="tl_size" value="2" <?php if ($tl_size == 2)
            echo "checked"; ?> /> 175 x 175<br/>
 <input type="radio" name="tl_size" value="3" <?php if ($tl_size == 3)
            echo "checked"; ?> /> 250 x 250<br /><br />
 <strong>Style:</strong><br />
 <input type="radio" name="tl_style" value="1" <?php if ($tl_style == 1)
            echo "checked"; ?> /> Simple white background<br/>
 <input type="radio" name="tl_style" value="2" <?php if ($tl_style == 2)
            echo "checked"; ?> /> Simple dark background<br/>
 <input type="radio" name="tl_style" value="3" <?php if ($tl_style == 3)
            echo "checked"; ?> /> Shade white background<br/>
 <input type="radio" name="tl_style" value="4" <?php if ($tl_style == 4)
            echo "checked"; ?> /> Shade dark background<br/>


<?php
    }
}

function tl_add_action_plugins_loaded() {
    register_sidebar_widget(array('Traffic Link', 'widgets'), 'tl_WidgetShow');
    register_widget_control(array('Traffic Link', 'widgets'), 'tl_WidgetForm');
}

add_action('plugins_loaded', 'tl_add_action_plugins_loaded');

?>