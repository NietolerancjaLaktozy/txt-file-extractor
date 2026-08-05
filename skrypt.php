<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txt extractor</title>
</head>
<body>

    <h1>Txt extractor</h1>
    <form method="post" enctype="multipart/form-data">
		
		<label for="string">Wpisz szukany tekst:</label><br>
        <input type="text" id="string" name="string"><br><br>

        <input type="submit" value="Wyślij">

    </form>
	
	<?php
		if (isset($_GET['wynik'])) {
		echo "<p>Przeniesiono " . (int)$_GET['wynik'] . " linii do pliku wynikowego.</p>";
		}
	?>
	
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//  USTAWIENIA 
	$inputFile = "wejscie.txt";     
	$outputFile = "wynik.txt";   
	$searchString = $_POST["string"]; 

	// SPRAWDZENIE CZY PLIK ISTNIEJE 
	if (!file_exists($inputFile)) {
		die("Plik wejściowy nie istnieje.");
	}

	// WCZYTANIE PLIKU
	$lines = file($inputFile);

	// TABLICE 
	$matchedLines = [];   // linie do zapisania
	$remainingLines = []; // linie które zostają w pliku wejściowym

	// PRZETWARZANIE 
	foreach ($lines as $line) {
		if (strpos($line, $searchString) !== false) {
			$matchedLines[] = $line;
		} else {
			$remainingLines[] = $line;
		}
	}

	// ZAPIS WYNIKU
	file_put_contents($outputFile, implode("", $matchedLines));

	// NADPISANIE PLIKU WEJŚCIOWEGO
	file_put_contents($inputFile, implode("", $remainingLines));

	header("Location: " . $_SERVER['PHP_SELF'] . "?wynik=" . count($matchedLines));
	exit;
}
?>

</body>
</html>