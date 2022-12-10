<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206160235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE online_lesson ADD matter_id INT NOT NULL');
        $this->addSql('ALTER TABLE online_lesson ADD CONSTRAINT FK_29655DD614E59F FOREIGN KEY (matter_id) REFERENCES matter (id)');
        $this->addSql('CREATE INDEX IDX_29655DD614E59F ON online_lesson (matter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE online_lesson DROP FOREIGN KEY FK_29655DD614E59F');
        $this->addSql('DROP INDEX IDX_29655DD614E59F ON online_lesson');
        $this->addSql('ALTER TABLE online_lesson DROP matter_id');
    }
}
