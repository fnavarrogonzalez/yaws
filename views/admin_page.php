<?php
if(isset($_POST['edit'])) {
    $this->redirect_page_id('edit',$_POST['edit']);
}
if(isset($_POST['delete'])){
    $this->delete_slider($_POST['delete']);
    $this->redirect_page('main');
}
if(isset($_POST['images'])){
    $this->redirect_page_id('images', $_POST['images']);
}
?>
<form name="post" action="" method="post" id="post">
    <table class="wp-list-table widefat fixed posts">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Añadir Imagen</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sliders = $this->get_sliders();
            foreach($this->get_sliders() as $slider):
            ?>
            <tr>
                <th><?php echo $slider->id ?></th>
                <th><?php echo $slider->name; ?></th>
                <th> <p class="submit"><button type="submit" name="edit" id="submit" class="button button-primary" value="<?php echo $slider->id; ?>">Editar Slider</button></p></th>
                <th> <p class="submit"><button type="submit" name="images" id="submit" class="button button-primary" value="<?php echo $slider->id; ?>">Imagenes</button></p></th>
                <th> <p class="submit"><button type="submit" name="delete" id="submit" class="button button-primary" value="<?php echo $slider->id; ?>">Borrar Slider</button></p></th>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</form>
