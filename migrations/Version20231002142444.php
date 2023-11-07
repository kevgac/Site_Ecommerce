<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002142444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(16) NOT NULL, city VARCHAR(255) NOT NULL, additional VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_adress (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_adress_order (order_adress_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_F92B84F438018254 (order_adress_id), INDEX IDX_F92B84F48D9F6D38 (order_id), PRIMARY KEY(order_adress_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_adress_adress (order_adress_id INT NOT NULL, adress_id INT NOT NULL, INDEX IDX_18E4E8DA38018254 (order_adress_id), INDEX IDX_18E4E8DA8486F9AC (adress_id), PRIMARY KEY(order_adress_id, adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_adress (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, is_default TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_adress_user (user_adress_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8B36349184667448 (user_adress_id), INDEX IDX_8B363491A76ED395 (user_id), PRIMARY KEY(user_adress_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_adress_adress (user_adress_id INT NOT NULL, adress_id INT NOT NULL, INDEX IDX_5B090D5884667448 (user_adress_id), INDEX IDX_5B090D588486F9AC (adress_id), PRIMARY KEY(user_adress_id, adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_adress_order ADD CONSTRAINT FK_F92B84F438018254 FOREIGN KEY (order_adress_id) REFERENCES order_adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_adress_order ADD CONSTRAINT FK_F92B84F48D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_adress_adress ADD CONSTRAINT FK_18E4E8DA38018254 FOREIGN KEY (order_adress_id) REFERENCES order_adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_adress_adress ADD CONSTRAINT FK_18E4E8DA8486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_user ADD CONSTRAINT FK_8B36349184667448 FOREIGN KEY (user_adress_id) REFERENCES user_adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_user ADD CONSTRAINT FK_8B363491A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_adress ADD CONSTRAINT FK_5B090D5884667448 FOREIGN KEY (user_adress_id) REFERENCES user_adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_adress ADD CONSTRAINT FK_5B090D588486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD id_payment_id INT DEFAULT NULL, ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A149236C FOREIGN KEY (id_payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939879F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A149236C ON `order` (id_payment_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F529939879F37AE5 ON `order` (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A149236C');
        $this->addSql('ALTER TABLE order_adress_order DROP FOREIGN KEY FK_F92B84F438018254');
        $this->addSql('ALTER TABLE order_adress_order DROP FOREIGN KEY FK_F92B84F48D9F6D38');
        $this->addSql('ALTER TABLE order_adress_adress DROP FOREIGN KEY FK_18E4E8DA38018254');
        $this->addSql('ALTER TABLE order_adress_adress DROP FOREIGN KEY FK_18E4E8DA8486F9AC');
        $this->addSql('ALTER TABLE user_adress_user DROP FOREIGN KEY FK_8B36349184667448');
        $this->addSql('ALTER TABLE user_adress_user DROP FOREIGN KEY FK_8B363491A76ED395');
        $this->addSql('ALTER TABLE user_adress_adress DROP FOREIGN KEY FK_5B090D5884667448');
        $this->addSql('ALTER TABLE user_adress_adress DROP FOREIGN KEY FK_5B090D588486F9AC');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE order_adress');
        $this->addSql('DROP TABLE order_adress_order');
        $this->addSql('DROP TABLE order_adress_adress');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE user_adress');
        $this->addSql('DROP TABLE user_adress_user');
        $this->addSql('DROP TABLE user_adress_adress');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939879F37AE5');
        $this->addSql('DROP INDEX IDX_F5299398A149236C ON `order`');
        $this->addSql('DROP INDEX UNIQ_F529939879F37AE5 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP id_payment_id, DROP id_user_id');
    }
}
