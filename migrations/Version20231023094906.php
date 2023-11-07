<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023094906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_adress_user DROP FOREIGN KEY FK_8B363491A76ED395');
        $this->addSql('ALTER TABLE user_adress_user DROP FOREIGN KEY FK_8B36349184667448');
        $this->addSql('ALTER TABLE user_adress_adress DROP FOREIGN KEY FK_5B090D588486F9AC');
        $this->addSql('ALTER TABLE user_adress_adress DROP FOREIGN KEY FK_5B090D5884667448');
        $this->addSql('DROP TABLE user_adress_user');
        $this->addSql('DROP TABLE user_adress_adress');
        $this->addSql('ALTER TABLE user_adress MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON user_adress');
        $this->addSql('ALTER TABLE user_adress ADD user_id INT NOT NULL, ADD adress_id INT NOT NULL, DROP id, DROP type, DROP is_default');
        $this->addSql('ALTER TABLE user_adress ADD CONSTRAINT FK_39BEDC83A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_adress ADD CONSTRAINT FK_39BEDC838486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE INDEX IDX_39BEDC83A76ED395 ON user_adress (user_id)');
        $this->addSql('CREATE INDEX IDX_39BEDC838486F9AC ON user_adress (adress_id)');
        $this->addSql('ALTER TABLE user_adress ADD PRIMARY KEY (user_id, adress_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_adress_user (user_adress_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8B36349184667448 (user_adress_id), INDEX IDX_8B363491A76ED395 (user_id), PRIMARY KEY(user_adress_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_adress_adress (user_adress_id INT NOT NULL, adress_id INT NOT NULL, INDEX IDX_5B090D5884667448 (user_adress_id), INDEX IDX_5B090D588486F9AC (adress_id), PRIMARY KEY(user_adress_id, adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_adress_user ADD CONSTRAINT FK_8B363491A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_user ADD CONSTRAINT FK_8B36349184667448 FOREIGN KEY (user_adress_id) REFERENCES user_adress (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_adress ADD CONSTRAINT FK_5B090D588486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress_adress ADD CONSTRAINT FK_5B090D5884667448 FOREIGN KEY (user_adress_id) REFERENCES user_adress (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_adress DROP FOREIGN KEY FK_39BEDC83A76ED395');
        $this->addSql('ALTER TABLE user_adress DROP FOREIGN KEY FK_39BEDC838486F9AC');
        $this->addSql('DROP INDEX IDX_39BEDC83A76ED395 ON user_adress');
        $this->addSql('DROP INDEX IDX_39BEDC838486F9AC ON user_adress');
        $this->addSql('ALTER TABLE user_adress ADD id INT AUTO_INCREMENT NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD is_default TINYINT(1) NOT NULL, DROP user_id, DROP adress_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
