<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        -- Create trigger to update articles quantity based on status
CREATE TRIGGER before_insert_article 
BEFORE INSERT ON articles
FOR EACH ROW
BEGIN
    DECLARE updatedQuantity INT;
    IF NEW.status = \'sortie\' THEN
        SET updatedQuantity = (SELECT quantity - NEW.quantity FROM articles WHERE ref = NEW.ref AND name = NEW.name);
    ELSE
        SET updatedQuantity = (SELECT quantity + NEW.quantity FROM articles WHERE ref = NEW.ref AND name = NEW.name);
    END IF;

    IF updatedQuantity IS NOT NULL THEN
        UPDATE articles
        SET quantity = updatedQuantity
        WHERE ref = NEW.ref AND name = NEW.name;
    END IF;
END;


CREATE TRIGGER after_insert_article AFTER INSERT ON articles
FOR EACH ROW
BEGIN
    IF NEW.quantity < 10 THEN
        INSERT INTO low_quantities (ref, name, quantity)
        VALUES (NEW.ref, NEW.name, NEW.quantity);
    END IF;
END;


CREATE TRIGGER after_update_article AFTER UPDATE ON articles
FOR EACH ROW
BEGIN
    IF NEW.quantity >= 10 THEN
        DELETE FROM low_quantities 
        WHERE ref = NEW.ref AND name = NEW.name;
    END IF;
END;

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_low_quantity_articles');
    }
};
