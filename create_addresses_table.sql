-- Create addresses table for SQLite
-- Run this SQL directly in your database if migration command doesn't work

CREATE TABLE IF NOT EXISTS "addresses" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_id" INTEGER NOT NULL,
    "recipient_name" VARCHAR(255) NOT NULL,
    "mobile" VARCHAR(11) NOT NULL,
    "province" VARCHAR(255) NOT NULL,
    "city" VARCHAR(255) NOT NULL,
    "address" TEXT NOT NULL,
    "postal_code" VARCHAR(10) NOT NULL,
    "is_default" TINYINT(1) DEFAULT 0 NOT NULL,
    "created_at" DATETIME,
    "updated_at" DATETIME,
    CONSTRAINT "addresses_user_id_foreign" 
        FOREIGN KEY("user_id") 
        REFERENCES "users"("id") 
        ON DELETE CASCADE
);

-- Create index for better performance
CREATE INDEX IF NOT EXISTS "addresses_user_id_is_default_index" 
    ON "addresses" ("user_id", "is_default");

-- Insert migration record to prevent re-running
INSERT INTO "migrations" ("migration", "batch") 
VALUES ('2026_11_21_120000_create_addresses_table', 
        (SELECT COALESCE(MAX(batch), 0) + 1 FROM "migrations"));

-- Verify table creation
SELECT 'Table created successfully!' as result;
SELECT COUNT(*) as total_addresses FROM addresses;
