<?php

namespace modeles;
use PDO;

require_once 'Database.php';
class Emprunt
{

    private $id_client;
    private $id_livre;
    private $date_pret;
    private $date_retour;

    public function __construct( $id_client, $id_livre, $date_pret, $date_retour)
    {
        $this->id_client = $id_client;
        $this->id_livre = $id_livre;
        $this->date_pret = $date_pret;
        $this->date_retour = $date_retour;
    }

    public function getIdClient()
    {
        return $this->id_client;
    }

    public function getIdLivre()
    {
        return $this->id_livre;
    }

    public function getDatepret()
    {
        return $this->date_pret;
    }

    public function getDateRetour()
    {
        return $this->date_retour;
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM pret WHERE id_client = ? and id_livre = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Emprunt($row['id_client'], $row['id_livre'], $row['date_pret'], $row['date_retour']);
        }

        return null;
    }

    public function save()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE pret SET id_client = ?, id_livre = ?, date_pret = ?, date_retour = ? WHERE id_client = ? and id_livre = ?");
        $stmt->execute([$this->id_client, $this->id_livre, $this->date_pret, $this->date_retour, $this->id_client, $this->id_livre]);
    }

    public function delete()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM pret WHERE id_client = ? and id_livre = ?");
        $stmt->execute([$this->id_client, $this->id_livre]);
    }
    public static function getEmpruntsByClient($id_client) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM pret WHERE id_client = ?");
        $stmt->execute([$id_client]);
        $prets = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prets[] = new Emprunt($row['id_emprunt'], $row['date_emprunt'], $row['date_retour'], $row['id_client'], $row['id_livre']);
        }

        return $prets;
     }

    public static function getEmpruntsByLivre($id_livre) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM pret WHERE id_livre = ?");
        $stmt->execute([$id_livre]);
        $prets = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prets[] = new Emprunt($row['id_emprunt'], $row['date_emprunt'], $row['date_retour'], $row['id_client'], $row['id_livre']);
        }

        return $prets;
    }
    public static function getAll()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM pret");
        $prets = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prets[] = new Emprunt($row['id_pret'], $row['id_client'], $row['id_livre'], $row['date_pret'], $row['date_retour']);
        }

        return $prets;
    }
}
