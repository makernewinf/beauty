CREATE TABLE agenda( 
      id  SERIAL    NOT NULL  , 
      dataag date   , 
      horaag time   , 
      cor varchar  (10)   , 
      clientes_id integer   NOT NULL  , 
      profissionais_id integer   NOT NULL  , 
      servicos_id integer   NOT NULL  , 
      horario_inicial timestamp   , 
      horario_final timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE clientes( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
      cpf integer   , 
      sexo varchar  (10)   , 
      telefone integer   , 
      celular integer   , 
      email varchar  (100)   , 
      datanasc date   , 
      datacad date   , 
      obs varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE contas( 
      id  SERIAL    NOT NULL  , 
      documento integer   , 
      fornecedores_id integer   NOT NULL  , 
      valor float   , 
      grupo_contas_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE fornecedores( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
      empresa varchar  (100)   , 
      telefone integer   , 
      celular integer   , 
      email varchar  (100)   , 
      observacao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_contas( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
      tipo varchar  (10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_produtos( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_servicos( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE horario_profissionais( 
      id  SERIAL    NOT NULL  , 
      dia varchar  (10)   , 
      hora_inicio time   , 
      hora_final time   , 
      intervalo integer   , 
      profissionais_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pagamentos( 
      id  SERIAL    NOT NULL  , 
      datalanc date   , 
      datapgto date   , 
      formapgto varchar  (20)   , 
      desconto float   , 
      valor float   , 
      profissionais_id integer   NOT NULL  , 
      clientes_id integer   NOT NULL  , 
      tipo_pagamento_id integer   NOT NULL  , 
      servicos_id integer   NOT NULL  , 
      produtos_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produtos( 
      id  SERIAL    NOT NULL  , 
      descricao varchar  (100)   , 
      tipo varchar  (100)   , 
      custo float   , 
      preco float   , 
      estoque_min integer   , 
      estoque_atual integer   , 
      grupo_produtos_id integer   NOT NULL  , 
      fornecedores_id integer   NOT NULL  , 
      foto blob   , 
      nome_foto varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE profissionais( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
      telefone integer   , 
      celular integer   , 
      salario float   , 
      cpf integer   , 
      comissao float   , 
      tipo_profissionais_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE servicos( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
      grupo_servicos_id integer   NOT NULL  , 
      valor float   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_pagamento( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (20)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_profissionais( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

 
  
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

  
