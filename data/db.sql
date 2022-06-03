

CREATE TABLE IF NOT EXISTS `contacts` (
    ID INT NOT NULL AUTO_INCREMENT,
    contact_id INT NOT NULL,
    contact_email VARCHAR(320) NOT NULL,
    temp_email_1 VARCHAR(320),
    temp_email_2 VARCHAR(320),
    temp_email_3 VARCHAR(320),
    temp_email_4 VARCHAR(320),
    temp_email_5 VARCHAR(320),
    PRIMARY KEY (ID)
);
