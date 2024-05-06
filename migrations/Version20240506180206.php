<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506180206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C13DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C13DA5256D ON category (image_id)');
        $this->addSql('ALTER TABLE file ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_8C9F361012469DE2 ON file (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C13DA5256D');
        $this->addSql('DROP INDEX UNIQ_64C19C13DA5256D ON category');
        $this->addSql('ALTER TABLE category DROP image_id');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F361012469DE2');
        $this->addSql('DROP INDEX IDX_8C9F361012469DE2 ON file');
        $this->addSql('ALTER TABLE file DROP category_id');
    }
}
