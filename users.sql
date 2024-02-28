DELIMITER $$

CREATE PROCEDURE GenerateProducts()
BEGIN
    DECLARE i INT DEFAULT 1;
    WHILE i <= 200 DO
            INSERT INTO products (product_name, created_at, updated_at, user_id) VALUES
                (CONCAT('Product', i), NOW(), NOW(), 1);
            SET i = i + 1;
        END WHILE;
END $$

DELIMITER ;

CALL GenerateProducts();
