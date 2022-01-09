<h1>
    Thêm nhân viên
</h1>

<!--</form>-->
<div style="color: red">
    <?php echo $error; ?>
</div>
<form method="post" action="">
    Họ và tên :
    <input type="text" name="hovaten" value="" />
    <br />

    Chức vụ :
    <input type="text" name="chucvu" value="" />
    <br />

    Phòng ban :
    <input type="text" name="phongban" value="" />
    <br />
    
    Lương : 
    <input type="text" name="luong" value="" />
    <br />

    Ngày vào làm :
    <input type="text" name="chuyenmon" value="" />
    <br />
    <input type="submit" name="submit" value="Save" />
</form>
