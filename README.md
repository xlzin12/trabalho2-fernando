# Trabalho 2 - Deploy Automático em VM (Catálogo de Filmes Netflix)

## Integrante
* **Aluno:** Thiago Jose da Silva Braz

---

## Sobre o Projeto (CRUD) e Tecnologias Utilizadas
Esta aplicação consiste em um sistema CRUD completo inspirado no catálogo da Netflix, permitindo cadastrar novos filmes (com upload de imagem da capa, nome, gênero, diretor e duração), listar os filmes na vitrine principal, editar as informações de registros existentes e excluir filmes do catálogo.

**Tecnologias utilizadas:**
* **Back-end:** PHP 8.2 (Orientado a Objetos com PDO)
* **Banco de Dados:** MySQL 8.0
* **Front-end:** HTML5 e CSS3
* **Infraestrutura e Automação:** Docker, Docker Compose, Ubuntu Server (VM) e GitHub Actions (Self-Hosted Runner)

---

## Funcionamento do Runner Local e Deploy Automático
1. **Runner Self-Hosted:** Na máquina virtual com Ubuntu Server, foi instalado e registrado o serviço do GitHub Actions Runner vinculado diretamente a este repositório. O Runner fica ativo em segundo plano escutando os eventos disparados pelo GitHub.
2. **Action de Deploy (`.github/workflows/deploy.yml`):** Sempre que um novo `push` é realizado na branch `main`, a GitHub Action é acionada com a diretiva `runs-on: self-hosted`.
3. **Atualização dos Containers:** O Runner local baixa a versão mais recente do código na VM (`actions/checkout@v4`), ajusta as permissões de diretório e executa `docker compose down` seguido de `docker compose up -d --build`, recriando e atualizando a aplicação automaticamente sem necessidade de intervenção manual.

---

## Como Executar ou Acessar a Aplicação na VM
Com a Máquina Virtual ligada e conectada à rede (Modo Bridge) e os containers ativos via Docker Compose:

* **Acesso via Navegador:** `http://IP_DA_VM:8080` *(Substituir `IP_DA_VM` pelo IP exibido no comando `ip a` da VM)*
* **Comandos para subir manualmente (caso necessário):**
  ```bash
  docker compose up -d --build# trabalho2-fernando
