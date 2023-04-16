<?php

namespace modeles;
use PDO;

require_once 'Database.php';

class Livre
{
    private $id_livre;
    private $titre;
    private $auteur;
    private $isbn;
    private $date_publication;


    public function __construct($id_livre, $titre, $auteur, $isbn, $date_publication)
    {
        $this->id_livre = $id_livre;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->isbn = $isbn;
        $this->date_publication = $date_publication;
    }

    public function getIdLivre()
    {
        return $this->id_livre;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getDatePublication()
    {
        return $this->date_publication;
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM livre WHERE id_livre = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Livre($row['id_livre'], $row['titre'], $row['auteur'], $row['isbn'], $row['date_publication']);
        }

        return null;
    }

    public function save()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE livre SET titre = ?, auteur = ?, description = ?, date_pub = ? WHERE id_livre = ?");
        $stmt->execute([$this->titre, $this->auteur, $this->isbn, $this->date_publication, $this->id_livre]);
    }

    public function delete()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM livre WHERE id_livre = ?");
        $stmt->execute([$this->id_livre]);
    }

    public static function getAll()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM livre");
        $livres = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $livres[] = new Livre($row['id_livre'], $row['titre'], $row['auteur'], $row['isbn'], $row['date_publication']);
        }

        return $livres;
    }
    public function add()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO livre (titre, auteur, isbn, date_publication) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->titre, $this->auteur, $this->isbn, $this->date_publication]);
        $this->id_livre = $conn->lastInsertId();
    }
}
