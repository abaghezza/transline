<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127154713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE demandes_users');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_635405980E95E18');
        $this->addSql('DROP INDEX IDX_635405980E95E18 ON files');
        $this->addSql('ALTER TABLE files CHANGE demande_id demandes_id INT NOT NULL');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059F49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id)');
        $this->addSql('CREATE INDEX IDX_6354059F49DCC2D ON files (demandes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demandes_users (demandes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_D4E25C72F49DCC2D (demandes_id), INDEX IDX_D4E25C7267B3B43D (users_id), PRIMARY KEY(demandes_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE demandes_users ADD CONSTRAINT FK_D4E25C7267B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demandes_users ADD CONSTRAINT FK_D4E25C72F49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059F49DCC2D');
        $this->addSql('DROP INDEX IDX_6354059F49DCC2D ON files');
        $this->addSql('ALTER TABLE files CHANGE demandes_id demande_id INT NOT NULL');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_635405980E95E18 FOREIGN KEY (demande_id) REFERENCES demandes (id)');
        $this->addSql('CREATE INDEX IDX_635405980E95E18 ON files (demande_id)');
    }
}
