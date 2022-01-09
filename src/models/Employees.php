<?php
require_once 'configs/connect.php';
class Employees {
    public $manv;
    public $hovaten;
    public $chucvu;
    public $phongban;
    public $luong;
    public $ngayvaolam;

  
    public function insert($param = []) {
        $connection = $this->connectDb();
        $queryInsert = "INSERT INTO nhanvien (hovaten, chucvu, phongban, luong, ngayvaolam) 
        VALUES ('{$param['hovaten']}', '{$param['chucvu']}', '{$param['phongban']}', '{$param['luong']}', '{$param['ngayvaolam']}')";

        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeDb($connection);

        return $isInsert;
    }

    public function getEmployeesById($manv = null) {
        $connection = $this->connectDb();
        $querySelect = "SELECT * FROM nhanvien WHERE manv=$manv";

        $results = mysqli_query($connection, $querySelect);
        $teacher = [];

        if (mysqli_num_rows($results) > 0) {
            $employees = mysqli_fetch_all($results, MYSQLI_ASSOC);
            $employee = $employees[0];
        }
        $this->closeDb($connection);

        return $employee;
    }

    public function index() {
        $connection = $this->connectDb();
        $querySelect = "SELECT * FROM nhanvien";
        $results = mysqli_query($connection, $querySelect);
        $employees = [];
        if (mysqli_num_rows($results) > 0) {
            $employees = mysqli_fetch_all($results, MYSQLI_ASSOC);
        }
        $this->closeDb($connection);

        return $employees; 
    }

    public function update($employee = []) { 
        $connection = $this->connectDb();
        $queryUpdate = "UPDATE nhanvien
                    SET `hovaten` = '{$employee['hovaten']}', `chucvu` = '{$employee['chucvu']}',`phongban` = '{$employee['phongban']}',`luong` = '{$employee['luong']}',

                    `ngayvaolam` = '{$employee['ngayvaolam']}'
                    
                    WHERE `manv` = {$employee['manv']}";

        $isUpdate = mysqli_query($connection, $queryUpdate);
        $this->closeDb($connection);

        return $isUpdate;
    }

    public function delete($manv = null) {
        $connection = $this->connectDb();

        $queryDelete = "DELETE FROM nhanvien WHERE manv = $manv";
        $isDelete = mysqli_query($connection, $queryDelete);

        $this->closeDb($connection);

        return $isDelete;
    }
 
    public function connectDb() {
        $connection = mysqli_connect(DB_HOST,
            DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
        }

        return $connection;
    }

    public function closeDb($connection = null) {
        mysqli_close($connection);
    }
}