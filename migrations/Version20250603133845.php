<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603133845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE user_carshare (user_id INT NOT NULL, carshare_id INT NOT NULL, INDEX IDX_99C41DEDA76ED395 (user_id), INDEX IDX_99C41DEDD05257A (carshare_id), PRIMARY KEY(user_id, carshare_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_carshare ADD CONSTRAINT FK_99C41DEDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_carshare ADD CONSTRAINT FK_99C41DEDD05257A FOREIGN KEY (carshare_id) REFERENCES carshare (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car CHANGE fuel fuel VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user_carshare DROP FOREIGN KEY FK_99C41DEDA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_carshare DROP FOREIGN KEY FK_99C41DEDD05257A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_carshare
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car CHANGE fuel fuel VARCHAR(255) DEFAULT NULL
        SQL);
    }
}
