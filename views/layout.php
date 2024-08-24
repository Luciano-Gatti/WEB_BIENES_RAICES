<?php 
    if(!$_SESSION){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    if(!isset($inicio)){
        $inicio = false;
    }
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienes Raices</title>
        <link rel="stylesheet" href="../build/css/app.css">
    </head>
    <body>
        <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                    </a>
                    <div class="mobile-menu">
                        <img class="icono-menu" src="/build/img/barras.svg" alt="icono menu responsive">
                    </div>
                    <div class="derecha">
                        <img src="/build/img/dark-mode.svg" alt="boton para dark mode" class="dark-mode-boton">
                        <nav class="navegacion">
                            <a href="/nosotros">Nosotros</a>
                            <a href="/anuncios">Anuncios</a>
                            <a href="/blog">Blog</a>
                            <a href="/contacto">Contacto</a>
                            <?php if($auth){ ?>
                                <a href="/logout">Cerrar Sesión</a>
                            <?php } ?>
                        </nav>
                    </div>
                </div>
                <?php if($inicio){ ?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujos</h1>
                <?php } ?>
            </div>
        </header>
        
        <?php echo $contenido; ?>

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/anuncios">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>
            
            <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
        </footer>
        <script src="../build/js/bundle.min.js"></script>
    </body>
</html>