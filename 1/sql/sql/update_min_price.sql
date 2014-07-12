-- 修改每个收费项目的价格。

update shop_product_price_item
,
(
SELECT item_id, MIN( adult_price ) as min_price
FROM  `shop_product_price_detail` 
WHERE inventory >0
AND price_date >20140531
GROUP BY item_id
) s
set  shop_product_price_item.min_price = s.min_price
where shop_product_price_item.id=s.item_id;

-- 修改商品价格
insert into shop_product_view_info(pid, min_price)
SELECT pid, MIN( min_price ) as min_price
FROM  `shop_product_price_item` 
GROUP BY pid
on duplicate key update min_price = values(min_price);