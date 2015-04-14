<?php
if(isset($_POST['submit'])) {
    if ($_POST['submit'] == 'Crear Slider') {
        if (!isset($_POST['name'])|| $_POST['name'] == ''
            || !isset($_POST['slidespeed']) || $_POST['slidespeed'] == '') {
            echo "No puede haber ningún campo en blanco";
        } else {
            if (is_numeric($_POST['slidespeed'])
            && is_numeric($_POST['width'])
            && is_numeric($_POST['height'])) {
                $this->new_slider($_POST);
                $this->redirect_page('main');
            } else {
                echo "El número de items, altura y ancho tiene que ser un número";
            }
        }
    }
}
?>
<form action=""  method="post" >
    <p>Rellene los campos y pulse el botón para crear un nuevo Slider.</p>
    Nombre del Slider: <input type="text" name="name"><br>
    Ancho de los circulos: <input type="text" name="width"><br>
    Largo de los circulos: <input type="text" name="height"><br>
    <p>Recomendamos que el ancho y el lago de los circulos sea igual para formar realmente un circulo.</p>
    <p>Recomendado: 250</p>
    Numero de items (movil):
    <select name="items_small">
        <option value="1">1</option>
    </select>
    <br>
    Numero de items (tablets):
    <select name="items_medium">
        <option value="1">1</option>
        <option value="3">3</option>
    </select>
    <br>
    Numero de items (PC):
    <select name="items_long">
        <option value="1">1</option>
        <option value="3">3</option>
        <option value="5">5</option>
    </select>
    <br>
    Autoplay:
    <select name="autoplay">
        <option value="1">si</option>
        <option value="0">no</option>
    </select>
    <br>
    Loop:
    <select name="loop">
        <option value="1">si</option>
        <option value="0">no</option>
    </select>
    <br>
    Barra navegacion (movil):
    <select name="nav_small">
        <option value="1">si</option>
        <option value="0">no</option>
    </select>
    Barra navegacion (tablets):
    <select name="nav_medium">
        <option value="1">si</option>
        <option value="0">no</option>
    </select>
    Barra navegacion (PC):
    <select name="nav_long">
        <option value="1">si</option>
        <option value="0">no</option>
    </select>
    <br>
    Tiempo de transición <input type="text" name="slidespeed"><br>
    <?php submit_button('Crear Slider'); ?>
</form>
