<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201163635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progression CHANGE complete complete INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user DROP progression');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progression CHANGE complete complete INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD progression SMALLINT DEFAULT 0 NOT NULL');
    }
}
