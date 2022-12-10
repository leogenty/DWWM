<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204114412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE online_lesson_language (online_lesson_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_BB284064581D7F5D (online_lesson_id), INDEX IDX_BB28406482F1BAF4 (language_id), PRIMARY KEY(online_lesson_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE online_lesson_language ADD CONSTRAINT FK_BB284064581D7F5D FOREIGN KEY (online_lesson_id) REFERENCES online_lesson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE online_lesson_language ADD CONSTRAINT FK_BB28406482F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE online_lesson_language DROP FOREIGN KEY FK_BB284064581D7F5D');
        $this->addSql('ALTER TABLE online_lesson_language DROP FOREIGN KEY FK_BB28406482F1BAF4');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE online_lesson_language');
    }
}
