<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002145911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, product_cart_id INT DEFAULT NULL, total INT NOT NULL, save TINYINT(1) NOT NULL, INDEX IDX_BA388B7CB0CD60F (product_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, namename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_line (id INT AUTO_INCREMENT NOT NULL, id_order_id INT DEFAULT NULL, final_price_unit INT NOT NULL, vat_rate INT NOT NULL, UNIQUE INDEX UNIQ_70BE1A7BDD4481AD (id_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, command_line_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price_ht INT NOT NULL, INDEX IDX_D34A04ADA21126A1 (command_line_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_taxe (product_id INT NOT NULL, taxe_id INT NOT NULL, INDEX IDX_DBDA0D484584665A (product_id), INDEX IDX_DBDA0D481AB947A4 (taxe_id), PRIMARY KEY(product_id, taxe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_cart (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_cart_product (product_cart_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_A534EEC1CB0CD60F (product_cart_id), INDEX IDX_A534EEC14584665A (product_id), PRIMARY KEY(product_cart_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxe (id INT AUTO_INCREMENT NOT NULL, rate INT NOT NULL, wording VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7CB0CD60F FOREIGN KEY (product_cart_id) REFERENCES product_cart (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BDD4481AD FOREIGN KEY (id_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA21126A1 FOREIGN KEY (command_line_id) REFERENCES command_line (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_taxe ADD CONSTRAINT FK_DBDA0D484584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_taxe ADD CONSTRAINT FK_DBDA0D481AB947A4 FOREIGN KEY (taxe_id) REFERENCES taxe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_cart_product ADD CONSTRAINT FK_A534EEC1CB0CD60F FOREIGN KEY (product_cart_id) REFERENCES product_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_cart_product ADD CONSTRAINT FK_A534EEC14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD id_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10DD4481AD FOREIGN KEY (id_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10DD4481AD ON delivery (id_order_id)');
        $this->addSql('ALTER TABLE user ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491AD5CDBF ON user (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6491AD5CDBF');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7CB0CD60F');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BDD4481AD');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA21126A1');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE product_taxe DROP FOREIGN KEY FK_DBDA0D484584665A');
        $this->addSql('ALTER TABLE product_taxe DROP FOREIGN KEY FK_DBDA0D481AB947A4');
        $this->addSql('ALTER TABLE product_cart_product DROP FOREIGN KEY FK_A534EEC1CB0CD60F');
        $this->addSql('ALTER TABLE product_cart_product DROP FOREIGN KEY FK_A534EEC14584665A');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE command_line');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_taxe');
        $this->addSql('DROP TABLE product_cart');
        $this->addSql('DROP TABLE product_cart_product');
        $this->addSql('DROP TABLE taxe');
        $this->addSql('DROP INDEX IDX_8D93D6491AD5CDBF ON `user`');
        $this->addSql('ALTER TABLE `user` DROP cart_id');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10DD4481AD');
        $this->addSql('DROP INDEX IDX_3781EC10DD4481AD ON delivery');
        $this->addSql('ALTER TABLE delivery DROP id_order_id');
    }
}
