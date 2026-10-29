# Trabalho 2 - Deploy Automático em VM (Catálogo de Filmes Netflix)

## Integrantes
- **Alunos:** Thiago Jose da Silva Braz, Gabriel Priori de Morais

---

## 1. A Base da Aplicação e a VM
A aplicação é um sistema CRUD inspirado na interface da Netflix, desenvolvido em PHP orientado a objetos com PDO e banco de dados MySQL, permitindo o cadastro de filmes com capa, listagem em vitrine, edição e remoção.

Para a hospedagem, foi criada uma máquina virtual com Ubuntu Server. Em vez de rodar o PHP e o MySQL diretamente no sistema operacional da VM, a aplicação foi totalmente encapsulada em contêineres orquestrados pelo Docker Compose. Isso garante um ambiente padronizado, isolado e simples de recriar em qualquer servidor.

* **Back-end:** PHP 8.2 (Apache + PDO)
* **Banco de Dados:** MySQL 8.0
* **Front-end:** HTML5 e CSS3
* **Infraestrutura:** Docker, Docker Compose e Ubuntu Server

---

## 2. O Papel do Runner Self-Hosted
Diferente do fluxo padrão do GitHub Actions — onde os workflows rodam nos servidores da Microsoft/GitHub na nuvem —, este projeto precisava atualizar uma infraestrutura própria local.

Para viabilizar isso, o agente do GitHub Actions (Runner Self-Hosted) foi instalado e registrado diretamente dentro da máquina virtual Ubuntu Server, configurado como um serviço contínuo de segundo plano via `systemd`. O runner permanece em execução constante, conectado ao repositório via internet e aguardando novas instruções de trabalho.

---

## 3. O Gatilho do Deploy Automático
No repositório, o arquivo `.github/workflows/deploy.yml` foi configurado para monitorar qualquer evento de `push` na branch `main`. 

A instrução essencial é `runs-on: self-hosted`. Ao realizar o commit e enviar as alterações com `git push origin main`, o GitHub não processa a tarefa na nuvem: ele envia uma notificação para o runner ativo dentro da máquina virtual avisando que há um novo job a ser executado localmente.

---

## 4. A Atualização na Prática (O Deploy)
Ao receber o comando disparado pelo evento de push, o runner executa a esteira de passos automaticamente no terminal do Ubuntu Server:

1. **Checkout do Código:** Baixa a versão mais recente dos arquivos alterados para o diretório de trabalho do runner na VM (`actions/checkout@v4`).
2. **Permissões de Diretório:** Garante permissões de escrita na pasta `uploads/` para que o servidor web continue salvando as imagens enviadas.
3. **Atualização dos Contêineres:** Executa o comando `docker compose down` para encerrar os contêineres antigos e, em seguida, dispara `docker compose up -d --build`.

Com isso, o Docker recompila a imagem da aplicação com os arquivos atualizados e sobe os serviços novamente. Qualquer modificação no código reflete de imediato no navegador, sem necessidade de login manual por SSH ou reinicialização manual de serviços.

---

## Como Acessar a Aplicação
Com a máquina virtual ativa e os contêineres em execução:

* **Acesso pelo Navegador:** `http://localhost:8080` (ou `http://IP_DA_VM:8080`)
* **Comando para inicialização manual (se necessário):**
  ```bash
  docker compose up -d --build
