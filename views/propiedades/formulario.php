<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo sanitizar($propiedad-> titulo );?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar( $propiedad-> precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad-> imagen != ''){ ?>   
        <img src="/imagenes/<?php echo $propiedad-> imagen; ?>" class="imagen-small" alt="Imagen de la propiedad">
    <?php }; ?>
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10" value=""><?php echo sanitizar($propiedad-> descripcion); ?></textarea> 
</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="numbrer" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad-> habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="numbrer" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad-> wc); ?>">

    <label for="estacionamientos">Estacionamientos:</label>
    <input type="numbrer" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad-> estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <select name="propiedad[vendedor_id]" id="vendedor_id">
        <label for="vendedor_id">Vendedor</label>
        <option value="" disabled selected>--Seleccione--</option>
        <?php foreach($vendedores as $vendedor){?>
            <option  <?php echo $propiedad-> vendedor_id === $vendedor-> id ? 'selected' : ''; ?> value="<?php echo sanitizar($vendedor-> id); ?>"><?php echo sanitizar($vendedor-> nombre). " ". sanitizar($vendedor-> apellido); ?></option>
        <?php } ?>     
    </select>
</fieldset>