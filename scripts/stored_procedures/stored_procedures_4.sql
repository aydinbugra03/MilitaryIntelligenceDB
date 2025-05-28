DELIMITER //

DROP PROCEDURE IF EXISTS ReserveVehicle//
DROP PROCEDURE IF EXISTS UpdateVehicleStatus//

CREATE PROCEDURE ReserveVehicle(
    IN p_base_id INT,
    IN p_vehicle_type VARCHAR(50)
)
BEGIN
    DECLARE v_vehicle_id INT;
    
    -- Select an available vehicle from the specified base and type
    SELECT vehicle_id INTO v_vehicle_id
    FROM vehicles
    WHERE base_id = p_base_id
      AND type = p_vehicle_type
      AND operational_status = 'Active'
    LIMIT 1;
    
    IF v_vehicle_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No available vehicle found for reservation.';
    ELSE
        -- Update the vehicle status to 'Reserved'
        UPDATE vehicles
        SET operational_status = 'Reserved'
        WHERE vehicle_id = v_vehicle_id;
        
        SELECT CONCAT('Vehicle ', v_vehicle_id, ' reserved successfully.') AS message;
    END IF;
END//

CREATE PROCEDURE UpdateVehicleStatus(
    IN p_vehicle_id INT,
    IN p_new_status VARCHAR(50)
)
BEGIN
    DECLARE v_old_status VARCHAR(50);
    DECLARE v_vehicle_exists INT DEFAULT 0;
    
    -- Check if vehicle exists
    SELECT COUNT(*) INTO v_vehicle_exists
    FROM vehicles 
    WHERE vehicle_id = p_vehicle_id;
    
    -- If vehicle doesn't exist, signal error
    IF v_vehicle_exists = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Vehicle not found';
    END IF;
    
    -- Get current status in separate query
    SELECT operational_status INTO v_old_status
    FROM vehicles 
    WHERE vehicle_id = p_vehicle_id;
    
    -- Update vehicle status
    UPDATE vehicles 
    SET operational_status = p_new_status 
    WHERE vehicle_id = p_vehicle_id;
    
    -- Log the status change in vehicle_status_log table
    INSERT INTO vehicle_status_log (vehicle_id, old_status, new_status, change_date)
    VALUES (p_vehicle_id, v_old_status, p_new_status, NOW());
    
    -- Also log in vehiclestatuslog table
    INSERT INTO vehiclestatuslog (vehicle_id, old_status, new_status, change_date, change_reason)
    VALUES (p_vehicle_id, v_old_status, p_new_status, NOW(), CONCAT('Status changed from ', v_old_status, ' to ', p_new_status));
    
    SELECT CONCAT('Vehicle ', p_vehicle_id, ' status updated from ', v_old_status, ' to ', p_new_status) AS message;
    
END//

DELIMITER ;
