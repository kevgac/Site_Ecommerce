<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023132104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_line DROP INDEX UNIQ_70BE1A7BC023F51C, ADD INDEX IDX_70BE1A7BC023F51C (sales_order_id)');
        $this->addSql('ALTER TABLE command_line ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_70BE1A7B4584665A ON command_line (product_id)');
        $this->addSql('ALTER TABLE delivery ADD sales_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10C023F51C FOREIGN KEY (sales_order_id) REFERENCES sales_order (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10C023F51C ON delivery (sales_order_id)');
        $this->addSql('ALTER TABLE order_address MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON order_address');
        $this->addSql('ALTER TABLE order_address DROP id, CHANGE sales_order_id sales_order_id INT NOT NULL, CHANGE address_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_address ADD PRIMARY KEY (sales_order_id, address_id)');
        $this->addSql('ALTER TABLE product_cart MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON product_cart');
        $this->addSql('ALTER TABLE product_cart ADD product_id INT NOT NULL, ADD cart_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE product_cart ADD CONSTRAINT FK_864BAA164584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_cart ADD CONSTRAINT FK_864BAA161AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_864BAA164584665A ON product_cart (product_id)');
        $this->addSql('CREATE INDEX IDX_864BAA161AD5CDBF ON product_cart (cart_id)');
        $this->addSql('ALTER TABLE product_cart ADD PRIMARY KEY (product_id, cart_id)');
        $this->addSql('ALTER TABLE user_address MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON user_address');
        $this->addSql('ALTER TABLE user_address DROP id, CHANGE user_id user_id INT NOT NULL, CHANGE address_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_address ADD PRIMARY KEY (user_id, address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_address ADD id INT AUTO_INCREMENT NOT NULL, CHANGE sales_order_id sales_order_id INT DEFAULT NULL, CHANGE address_id address_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10C023F51C');
        $this->addSql('DROP INDEX IDX_3781EC10C023F51C ON delivery');
        $this->addSql('ALTER TABLE delivery DROP sales_order_id');
        $this->addSql('ALTER TABLE product_cart DROP FOREIGN KEY FK_864BAA164584665A');
        $this->addSql('ALTER TABLE product_cart DROP FOREIGN KEY FK_864BAA161AD5CDBF');
        $this->addSql('DROP INDEX IDX_864BAA164584665A ON product_cart');
        $this->addSql('DROP INDEX IDX_864BAA161AD5CDBF ON product_cart');
        $this->addSql('ALTER TABLE product_cart ADD id INT AUTO_INCREMENT NOT NULL, DROP product_id, DROP cart_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE command_line DROP INDEX IDX_70BE1A7BC023F51C, ADD UNIQUE INDEX UNIQ_70BE1A7BC023F51C (sales_order_id)');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B4584665A');
        $this->addSql('DROP INDEX IDX_70BE1A7B4584665A ON command_line');
        $this->addSql('ALTER TABLE command_line DROP product_id');
        $this->addSql('ALTER TABLE user_address ADD id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE address_id address_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
