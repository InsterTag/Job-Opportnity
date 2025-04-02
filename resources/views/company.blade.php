<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Compañía</title>
</head>
<body>
    
    <h1>Formulario de Compañía</h1>

    <form action="{{ route('company.ss') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>
            Nombre de la Compañía:
            <br>
            <input type="text" name="name" required>
        </label>
        <br><br>

        <label>
            Descripción:
            <br>
            <textarea name="description" required></textarea>
        </label>
        <br><br>

        <label>
            Ubicación:
            <br>
            <input type="text" name="location" required>
        </label>
        <br><br>

        <label>
            Tipo de Compañía:
            <br>
            <input type="text" name="type_of_company" required>
        </label>
        <br><br>

        <label>
            Contacto:
            <br>
            <input type="text" name="contact" required>
        </label>
        <br><br>

        <label>
            Dirección:
            <br>
            <input type="text" name="address" required>
        </label>
        <br><br>

        <label>
            Correo Electrónico:
            <br>
            <input type="email" name="email" required>
        </label>
        <br><br>

        <button type="submit">Enviar Formulario</button>
    </form>

</body>
</html>