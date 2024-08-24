<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo sanitizar($vendedor-> nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor" value="<?php echo sanitizar($vendedor-> apellido); ?>">

</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>
    
    <label for="telefono">Telefono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" value="<?php echo sanitizar($vendedor-> telefono); ?>">
    

</fieldset>
