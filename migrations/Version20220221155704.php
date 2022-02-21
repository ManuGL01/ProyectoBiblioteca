<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221155704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comentario (id INT AUTO_INCREMENT NOT NULL, autor_id INT NOT NULL, libro_id INT NOT NULL, comentario VARCHAR(255) NOT NULL, fecha_publicacion DATETIME NOT NULL, INDEX IDX_4B91E70214D45BBE (autor_id), INDEX IDX_4B91E702C0238522 (libro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, abreviatura VARCHAR(255) NOT NULL, edicion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libro (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, autor VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, curso_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, dni VARCHAR(9) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D64987CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_libro (user_id INT NOT NULL, libro_id INT NOT NULL, INDEX IDX_B55B5673A76ED395 (user_id), INDEX IDX_B55B5673C0238522 (libro_id), PRIMARY KEY(user_id, libro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E70214D45BBE FOREIGN KEY (autor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702C0238522 FOREIGN KEY (libro_id) REFERENCES libro (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64987CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
        $this->addSql('ALTER TABLE user_libro ADD CONSTRAINT FK_B55B5673A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_libro ADD CONSTRAINT FK_B55B5673C0238522 FOREIGN KEY (libro_id) REFERENCES libro (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64987CB4A1F');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702C0238522');
        $this->addSql('ALTER TABLE user_libro DROP FOREIGN KEY FK_B55B5673C0238522');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E70214D45BBE');
        $this->addSql('ALTER TABLE user_libro DROP FOREIGN KEY FK_B55B5673A76ED395');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE libro');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_libro');
    }
}
