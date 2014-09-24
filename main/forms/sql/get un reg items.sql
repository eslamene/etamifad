SELECT sales_order_lines.Item_Code
FROM sales_order
LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
LEFT JOIN items ON sales_order_lines.Item_Code = items.Item_Code
WHERE items.Item_Code IS NULL GROUP BY sales_order_lines.Item_Code