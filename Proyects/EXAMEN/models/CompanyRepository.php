<?php
class CompanyRepository {
    public static function getAllCompany(){
        try {
            $db = Connection::connect();
            $q = " SELECT * FROM company";
            $result = $db->query($q);
            $Companys = array();
        
            while ($row = $result->fetch_assoc()) {
                $company = new Company($row['nif'], $row['name'], $row['address'], $row['tutor'], $row['telephone'], $row['email']);
                $Companys[] = $company;
            }

            return $Companys;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getCompanyByNif(string $nif) : Company{
        try {
            $db = Connection::connect();
            $query = "SELECT * FROM company WHERE nif = '$nif' ";
            $result = $db->query($query);
            $data = $result->fetch_assoc();
            return new Company($data['nif'], $data['name'], $data['address'], $data['tutor'], $data['telephone'], $data['email']);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getUserByCompany(Company $company){
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM practice WHERE company_nif = {$company->getNif()}";
            $result = $db->query($q);
            $users = array();

            while ($row = $result->fetch_assoc()) {
                $users[] = new User($row['id'], $row['username'], $row['role']);
            }

            return $users;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function addCompany(string $nif, string $name, string $address, string $tutor, string $telephone, string $email){
        try {
            $db = Connection::connect();
            $q = "INSERT INTO company (nif, name, address, tutor, telephone, email) VALUES ('$nif','$name','$address','$tutor','$telephone','$email')";
            $db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function updateCompany(string $nif, string $name, string $address, string $tutor, string $telephone, string $email){
        try {
            $db = Connection::connect();
            $q = "UPDATE `company` SET `nif` = '$nif', `name` = '$name', `address` = '$address', `tutor` = '$tutor', `telephone` = '$telephone', `email` = '$email' WHERE `company`.`nif` = '$nif'";
            $db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteCompany(string $nif){
        try {
            $db = Connection::connect();
            $q = "DELETE FROM company WHERE `company`.`nif` = '$nif'";
            $db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}