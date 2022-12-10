<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205060428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073579F4768');
        $this->addSql('DROP INDEX IDX_D5B25073579F4768 ON progression');
        $this->addSql('ALTER TABLE progression DROP chapter_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progression ADD chapter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
        $this->addSql('CREATE INDEX IDX_D5B25073579F4768 ON progression (chapter_id)');
    }
}
