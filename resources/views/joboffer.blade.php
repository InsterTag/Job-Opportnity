<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Oferta de Trabajo</title>
</head>
<body>
    
    <h1>Formulario de Oferta de Trabajo</h1>

    <form action="{{ route('joboffer.ss') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>
            Título de la Oferta:
            <br>
            <input type="text" name="title" required>
        </label>
        <br><br>

        <label>
            Descripción:
            <br>
            <textarea name="description" required></textarea>
        </label>
        <br><br>

        <label>
            Requisitos:
            <br>
            <textarea name="requirements" required></textarea>
        </label>
        <br><br>

        <label>
            Salario:
            <br>
            <input type="number" name="salary" required>
        </label>
        <br><br>

        <label>
            Fecha de Publicación:
            <br>
            <input type="date" name="publication_date" required>
        </label>
        <br><br>

        <label>
            Fecha de Finalización:
            <br>
            <input type="date" name="completion_date" required>
        </label>
        <br><br>

        <button type="submit">Enviar Formulario</button>
    </form>

</body>
</html>