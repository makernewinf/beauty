CREATE TABLE agenda( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `dataag` date   , 
      `horaag` time   , 
      `cor` varchar  (10)   , 
      `clientes_id` int   NOT NULL  , 
      `profissionais_id` int   NOT NULL  , 
      `servicos_id` int   NOT NULL  , 
      `horario_inicial` datetime   , 
      `horario_final` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE clientes( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
      `cpf` int   , 
      `sexo` varchar  (10)   , 
      `telefone` int   , 
      `celular` int   , 
      `email` varchar  (100)   , 
      `datanasc` date   , 
      `datacad` date   , 
      `obs` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE contas( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `documento` int   , 
      `fornecedores_id` int   NOT NULL  , 
      `valor` double   , 
      `grupo_contas_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE fornecedores( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
      `empresa` varchar  (100)   , 
      `telefone` int   , 
      `celular` int   , 
      `email` varchar  (100)   , 
      `observacao` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE grupo_contas( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
      `tipo` varchar  (10)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE grupo_produtos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE grupo_servicos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE horario_profissionais( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `dia` varchar  (10)   , 
      `hora_inicio` time   , 
      `hora_final` time   , 
      `intervalo` int   , 
      `profissionais_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pagamentos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `datalanc` date   , 
      `datapgto` date   , 
      `formapgto` varchar  (20)   , 
      `desconto` double   , 
      `valor` double   , 
      `profissionais_id` int   NOT NULL  , 
      `clientes_id` int   NOT NULL  , 
      `tipo_pagamento_id` int   NOT NULL  , 
      `servicos_id` int   NOT NULL  , 
      `produtos_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE produtos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `descricao` varchar  (100)   , 
      `tipo` varchar  (100)   , 
      `custo` double   , 
      `preco` double   , 
      `estoque_min` int   , 
      `estoque_atual` int   , 
      `grupo_produtos_id` int   NOT NULL  , 
      `fornecedores_id` int   NOT NULL  , 
      `foto` blob   , 
      `nome_foto` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE profissionais( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
      `telefone` int   , 
      `celular` int   , 
      `salario` double   , 
      `cpf` int   , 
      `comissao` double   , 
      `tipo_profissionais_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE servicos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
      `grupo_servicos_id` int   NOT NULL  , 
      `valor` double   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_pagamento( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (20)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_profissionais( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
  
 ALTER TABLE agenda ADD CONSTRAINT fk_agenda_1 FOREIGN KEY (clientes_id) references clientes(id); 
ALTER TABLE agenda ADD CONSTRAINT fk_agenda_2 FOREIGN KEY (profissionais_id) references profissionais(id); 
ALTER TABLE agenda ADD CONSTRAINT fk_agenda_3 FOREIGN KEY (servicos_id) references servicos(id); 
ALTER TABLE contas ADD CONSTRAINT fk_contas_1 FOREIGN KEY (fornecedores_id) references fornecedores(id); 
ALTER TABLE contas ADD CONSTRAINT fk_contas_2 FOREIGN KEY (grupo_contas_id) references grupo_contas(id); 
ALTER TABLE horario_profissionais ADD CONSTRAINT fk_horario_profissionais_1 FOREIGN KEY (profissionais_id) references profissionais(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_1 FOREIGN KEY (profissionais_id) references profissionais(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_2 FOREIGN KEY (clientes_id) references clientes(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_3 FOREIGN KEY (tipo_pagamento_id) references tipo_pagamento(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_4 FOREIGN KEY (servicos_id) references servicos(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_5 FOREIGN KEY (produtos_id) references produtos(id); 
ALTER TABLE produtos ADD CONSTRAINT fk_produtos_1 FOREIGN KEY (grupo_produtos_id) references grupo_produtos(id); 
ALTER TABLE produtos ADD CONSTRAINT fk_produtos_2 FOREIGN KEY (fornecedores_id) references fornecedores(id); 
ALTER TABLE profissionais ADD CONSTRAINT fk_profissionais_1 FOREIGN KEY (tipo_profissionais_id) references tipo_profissionais(id); 
ALTER TABLE servicos ADD CONSTRAINT fk_servicos_1 FOREIGN KEY (grupo_servicos_id) references grupo_servicos(id); 

  
