<main class="contenedor seccion">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error ) {?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php }?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">E-mail</label>
            <input type="email" name="admin[email]" placeholder="correo@correo.com" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="admin[password]" placeholder="Tu Password" id="password" required>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>