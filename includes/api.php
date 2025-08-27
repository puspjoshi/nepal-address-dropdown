<?php
require_once '../config/Database.php';

class AddressApi {
    private $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getConnection();
    }

    public function getProvinces() {
        $query = "SELECT * FROM provinces where deleted_at is Null";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCities($province_id) {
        $query = "SELECT * 
                FROM cities 
                WHERE province_id = :province_id 
                AND deleted_at IS NULL";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':province_id', $province_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getZones($city_id) {
        $query = "SELECT * 
                FROM zones 
                WHERE city_id = :city_id 
                AND deleted_at IS NULL";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>