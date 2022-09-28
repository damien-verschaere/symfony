<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927073213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments ADD comments_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A370821DF FOREIGN KEY (comments_article_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A370821DF ON comments (comments_article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A370821DF');
        $this->addSql('DROP INDEX IDX_5F9E962A370821DF ON comments');
        $this->addSql('ALTER TABLE comments DROP comments_article_id');
    }
}
