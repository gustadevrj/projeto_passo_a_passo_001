
/* TABELA CATEGORIAS - tb_categorias*/
CREATE TABLE tb_categorias(
	id_categoria int not null PRIMARY KEY AUTO_INCREMENT,
	categoria varchar(250) not null
);

INSERT INTO tb_categorias (categoria) VALUES ("Padaria");
INSERT INTO tb_categorias (categoria) VALUES ("Carnes");
INSERT INTO tb_categorias (categoria) VALUES ("Mercearia");
INSERT INTO tb_categorias (categoria) VALUES ("Matinais");
INSERT INTO tb_categorias (categoria) VALUES ("Frios e Latic�nios");
INSERT INTO tb_categorias (categoria) VALUES ("Bebidas");
INSERT INTO tb_categorias (categoria) VALUES ("Utilidades Dom�sticas");
INSERT INTO tb_categorias (categoria) VALUES ("Limpeza");
INSERT INTO tb_categorias (categoria) VALUES ("Higiene");
INSERT INTO tb_categorias (categoria) VALUES ("Hortifruti");
INSERT INTO tb_categorias (categoria) VALUES ("Pet Shop");



