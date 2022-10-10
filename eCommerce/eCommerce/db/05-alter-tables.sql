-- ALTER TABLE tbl_orderdetails AUTO_INCREMENT = 1;
-- ALTER TABLE tbl_order AUTO_INCREMENT = 1;

SELECT SUM(od.orderdetails_total) FROM tbl_orderdetails AS od INNER JOIN tbl_order AS o ON od.orderdetails_id = o.orderdetails_id WHERE o.order_status = 'pending payment';