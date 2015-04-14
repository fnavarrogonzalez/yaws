<?php
if(!isset($_GET['id'])){
    echo "No has seleccionado un slider o no existe";
    exit();
}
if(isset($_POST['add'])) {
    if (isset($_POST['image_url'])) {
        $args = array();
        $args['url'] = $_POST['image_url'];
        $args['sliderid'] = $_GET['id'];
        if(isset($_POST['name'])){
            $args['name'] = $_POST['name'];
        }else{
            $args['name'] = '';
        }
        if(isset($_POST['description'])){
            $args['description'] = $_POST['description'];
        }else{
            $args['description'] = '';
        }
        $this->insert_images_slider($args);
        $this->redirect_page_id('images',$_GET['id']);
        exit;
    } else {
        echo "No has seleccionado una imagen";
    }
}
?>
<form action="" method="post" xmlns="http://www.w3.org/1999/html">
    <div>
        <label for="name">Nombre de la Imagen</label>
        <input type="text" name="name"> </input>
    </div>
    <div>
        <label for="description">Descripción de la Imagen</label></br>
        <textarea rows="4" cols="100" type="textarea" name="description"></textarea>
    </div>
    <div>
        <label for="image_url">Image</label>
        <input type="text" name="image_url" id="image_url" class="regular-text">
        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
    </div>
    <p class="submit"><button type="submit" name="add" id="submit" class="button button-primary" value="asdf">Añadir Imagen</button></p>
</form>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#upload-btn').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Subir Imagen',
                multiple: false
            }).open()
                .on('select', function(e){
                    var uploaded_image = image.state().get('selection').first();
                    var image_url = uploaded_image.toJSON().url;
                    $('#image_url').val(image_url);
                });
        });
    });
</script>