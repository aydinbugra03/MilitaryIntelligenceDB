DELIMITER //

DROP PROCEDURE IF EXISTS OrderSupply//

CREATE PROCEDURE OrderSupply(
    IN p_supply_id INT,
    IN p_quantity INT
)
BEGIN
    DECLARE current_qty INT;
    DECLARE new_qty INT;
    
    -- Get current quantity
    SELECT quantity INTO current_qty FROM Supply WHERE supply_id = p_supply_id;
    
    -- Calculate new quantity after order
    SET new_qty = current_qty + p_quantity;
    
    -- Update supply quantity
    UPDATE Supply SET quantity = new_qty WHERE supply_id = p_supply_id;
    
    -- Return order confirmation
    SELECT 
        p_supply_id as supply_id,
        (SELECT sup_name FROM Supply WHERE supply_id = p_supply_id) as supply_name,
        current_qty as previous_quantity,
        p_quantity as ordered_quantity,
        new_qty as new_quantity,
        'Order completed successfully' as status,
        NOW() as order_date;
END//

DELIMITER ; 