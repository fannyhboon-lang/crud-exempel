<?php

function addMovie($namn, $beskrivning, $datum, $kategori, $pdo) { 
	try {
		$stmt = $pdo->prepare("INSERT INTO filmer (namn, beskrivning, datum, kategori) VALUES (:namn, :beskrivning, :datum, :kategori)");
		$stmt->bindParam(':namn', $namn, PDO::PARAM_STR);
		$stmt->bindParam(':beskrivning', $beskrivning, PDO::PARAM_STR);
		$stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
		$stmt->bindParam(':kategori', $kategori, PDO::PARAM_STR);
		return $stmt->execute();
	} catch (PDOException $e) {
		return false;
	}
}

function updateMovie($id, $namn, $beskrivning, $datum, $kategori,  $pdo)
{
    try {
        $stmt = $pdo->prepare("UPDATE filmer
             SET namn = :namn,
                 beskrivning = :beskrivning,
                 datum = :datum,
                 kategori = :kategori
             WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':namn', $namn, PDO::PARAM_STR);
        $stmt->bindParam(':beskrivning', $beskrivning, PDO::PARAM_STR);
        $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
        $stmt->bindParam(':kategori', $kategori, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function deleteMovie($id, $pdo)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM filmer WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}


?>