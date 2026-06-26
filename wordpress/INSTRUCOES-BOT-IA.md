# Bot IA NeuroAprender

Esta versao do tema inclui um assistente virtual para duvidas iniciais dos visitantes.

## O Que O Bot Faz

- Responde duvidas sobre servicos, horarios, endereco, Instagram, WhatsApp e agendamento.
- Usa as informacoes editaveis da landing page.
- Usa a tabela de precos e regras comerciais cadastradas na aba `Bot IA`.
- Encaminha duvidas clinicas para avaliacao profissional.
- Nao realiza diagnostico.
- Nao prescreve tratamento.
- Nao substitui atendimento profissional.

## Como Configurar A Chave Da OpenAI

A chave da OpenAI nao deve ficar no HTML, JavaScript ou painel publico.

No servidor, edite o arquivo `wp-config.php` e adicione antes da linha `/* That's all, stop editing! */`:

```php
define( 'NEUROAPRENDER_OPENAI_API_KEY', 'sua-chave-aqui' );
```

Alternativa: configurar a variavel de ambiente:

```text
OPENAI_API_KEY
```

O tema tenta primeiro `NEUROAPRENDER_OPENAI_API_KEY` e depois `OPENAI_API_KEY`.

## Como Editar O Prompt E A Tabela De Precos

No WordPress:

1. Abra `Paginas`.
2. Edite a pagina definida como pagina inicial da clinica.
3. Abra o bloco `NeuroAprender - Conteudo da Landing Page`.
4. Clique na aba `Bot IA`.
5. Edite os campos:
   - `Instrucoes do assistente`
   - `Tabela de precos e regras comerciais`
   - `Base de conhecimento adicional`
6. Clique em `Atualizar`.

O campo `Tabela de precos e regras comerciais` e enviado ao bot como contexto da API. Edite ali valores, duracoes, pacotes e regras de desconto.

Regra recomendada: manter valor cheio como padrao e informar o valor com 20% apenas quando o cliente pedir desconto, promocao, condicao especial ou negociacao.

## Campos Editaveis Do Bot

- Ativar assistente virtual
- Titulo do chat
- Mensagem inicial
- Texto do campo de mensagem
- Texto do botao flutuante
- Aviso do chat
- Modelo OpenAI
- Instrucoes do assistente
- Tabela de precos e regras comerciais
- Base de conhecimento adicional

## Endpoint Tecnico

O widget chama este endpoint interno do WordPress:

```text
/wp-json/neuroaprender/v1/chat
```

Esse endpoint e quem chama a OpenAI. A chave nunca vai para o navegador do visitante.

## Limite Basico

O tema aplica um limite simples de 20 mensagens por minuto por IP para reduzir abuso.

## Se O Bot Nao Responder

Para o visitante, qualquer falha aparece como uma mensagem generica. O detalhe tecnico fica apenas nos logs do servidor.

Para ver o detalhe tecnico, confira os logs do site no CloudPanel:

```text
Sites > neuroaprenderap.com.br > Logs
```

Procure por linhas que comecem com:

```text
[NeuroAprender AI]
```

As causas mais comuns sao:

- chave copiada incompleta ou de outro projeto;
- billing/creditos da OpenAI ainda nao ativados;
- modelo sem acesso na conta;
- VPS sem conexao de saida para `api.openai.com`;
- campo `Modelo OpenAI` alterado no WordPress para um nome invalido.

No campo `Modelo OpenAI`, use:

```text
gpt-4o-mini
```

## Se O Botao Nao Abrir

Instale a versao `1.2.2` ou superior do tema. Ela corrige o empacotamento do ZIP para WordPress em Linux, garantindo que o arquivo abaixo seja instalado:

```text
assets/js/neuroaprender.js
```

Se esse arquivo nao existir dentro do tema instalado, o botao aparece, mas nao abre o painel.
