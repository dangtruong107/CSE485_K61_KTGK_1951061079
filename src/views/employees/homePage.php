<?php
//file hiển thị thông báo lỗi
require_once 'views/error/error.php';
?>

<h1>HIỂN THỊ DANH SÁCH CÁC NHÂN VIÊN</h1>
<br>

<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>Mã nhân viên</th>
        <th>Họ và tên</th>
        <th>Chức vụ</th>
        <th>Phòng ban</th>
        <th>Lương</th>
        <th>Ngày vào làm</th>
    </tr>
    <?php if (!empty($employees)): ?>      
        <?php foreach ($employees AS $employee) : ?>
            <tr>
                <td><?php echo $employee['manv'] ?></td>
                <td><?php echo $employee['hovaten'] ?></td>
                <td><?php echo $employee['chucvu'] ?></td>
                <td><?php echo $employee['phongban'] ?></td>
                <td><?php echo $employee['luong'] ?></td>
                <td><?php echo $employee['ngayvaolam'] ?></td>                
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">Không có dữ liệu</td>
        </tr>
    <?php endif; ?>
</table>