


--DROP TABLE tb_categorias;


/* DATABASE projeto_teste_001 */
--DROP DATABASE projeto_teste_001;


CREATE DATABASE projeto_teste_001;


/* TABELA CATEGORIAS - tb_categorias */
CREATE TABLE tb_categorias( 
	id_categoria INT NOT NUL-L PRIMARY KEY AUTO_INCREMENT, 
	categoria VARCHAR(50) NOT NULL, 
	descricao VARCHAR(250) NOT NULL 
);


INSERT INTO tb_categorias (categoria, descricao) VALUES ("Padaria", "Setor de Pães e Bolos");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Carnes", "Setor de Carnes e Peixes");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Mercearia", "Setor de Mercearia em Geral");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Matinais", "Setor de Matinais em Geral");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Frios e Laticínios", "Setor de Queijos, Presuntos, Salames, Iogurtes, Leites, Etc");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Bebidas", "Setor de Bebidas em Geral");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Utilidades Domésticas", "Setor de Utilidades");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Limpeza", "Setor de Material de Limpza");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Higiene", "Setor de Higiene em Geral");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Hortifruti", "Setor de Frutas, Legumes e Verduras");
INSERT INTO tb_categorias (categoria, descricao) VALUES ("Pet Shop", "Setor de Pet Shop em Geral");



