<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328130508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD delete_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP `delete`');
        $this->addSql('ALTER TABLE user ADD delete_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP `delete`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD `delete` VARCHAR(255) NOT NULL, DROP delete_date');
        $this->addSql('ALTER TABLE `user` ADD `delete` VARCHAR(255) NOT NULL, DROP delete_date');
    }
}
