<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923085243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, article_user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, texte LONGTEXT NOT NULL, date_article DATETIME NOT NULL, INDEX IDX_BFDD31684ABC9722 (article_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, comments_user_id INT NOT NULL, text_comments LONGTEXT NOT NULL, date_comments DATETIME NOT NULL, INDEX IDX_5F9E962AAAA72059 (comments_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31684ABC9722 FOREIGN KEY (article_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AAAA72059 FOREIGN KEY (comments_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31684ABC9722');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AAAA72059');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE comments');
    }
}
