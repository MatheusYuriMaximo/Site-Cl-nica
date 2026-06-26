# Bot IA NeuroAprender

Esta versão do tema inclui um assistente virtual simples e seguro para dúvidas iniciais dos visitantes.

## O Que O Bot Faz

- Responde dúvidas sobre serviços, horários, endereço, Instagram, WhatsApp e agendamento.
- Usa as informações editáveis da landing page.
- Encaminha dúvidas clínicas para avaliação profissional.
- Não realiza diagnóstico.
- Não prescreve tratamento.
- Não substitui atendimento profissional.

## Como Configurar A Chave Da OpenAI

A chave da OpenAI não deve ficar no HTML, JavaScript ou painel público.

No servidor, edite o arquivo `wp-config.php` e adicione antes da linha `/* That's all, stop editing! */`:

```php
define( 'NEUROAPRENDER_OPENAI_API_KEY', 'sua-chave-aqui' );
```

Alternativa: configurar a variável de ambiente:

```text
OPENAI_API_KEY
```

O tema tenta primeiro `NEUROAPRENDER_OPENAI_API_KEY` e depois `OPENAI_API_KEY`.

## Campos Editáveis

Com o plugin Advanced Custom Fields ativo, edite a página `Início` e abra a aba `Bot IA`.

Campos disponíveis:

- Ativar assistente virtual
- Título do chat
- Mensagem inicial
- Texto do campo de mensagem
- Texto do botão flutuante
- Aviso do chat
- Modelo OpenAI
- Instruções do assistente
- Base de conhecimento adicional

## Endpoint Técnico

O widget chama este endpoint interno do WordPress:

```text
/wp-json/neuroaprender/v1/chat
```

Esse endpoint é quem chama a OpenAI. A chave nunca vai para o navegador do visitante.

## Limite Básico

O tema aplica um limite simples de 20 mensagens por minuto por IP para reduzir abuso.

## Se O Bot Nao Responder

Se o widget aparecer, mas responder apenas com mensagem de erro, a chave foi lida pelo WordPress e a falha esta na chamada para a OpenAI.

Depois de instalar a versao 1.2.3 do tema, teste o bot uma vez. O proprio chat deve indicar se o problema parece ser chave, creditos/billing, modelo ou conexao da VPS.

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
