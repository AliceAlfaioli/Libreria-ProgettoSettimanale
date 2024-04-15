<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Libreria</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background-image: url('https://img.pixers.pics/pho_wat(s3:700/FO/99/32/23/9/700_FO9932239_2b36bee09991338ee4cd4d9cfe53eb13.jpg,700,415,cms:2018/10/5bd1b6b8d04b8_220x50-watermark.png,over,480,365,jpg)/carte-da-parati-pile-di-libri-antichi-in-un-angolo-di-uno-sfondo-grunge.jpg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; 
        }
        .container {
            margin-top: 50px;
            padding: 20px; 
        }
        h2 {
            margin-bottom: 10px;
            
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        form {
            margin-top: 20px;
            max-width: 500px;
            margin-left: auto; 
            margin-right: auto; 
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">𝐿𝒶 𝐿𝒾𝒷𝓇𝑒𝓇𝒾𝒶 𝒹𝑒𝓁𝓁𝑒 𝑀𝑒𝓇𝒶𝓋𝒾𝑔𝓁𝒾𝑒 📖</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Aggiungi Libro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Modifica Libro</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>𝐿𝒶 𝐿𝒾𝒷𝓇𝑒𝓇𝒾𝒶 𝒹𝑒𝓁𝓁𝑒 𝑀𝑒𝓇𝒶𝓋𝒾𝑔𝓁𝒾𝑒 📚</h2>

        <h3>Aggiungi un nuovo libro:</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="titolo">Titolo:</label>
                <input type="text" id="titolo" name="titolo" class="form-control">
            </div>
            <div class="form-group">
                <label for="autore">Autore:</label>
                <input type="text" id="autore" name="autore" class="form-control">
            </div>
            <div class="form-group">
                <label for="anno">Anno di pubblicazione:</label>
                <input type="number" id="anno" name="anno" class="form-control">
            </div>
            <div class="form-group">
                <label for="genere">Genere:</label>
                <input type="text" id="genere" name="genere" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>

        <?php
$conn = mysqli_connect("localhost", "root", "", "gestione_libreria");

if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remove_id'])) {
        $id = $_POST['remove_id'];

        $query = "DELETE FROM libri WHERE id=$id";

        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success'>Libro rimosso con successo!</div>";
        } else {
            echo "<div class='alert alert-danger'>Errore durante la rimozione del libro: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Si è verificato un errore durante la rimozione del libro.</div>";
    }
}
?>


<form method="post" action="">
    <input type="hidden" name="remove_id" id="remove_id">
</form>

<script>
function removeBook(id) {
    if (confirm("Sei sicuro di voler rimuovere questo libro?")) {
        document.getElementById("remove_id").value = id;
        document.forms[0].submit();
    }
}
</script>


<?php
$query = "SELECT * FROM libri";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Libri disponibili:</h3>"; 
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><strong>Titolo:</strong> {$row['titolo']}, <strong>Autore:</strong> {$row['autore']}, <strong>Anno di pubblicazione:</strong> {$row['anno_pubblicazione']}, <strong>Genere:</strong> {$row['genere']} 
            <button class='btn btn-info btn-sm' onclick='removeBook({$row['id']})'>Rimuovi</button>
            <a href='modifica_libro.php?id={$row['id']}' class='btn btn-info btn-sm'>Modifica</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nessun libro disponibile.</p>";
    }
} else {
    echo "<div class='alert alert-danger'>Errore nella query: " . mysqli_error($conn) . "</div>";
}

mysqli_close($conn);
?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
