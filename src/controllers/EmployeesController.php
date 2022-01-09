<?php
require_once 'models/Employees.php';


class EmployeesController { // ----

    // la nhung action
    public function index() {   // ok
        echo "<h1>Hiển thị danh sách các nhân viên!</h1>";
        $employee = new NHANVIEN(); // tu model
        $employees = $employee->index(); // truyen sang view index trang chu
        require_once 'views/employees/index.php';
    }

    public function add() { // okokokokok
        $error = '';
        //xử lý submit form
        if (isset($_POST['submit'])) {

            $hovaten = $_POST['hovaten'];
            $chucvu = $_POST['chucvu'];
            $phongban = $_POST['phongban'];
            $luong = $_POST['luong'];
            $ngayvaolam = $_POST['ngayvaolam'];

            //gọi model để insert dữ liệu vào database
            $employee = new NHANVIEN();
            //gọi phương thức để insert dữ liệu
            //nên tạo 1 mảng tạm để lưu thông tin của
//                đối tượng dựa theo cấu trúc bảng
            $employeeArr = [
                'hovaten' => $hovaten,
                'chucvu' => $chucvu,
                'phongban' => $phongban,
                'luong' => $luong,
                'ngayvaolam' => $ngayvaolam
            ];
            $isInsert = $employee->insert($employeeArr);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm mới thành công";
            }
            else {
                $_SESSION['error'] = "Thêm mới thất bại";
            }
            header("Location: index.php?controller=employee&action=index");
            exit();

        }
        //gọi view
        require_once 'views/employees/addEmployee.php';
    }
    public function detail() { // ok
        $employee = new NHANVIEN(); // tu model
        $employees = $employee->index(); // truyen sang view index trang chu
        require_once 'views/employees/homePage.php';
    }
    public function edit() {
        //lấy ra thông tin sách dựa theo id đã gắn trên url
        //xử lý validate cho trường hợp id truyền lên không hợp lệ
        if (!isset($_GET['manv'])) {
            $_SESSION['error'] = "Tham số không hợp lệ";
            header("Location: index.php?controller=employee&action=index");
            return;
        }
        if (!is_numeric($_GET['manv'])) {
            $_SESSION['error'] = "Id phải là số";
            header("Location: index.php?controller=employee&action=index");
            return;
        }
        $magv = $_GET['manv'];
        //gọi model để lấy ra đối tượng sách theo id
        $employeeModel = new NHANVIEN();
        $employee = $employeeModel->getEmployeesById($manv); // lay sach theo id nhan duoc tu GET

        //xử lý submit form, lặp lại thao tác khi submit lúc thêm mới
        $error = '';
        if (isset($_POST['submit'])) {
            $hovaten = $_POST['hovaten'];
            $chucvu = $_POST['chucvu'];
            $phongban = $_POST['phongban'];
            $luong = $_POST['luong'];
            $ngayvaolam = $_POST['ngayvaolam'];
            //xử lý update dữ liệu vào hệ thống
            $employeeModel = new NHANVIEN();
            $employeeArr = [
                'hovaten' => $hovaten,
                'chucvu' => $chucvu,
                'phongban' => $phongban,
                'luong' => $luong,
                'ngayvaolam' => $ngayvaolam,
            ];
            $isUpdate = $teacherModel->update($employeeArr); // sai
            if ($isUpdate) {
                $_SESSION['success'] = "Update bản ghi #$manv thành công";
            }
            else { // nhay vao day
                $_SESSION['error'] = "Update bản ghi #$manv thất bại";
            }
            header("Location: index.php?controller=employee&action=index");
            exit();
        }
        //truyền ra view
        require_once 'views/employees/editEmployee.php';
    }

    public function delete() 
        //bắt id từ trình duyêt
        $manv = $_GET['manv'];
        if (!is_numeric($manv)) {
            header("Location: index.php?controller=employee&action=index");
            exit();
        }

        $id = new NHANVIEN();
        $isDelete = $id->delete($manv);

        if ($isDelete) {
            //chuyển hướng về trang liệt kê danh sách
            //tạo session thông báo mesage
            $_SESSION['success'] = "Xóa bản ghi #$manv thành công";
        }
        else {
            //báo lỗi
            $_SESSION['error'] = "Xóa bản ghi #$manv thất bại";
        }
        header("Location: index.php?controller=employee&action=index");
        exit();
    }
}
