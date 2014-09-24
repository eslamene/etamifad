SELECT sales_order.Customer_NO
FROM sales_order
LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
LEFT JOIN customers ON sales_order.Customer_NO = customers.Customer_NO
WHERE customers.Customer_NO IS NULL GROUP BY sales_order.Customer_NO

