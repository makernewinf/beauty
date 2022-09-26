PRAGMA foreign_keys=OFF; 

CREATE TABLE agenda( 
      id  INTEGER    NOT NULL  , 
      dataag date   , 
      horaag text   , 
      cor varchar  (10)   , 
      clientes_id int   NOT NULL  , 
      profissionais_id int   NOT NULL  , 
      servicos_id int   NOT NULL  , 
      horario_inicial datetime   , 
      horario_final datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(clientes_id) REFERENCES clientes(id),
FOREIGN KEY(profissionais_id) REFERENCES profissionais(id),
FOREIGN KEY(servicos_id) REFERENCES servicos(id)) ; 

CREATE TABLE clientes( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
      cpf int   , 
      sexo varchar  (10)   , 
      telefone int   , 
      celular int   , 
      email varchar  (100)   , 
      datanasc date   , 
      datacad date   , 
      obs varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE contas( 
      id  INTEGER    NOT NULL  , 
      documento int   , 
      fornecedores_id int   NOT NULL  , 
      valor double   , 
      grupo_contas_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(fornecedores_id) REFERENCES fornecedores(id),
FOREIGN KEY(grupo_contas_id) REFERENCES grupo_contas(id)) ; 

CREATE TABLE fornecedores( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
      empresa varchar  (100)   , 
      telefone int   , 
      celular int   , 
      email varchar  (100)   , 
      observacao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_contas( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
      tipo varchar  (10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_produtos( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_servicos( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE horario_profissionais( 
      id  INTEGER    NOT NULL  , 
      dia varchar  (10)   , 
      hora_inicio text   , 
      hora_final text   , 
      intervalo int   , 
      profissionais_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(profissionais_id) REFERENCES profissionais(id)) ; 

CREATE TABLE pagamentos( 
      id  INTEGER    NOT NULL  , 
      datalanc date   , 
      datapgto date   , 
      formapgto varchar  (20)   , 
      desconto double   , 
      valor double   , 
      profissionais_id int   NOT NULL  , 
      clientes_id int   NOT NULL  , 
      tipo_pagamento_id int   NOT NULL  , 
      servicos_id int   NOT NULL  , 
      produtos_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(profissionais_id) REFERENCES profissionais(id),
FOREIGN KEY(clientes_id) REFERENCES clientes(id),
FOREIGN KEY(tipo_pagamento_id) REFERENCES tipo_pagamento(id),
FOREIGN KEY(servicos_id) REFERENCES servicos(id),
FOREIGN KEY(produtos_id) REFERENCES produtos(id)) ; 

CREATE TABLE produtos( 
      id  INTEGER    NOT NULL  , 
      descricao varchar  (100)   , 
      tipo varchar  (100)   , 
      custo double   , 
      preco double   , 
      estoque_min int   , 
      estoque_atual int   , 
      grupo_produtos_id int   NOT NULL  , 
      fornecedores_id int   NOT NULL  , 
      foto blob   , 
      nome_foto varchar  (100)   , 
 PRIMARY KEY (id),
FOREIGN KEY(grupo_produtos_id) REFERENCES grupo_produtos(id),
FOREIGN KEY(fornecedores_id) REFERENCES fornecedores(id)) ; 

CREATE TABLE profissionais( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
      telefone int   , 
      celular int   , 
      salario double   , 
      cpf int   , 
      comissao double   , 
      tipo_profissionais_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_profissionais_id) REFERENCES tipo_profissionais(id)) ; 

CREATE TABLE servicos( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
      grupo_servicos_id int   NOT NULL  , 
      valor double   , 
 PRIMARY KEY (id),
FOREIGN KEY(grupo_servicos_id) REFERENCES grupo_servicos(id)) ; 

CREATE TABLE tipo_pagamento( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (20)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_profissionais( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

 
 
  
