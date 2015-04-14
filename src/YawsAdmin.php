<?php
class YawsAdmin{

    private $admin_pages = array(
        'main' => 'Yaws',
        'create' => 'create',
        'edit' => 'yaws_edit_slider',
        'images' => 'yaws_images_slider',
        'addimage' => 'yaws_images_add'
    );

    /**
     * sliders i/o
     */
    public function get_sliders(){
        global $wpdb;
        $table = $wpdb->prefix . 'yaws_sliders';
        return $wpdb->get_results("SELECT * FROM $table");
    }

    public function get_slider_id($id){
        global $wpdb;
        $table = $wpdb->prefix . 'yaws_sliders';
        $id = mysql_real_escape_string($id);
        return $wpdb->get_results("SELECT * FROM $table where id=$id");
    }

    public function new_slider($args){
        global $wpdb;
        $name = mysql_real_escape_string($args['name']);
        $slidespeed = mysql_real_escape_string($args['slidespeed']);
        $loop = mysql_real_escape_string($args['loop']);
        $items_small = mysql_real_escape_string($args['items_small']);
        $items_medium = mysql_real_escape_string($args['items_medium']);
        $items_long = mysql_real_escape_string($args['items_long']);
        $nav_small = mysql_real_escape_string($args['nav_small']);
        $nav_medium = mysql_real_escape_string($args['nav_medium']);
        $nav_long = mysql_real_escape_string($args['nav_long']);
        $autoplay = mysql_real_escape_string($args['autoplay']);
        $width = mysql_real_escape_string($args['width']);
        $height = mysql_real_escape_string($args['height']);
        $table = $wpdb->prefix . 'yaws_sliders';
        $wpdb->query("INSERT INTO $table
          (name, slidespeed, loopsliders, items_small, items_medium,items_long, nav_small, nav_medium, nav_long, autoplay, width, height)
        values ( '$name', '$slidespeed', '$loop', '$items_small','$items_medium','$items_long','$nav_small',
        '$nav_medium', '$nav_long', '$autoplay', '$width', '$height');");
    }

    public function delete_slider($id){
        global $wpdb;
        $table = $wpdb->prefix . 'yaws_sliders';
        $id = mysql_real_escape_string($id);
        $wpdb->query("DELETE FROM $table WHERE id='$id'");
        $table= $wpdb->prefix . 'yaws_images';
        $wpdb->query("DELETE FROM $table WHERE slider_id='$id'");
    }

    public function update_slider($args, $id){
        global $wpdb;
        $id = mysql_real_escape_string($id);
        $name = mysql_real_escape_string($args['name']);
        $slidespeed = mysql_real_escape_string($args['slidespeed']);
        $loop = mysql_real_escape_string($args['loop']);
        $items_small = mysql_real_escape_string($args['items_small']);
        $items_medium = mysql_real_escape_string($args['items_medium']);
        $items_long = mysql_real_escape_string($args['items_long']);
        $nav_small = mysql_real_escape_string($args['nav_small']);
        $nav_medium = mysql_real_escape_string($args['nav_medium']);
        $nav_long = mysql_real_escape_string($args['nav_long']);
        $autoplay = mysql_real_escape_string($args['autoplay']);
        $width = mysql_real_escape_string($args['width']);
        $height = mysql_real_escape_string($args['height']);
        $table = $wpdb->prefix . 'yaws_sliders';
        $wpdb->query("UPDATE $table SET name='$name', slidespeed='$slidespeed', loopsliders='$loop', items_small='$items_small',
                items_medium='$items_medium', items_long='$items_long', nav_small='$nav_small', nav_medium='$nav_medium',
                nav_long='$nav_long', autoplay='$autoplay', width='$width', height='$height' WHERE id = $id;");
    }

    public function get_images_slider($id){
        global $wpdb;
        $table = $wpdb->prefix . 'yaws_images';
        $id = mysql_real_escape_string($id);
        return $wpdb->get_results("SELECT * FROM $table WHERE slider_id='$id'");
    }

    public function insert_images_slider($args){
        global $wpdb;
        $table = $wpdb->prefix . 'yaws_images';
        $slider_id = mysql_real_escape_string($args['sliderid']);
        $name = mysql_real_escape_string($args['name']);
        $url = mysql_real_escape_string($args['url']);
        $description = mysql_real_escape_string($args['description']);
        $wpdb->query("INSERT INTO $table
              (slider_id, name, url, description) values
              ('$slider_id', '$name', '$url', '$description')");
    }

    public function delete_image($id_image){
        global $wpdb;
        $table = $wpdb->prefix . 'yaws_images';
        $id_image = mysql_real_escape_string($id_image);
        $wpdb->query("DELETE FROM $table WHERE id='$id_image'");
    }

    /***
     * Pages creation
     */
    public function main_page(){
        add_object_page('Yaws', 'Yaws', 'activate_plugins', 'Yaws', array($this, 'admin_page'));
        add_submenu_page('Yaws', 'New Slider', 'New Slider', 'manage_options', 'yaws_create_slider', array($this, 'admin_create_slider'));
        add_submenu_page(null, 'Edit Slider', 'Edit Slider', 'manage_options', 'yaws_edit_slider', array($this, 'admin_edit_slider'));
        add_submenu_page(null, 'Images', 'Images', 'manage_options', 'yaws_images_slider', array($this, 'admin_images_slider'));
        add_submenu_page(null, 'Add Images', 'Add Images', 'manage_options', 'yaws_images_add', array($this, 'admin_images_add'));
    }

    /***
     * VIEWS
     */
    public function admin_page(){
        include(plugin_dir_path(__FILE__) . '../views/admin_page.php');
    }

    public function admin_create_slider(){
        include(plugin_dir_path(__FILE__) . '../views/admin_create.php');
    }

    public function admin_edit_slider(){
        include(plugin_dir_path(__FILE__) . '../views/admin_edit.php');
    }

    public function admin_images_slider(){
        include(plugin_dir_path(__FILE__) . '../views/admin_images.php');
    }

    public function admin_images_add(){
        include(plugin_dir_path(__FILE__) . '../views/admin_images_add.php');
    }

    /**
     * Auxiliar
     */
    private function redirect_page($page){
        $url = '/wp-admin/admin.php?page='. $this->admin_pages[$page];
        echo '<script type="text/javascript">
        window.location = '. '\'' . $url .'\''
            .'</script>';
    }
    private function redirect_page_id($page, $id){
        $url = '/wp-admin/admin.php?page='. $this->admin_pages[$page];
        echo '<script type="text/javascript">
        window.location = '. '\'' . $url . '&id=' . $id . '\''
            .'</script>';
    }
}
?>