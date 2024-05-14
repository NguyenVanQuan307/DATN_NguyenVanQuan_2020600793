<?php
include "connect_db.php";

$result = mysqli_query($con, "SELECT * FROM `product`");
 
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=product_data.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('Tên sản phẩm', 'Giá cũ', 'Giá mới', 'Tồn kho', 'Ngày cập nhật', 'Ngày tạo'));

while ($row = mysqli_fetch_assoc($result)) {
    $formatted_row = array(
        $row['name'],
        number_format($row['price'], 0, ',', '.') . ' dong',
        number_format($row['price_new'], 0, ',', '.') . ' dong',
        $row['quantity'],
        date('d/m/Y H:i', $row['last_updated']),
        date('d/m/Y H:i', $row['created_time'])
    );
    fputcsv($output, $formatted_row);
}

fclose($output);
