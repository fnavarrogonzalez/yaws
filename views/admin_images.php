<?php
    if(!isset($_GET['id'])){
        echo "No has seleccionado ningún slider";
        exit;
    }
    if(isset($_POST['insert'])){
        $this->redirect_page_id('addimage', $_GET['id']);
        exit;
    }
    if(isset($_POST['delete'])){
        $this->delete_image($_POST['delete']);
        $this->redirect_page_id('images', $_GET['id']);
    }
?>

<form name="post" action="" method="post" id="post">
    <table class="wp-list-table widefat fixed posts">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Image</th>
            <th>Descripción</th>
            <th>Borrar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->get_images_slider($_GET['id']) as $image):
            ?>
            <tr>
                <th><?php echo $image->id ?></th>
                <th><?php echo $image->name; ?></th>
                <th><img width="250px" heigth="250px" src="<?php echo $image->url; ?>" alt="<?php echo $image->id; ?>"></th>
                <th><?php echo $image->description; ?></th>
                <th> <p class="submit"><button type="submit" name="delete" id="submit" class="button button-primary" value="<?php echo $image->id; ?>">Borrar Imagen</button></p></th>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <th> <p class="submit"><button type="submit" name="insert" id="submit" class="button button-primary" value="none">Insert</button></p></th>
</form>