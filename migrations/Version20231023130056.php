<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023130056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('ALTER TABLE command_line ADD sales_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BC023F51C FOREIGN KEY (sales_order_id) REFERENCES sales_order (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70BE1A7BC023F51C ON command_line (sales_order_id)');
        $this->addSql('ALTER TABLE order_address ADD sales_order_id INT DEFAULT NULL, ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_address ADD CONSTRAINT FK_FB34C6CAC023F51C FOREIGN KEY (sales_order_id) REFERENCES sales_order (id)');
        $this->addSql('ALTER TABLE order_address ADD CONSTRAINT FK_FB34C6CAF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_FB34C6CAC023F51C ON order_address (sales_order_id)');
        $this->addSql('CREATE INDEX IDX_FB34C6CAF5B7AF75 ON order_address (address_id)');
        $this->addSql('ALTER TABLE payement ADD sales_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A7885C023F51C FOREIGN KEY (sales_order_id) REFERENCES sales_order (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B20A7885C023F51C ON payement (sales_order_id)');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL, ADD taxes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD36D06393 FOREIGN KEY (taxes_id) REFERENCES taxes (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD36D06393 ON product (taxes_id)');
        $this->addSql('ALTER TABLE sales_order ADD cart_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sales_order ADD CONSTRAINT FK_36D222E1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE sales_order ADD CONSTRAINT FK_36D222EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36D222E1AD5CDBF ON sales_order (cart_id)');
        $this->addSql('CREATE INDEX IDX_36D222EA76ED395 ON sales_order (user_id)');
        $this->addSql('ALTER TABLE user_address ADD user_id INT DEFAULT NULL, ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_5543718BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_5543718BF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_5543718BA76ED395 ON user_address (user_id)');
        $this->addSql('CREATE INDEX IDX_5543718BF5B7AF75 ON user_address (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BC023F51C');
        $this->addSql('DROP INDEX UNIQ_70BE1A7BC023F51C ON command_line');
        $this->addSql('ALTER TABLE command_line DROP sales_order_id');
        $this->addSql('ALTER TABLE order_address DROP FOREIGN KEY FK_FB34C6CAC023F51C');
        $this->addSql('ALTER TABLE order_address DROP FOREIGN KEY FK_FB34C6CAF5B7AF75');
        $this->addSql('DROP INDEX IDX_FB34C6CAC023F51C ON order_address');
        $this->addSql('DROP INDEX IDX_FB34C6CAF5B7AF75 ON order_address');
        $this->addSql('ALTER TABLE order_address DROP sales_order_id, DROP address_id');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A7885C023F51C');
        $this->addSql('DROP INDEX UNIQ_B20A7885C023F51C ON payement');
        $this->addSql('ALTER TABLE payement DROP sales_order_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD36D06393');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD36D06393 ON product');
        $this->addSql('ALTER TABLE product DROP category_id, DROP taxes_id');
        $this->addSql('ALTER TABLE sales_order DROP FOREIGN KEY FK_36D222E1AD5CDBF');
        $this->addSql('ALTER TABLE sales_order DROP FOREIGN KEY FK_36D222EA76ED395');
        $this->addSql('DROP INDEX UNIQ_36D222E1AD5CDBF ON sales_order');
        $this->addSql('DROP INDEX IDX_36D222EA76ED395 ON sales_order');
        $this->addSql('ALTER TABLE sales_order DROP cart_id, DROP user_id');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('DROP INDEX IDX_BA388B7A76ED395 ON cart');
        $this->addSql('ALTER TABLE cart DROP user_id');
        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_5543718BA76ED395');
        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_5543718BF5B7AF75');
        $this->addSql('DROP INDEX IDX_5543718BA76ED395 ON user_address');
        $this->addSql('DROP INDEX IDX_5543718BF5B7AF75 ON user_address');
        $this->addSql('ALTER TABLE user_address DROP user_id, DROP address_id');
    }
}
