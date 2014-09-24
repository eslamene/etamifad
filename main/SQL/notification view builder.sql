SET @ID:=0;

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Sales - Sales Order - New Request' AS Note 
FROM sales_order 
WHERE Approve = ''

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Sales - Sales Order - Rejected' AS Note 
FROM sales_order 
WHERE Approve = 'Rejected' or Approve = 'Pending'

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Sales - Sales Order - Archived' AS Note 
FROM sales_order 
WHERE Approve != 'Hidden'

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Sales / Distribution - Sales Order - Sent / Received' AS Note 
FROM sales_order
LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO 
LEFT JOIN customers ON sales_order.Customer_NO = customers.Customer_NO 
WHERE sales_order_lines.ATD =1 AND sales_order_lines.Delivery_Date_Start =''

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Sales / Warehouse- Sales Order - Available to Delivery' AS Note 
FROM sales_order 
LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available !=0 AND sales_order_lines.ATD !=1
UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Sales / Distribution - Sales Order - Delivery - Planned' AS Note 
FROM sales_order 
LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO 
LEFT JOIN customers ON sales_order.Customer_NO = customers.Customer_NO 
WHERE sales_order_lines.ATD =1 AND sales_order_lines.Delivery_Date_Start !=''

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Warehouse - Sales Order - New' AS Note 
FROM sales_order 
LEFT JOIN sales_order_lines on sales_order.LPO_NO = sales_order_lines.LPO_NO
WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available =0 AND sales_order_lines.Delivered_Quantities =0  AND sales_order_lines.Notes_Warehouse =''

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Warehouse - Sales Order - Available to Promise' AS Note 
FROM sales_order 
LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available + sales_order_lines.Delivered_Quantities < sales_order_lines.Quantity

UNION ALL

SELECT @ID:=@ID+1 AS ID, COUNT(*) AS COUNT, @Note:='Distribution - Sales Order - Delivery - New' AS Note 
FROM sales_order
LEFT JOIN sales_order_lines on sales_order.LPO_NO = sales_order_lines.LPO_NO 
LEFT JOIN customers on sales_order.Customer_NO = customers.Customer_NO 
WHERE sales_order_lines.ATD =1 and sales_order_lines.Delivery_Date_Start =''