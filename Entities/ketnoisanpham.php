<?php IDEA:
require_once("./Config/db.php");

class Sanpham{



    public static function list_sanphamdacbiet(){
        $db = new Db();
        $sql = "SELECT * FROM SanPham order by MaDongHo DESC LIMIT 6";
        $result = $db->select_to_array($sql);
        return $result;
    }
    public static function list_chitietsanpham(){
        $db = new Db();
        $MaDongHo = $_GET['MaDongHo'];
        $sql1 = "SELECT * FROM SanPham WHERE MaDongHo = MaDongHo";
        $resultt = $db->select_to_array($sql1);
        return $resultt;
    }
}

class Nhasanxuat{
    public static function list_nhasanxuat(){
        $db = new Db();
        $sql = "SELECT * FROM TenNSX ";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
?>