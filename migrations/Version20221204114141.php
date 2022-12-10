<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204114141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_F981B52EC54C8C93 ON chapter (type_id)');
        $this->addSql('ALTER TABLE online_lesson DROP language');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE online_lesson ADD language VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EC54C8C93');
        $this->addSql('DROP INDEX IDX_F981B52EC54C8C93 ON chapter');
    }
}
