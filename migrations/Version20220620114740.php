<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620114740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_authentication (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, auth_service VARCHAR(255) NOT NULL, external_id VARCHAR(255) NOT NULL, picture LONGTEXT DEFAULT NULL, INDEX IDX_953116A4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_authentication ADD CONSTRAINT FK_953116A4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user DROP auth_service, DROP external_id, DROP avatar, DROP hosted_domain');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_authentication');
        $this->addSql('ALTER TABLE user ADD auth_service VARCHAR(255) DEFAULT NULL, ADD external_id VARCHAR(255) DEFAULT NULL, ADD avatar LONGTEXT DEFAULT NULL, ADD hosted_domain VARCHAR(255) DEFAULT NULL');
    }
}
