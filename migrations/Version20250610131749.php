<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250610131749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare_user DROP FOREIGN KEY FK_7A2A88E1D05257A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare_user DROP FOREIGN KEY FK_7A2A88E1A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE carshare_user
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE carshare_user (carshare_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7A2A88E1D05257A (carshare_id), INDEX IDX_7A2A88E1A76ED395 (user_id), PRIMARY KEY(carshare_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare_user ADD CONSTRAINT FK_7A2A88E1D05257A FOREIGN KEY (carshare_id) REFERENCES carshare (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare_user ADD CONSTRAINT FK_7A2A88E1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
    }
}
