<?php
$conn = mysqli_connect("localhost", "root", "", "gestione_libreria");

if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['titolo']) && isset($_POST['autore']) && isset($_POST['anno']) && isset($_POST['genere'])) {
        $id = $_POST['id'];
        $titolo = $_POST['titolo'];
        $autore = $_POST['autore'];
        $anno = $_POST['anno']; 
        $genere = $_POST['genere'];

        $query = "UPDATE libri SET titolo='$titolo', autore='$autore', anno_pubblicazione='$anno', genere='$genere' WHERE id=$id";

        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success'>Dettagli del libro aggiornati con successo!</div>";
        } else {
            echo "<div class='alert alert-danger'>Errore durante l'aggiornamento dei dettagli del libro: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Per favore, compila tutti i campi del form.</div>";
    }
}

// Recupera i dettagli del libro
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM libri WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_assoc($result);
} else {
    echo "<div class='alert alert-danger'>ID del libro non specificato.</div>";
}
?>

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
            margin-bottom: 20px;
            
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
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
    <div class="form-group">
        <label for="titolo">Titolo:</label>
        <input type="text" id="titolo" name="titolo" class="form-control" value="<?php echo $book['titolo']; ?>">
    </div>
    <div class="form-group">
        <label for="autore">Autore:</label>
        <input type="text" id="autore" name="autore" class="form-control" value="<?php echo $book['autore']; ?>">
    </div>
    <div class="form-group">
        <label for="anno">Anno di pubblicazione:</label>
        <input type="number" id="anno" name="anno" class="form-control" value="<?php echo $book['anno_pubblicazione']; ?>">
    </div>
    <div class="form-group">
        <label for="genere">Genere:</label>
        <input type="text" id="genere" name="genere" class="form-control" value="<?php echo $book['genere']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
</form>

<?php mysqli_close($conn); ?>
