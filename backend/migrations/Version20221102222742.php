<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102222742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "lead" (id UUID NOT NULL, user_id UUID DEFAULT NULL, name VARCHAR(100) NOT NULL, text VARCHAR(1000) NOT NULL, contact VARCHAR(120) NOT NULL, status VARCHAR(50) NOT NULL, history TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_289161CBA76ED395 ON "lead" (user_id)');
        $this->addSql('COMMENT ON COLUMN "lead".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "lead".user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "lead".history IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN "lead".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "lead".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "metrica" (id UUID NOT NULL, user_id UUID DEFAULT NULL, title VARCHAR(100) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D133DBAFA76ED395 ON "metrica" (user_id)');
        $this->addSql('COMMENT ON COLUMN "metrica".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "metrica".user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "metrica".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "post" (id UUID NOT NULL, user_id UUID DEFAULT NULL, title VARCHAR(100) NOT NULL, text VARCHAR(1000) NOT NULL, image VARCHAR(120) DEFAULT NULL, active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON "post" (user_id)');
        $this->addSql('COMMENT ON COLUMN "post".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "post".user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "post".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "post".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, login VARCHAR(25) NOT NULL, fio VARCHAR(255) NOT NULL, job_title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, is_public BOOLEAN NOT NULL, password VARCHAR(60) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (login)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".description IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE "lead" ADD CONSTRAINT FK_289161CBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "metrica" ADD CONSTRAINT FK_D133DBAFA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "post" ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "lead" DROP CONSTRAINT FK_289161CBA76ED395');
        $this->addSql('ALTER TABLE "metrica" DROP CONSTRAINT FK_D133DBAFA76ED395');
        $this->addSql('ALTER TABLE "post" DROP CONSTRAINT FK_5A8A6C8DA76ED395');
        $this->addSql('DROP TABLE "lead"');
        $this->addSql('DROP TABLE "metrica"');
        $this->addSql('DROP TABLE "post"');
        $this->addSql('DROP TABLE "user"');
    }
}
