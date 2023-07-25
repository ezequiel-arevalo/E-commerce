<div class="Vista-Title">
    <h2>Contacto</h2>
    <p>Gracias por visitar nuestro sitio.</p>
</div>

<div id="Contacto-Container">
    <form method="post" action="gracias.php" id="Form-container">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" id="contacto-btn">Enviar</button>
        </div>
    </form>
</div>
