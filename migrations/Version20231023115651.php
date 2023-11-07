<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023115651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10DD4481AD');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BDD4481AD');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, additional_address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payement (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_order (id INT AUTO_INCREMENT NOT NULL, total_quantity INT NOT NULL, date DATE NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxes (id INT AUTO_INCREMENT NOT NULL, rate INT NOT NULL, wordwording LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_cart_product DROP FOREIGN KEY FK_A534EEC1CB0CD60F');
        $this->addSql('ALTER TABLE product_cart_product DROP FOREIGN KEY FK_A534EEC14584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A149236C');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939879F37AE5');
        $this->addSql('ALTER TABLE order_adress_adress DROP FOREIGN KEY FK_18E4E8DA38018254');
        $this->addSql('ALTER TABLE order_adress_adress DROP FOREIGN KEY FK_18E4E8DA8486F9AC');
        $this->addSql('ALTER TABLE order_adress_order DROP FOREIGN KEY FK_F92B84F48D9F6D38');
        $this->addSql('ALTER TABLE order_adress_order DROP FOREIGN KEY FK_F92B84F438018254');
        $this->addSql('ALTER TABLE user_adress DROP FOREIGN KEY FK_39BEDC83A76ED395');
        $this->addSql('ALTER TABLE user_adress DROP FOREIGN KEY FK_39BEDC838486F9AC');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE product_taxe DROP FOREIGN KEY FK_DBDA0D484584665A');
        $this->addSql('ALTER TABLE product_taxe DROP FOREIGN KEY FK_DBDA0D481AB947A4');
        $this->addSql('DROP TABLE product_cart_product');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_adress');
        $this->addSql('DROP TABLE order_adress_adress');
        $this->addSql('DROP TABLE order_adress_order');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE user_adress');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE taxe');
        $this->addSql('DROP TABLE product_taxe');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7CB0CD60F');
        $this->addSql('DROP INDEX IDX_BA388B7CB0CD60F ON cart');
        $this->addSql('ALTER TABLE cart DROP product_cart_id');
        $this->addSql('ALTER TABLE category CHANGE name namename VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_70BE1A7BDD4481AD ON command_line');
        $this->addSql('ALTER TABLE command_line DROP id_order_id');
        $this->addSql('DROP INDEX IDX_3781EC10DD4481AD ON delivery');
        $this->addSql('ALTER TABLE delivery DROP id_order_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA21126A1');
        $this->addSql('DROP INDEX IDX_D34A04ADA21126A1 ON product');
        $this->addSql('ALTER TABLE product DROP command_line_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491AD5CDBF');
        $this->addSql('DROP INDEX IDX_8D93D6491AD5CDBF ON user');
        $this->addSql('ALTER TABLE user DROP cart_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_cart_product (product_cart_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_A534EEC1CB0CD60F (product_cart_id), INDEX IDX_A534EEC14584665A (product_id), PRIMARY KEY(product_cart_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, id_payment_id INT DEFAULT NULL, id_user_id INT NOT NULL, total_quantity INT NOT NULL, date DATE NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_F529939879F37AE5 (id_user_id), INDEX IDX_F5299398A149236C (id_payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE order_adress (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE order_adress_adress (order_adress_id INT NOT NULL, adress_id INT NOT NULL, INDEX IDX_18E4E8DA38018254 (order_adress_id), INDEX IDX_18E4E8DA8486F9AC (adress_id), PRIMARY KEY(order_adress_id, adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE order_adress_order (order_adress_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_F92B84F438018254 (order_adress_id), INDEX IDX_F92B84F48D9F6D38 (order_id), PRIMARY KEY(order_adress_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_adress (user_id INT NOT NULL, adress_id INT NOT NULL, INDEX IDX_39BEDC83A76ED395 (user_id), INDEX IDX_39BEDC838486F9AC (adress_id), PRIMARY KEY(user_id, adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, street VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, additional VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE taxe (id INT AUTO_INCREMENT NOT NULL, rate INT NOT NULL, wording VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_taxe (product_id INT NOT NULL, taxe_id INT NOT NULL, INDEX IDX_DBDA0D484584665A (product_id), INDEX IDX_DBDA0D481AB947A4 (taxe_id), PRIMARY KEY(product_id, taxe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_cart_product ADD CONSTRAINT FK_A534EEC1CB0CD60F FOREIGN KEY (product_cart_id) REFERENCES product_cart (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_cart_product ADD CONSTRAINT FK_A534EEC14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A149236C FOREIGN KEY (id_payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE order_adress_adress ADD CONSTRAINT FK_18E4E8DA38018254 FOREIGN KEY (order_adress_id) REFERENCES order_adress (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_adress_adress ADD CONSTRAINT FK_18E4E8DA8486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_adress_order ADD CONSTRAINT FK_F92B84F48D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_adress_order ADD CONSTRAINT FK_F92B84F438018254 FOREIGN KEY (order_adress_id) REFERENCES order_adress (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress ADD CONSTRAINT FK_39BEDC83A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_adress ADD CONSTRAINT FK_39BEDC838486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_taxe ADD CONSTRAINT FK_DBDA0D484584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_taxe ADD CONSTRAINT FK_DBDA0D481AB947A4 FOREIGN KEY (taxe_id) REFERENCES taxe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE payement');
        $this->addSql('DROP TABLE sales_order');
        $this->addSql('DROP TABLE taxes');
        $this->addSql('ALTER TABLE product ADD command_line_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA21126A1 FOREIGN KEY (command_line_id) REFERENCES command_line (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04ADA21126A1 ON product (command_line_id)');
        $this->addSql('ALTER TABLE delivery ADD id_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10DD4481AD FOREIGN KEY (id_order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3781EC10DD4481AD ON delivery (id_order_id)');
        $this->addSql('ALTER TABLE command_line ADD id_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BDD4481AD FOREIGN KEY (id_order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70BE1A7BDD4481AD ON command_line (id_order_id)');
        $this->addSql('ALTER TABLE cart ADD product_cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7CB0CD60F FOREIGN KEY (product_cart_id) REFERENCES product_cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BA388B7CB0CD60F ON cart (product_cart_id)');
        $this->addSql('ALTER TABLE `user` ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6491AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D6491AD5CDBF ON `user` (cart_id)');
        $this->addSql('ALTER TABLE category CHANGE namename name VARCHAR(255) NOT NULL');
    }
}
