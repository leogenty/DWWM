<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202174817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, matter_id INT NOT NULL, name VARCHAR(255) NOT NULL, numbering VARCHAR(255) NOT NULL, INDEX IDX_8CDE5729D614E59F (matter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729D614E59F FOREIGN KEY (matter_id) REFERENCES matter (id)');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52ED614E59F');
        $this->addSql('DROP INDEX IDX_F981B52ED614E59F ON chapter');
        $this->addSql('ALTER TABLE chapter CHANGE matter_id type_id INT NOT NULL');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_F981B52EC54C8C93 ON chapter (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EC54C8C93');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729D614E59F');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_F981B52EC54C8C93 ON chapter');
        $this->addSql('ALTER TABLE chapter CHANGE type_id matter_id INT NOT NULL');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52ED614E59F FOREIGN KEY (matter_id) REFERENCES matter (id)');
        $this->addSql('CREATE INDEX IDX_F981B52ED614E59F ON chapter (matter_id)');
    }
}
