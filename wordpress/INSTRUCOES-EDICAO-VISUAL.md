# Edicao Visual Da Landing

O tema agora funciona em dois modos:

1. **Fallback atual:** se a pagina inicial estiver vazia, o tema mostra a landing fixa atual.
2. **Pagina visual:** se a pagina inicial tiver conteudo criado no Elementor ou no editor de blocos, o tema renderiza esse conteudo como a pagina publicada.

## Caminho Recomendado: Elementor

Use Elementor quando quiser editar visualmente a pagina publicada, com liberdade para:

- alterar textos diretamente na tela;
- adicionar, remover e redimensionar caixas de texto;
- adicionar, remover e trocar fotos;
- editar titulos das fotos;
- criar e editar carrosseis;
- reorganizar secoes da pagina.

## Passos Recomendados

1. Instale e ative o plugin `Elementor`.
2. Abra o menu `NeuroAprender`.
3. Clique em `Gerar landing editavel no Elementor`.
4. O tema vai preencher a pagina inicial existente com uma versao Elementor da landing.
5. Abra `Paginas > Inicio`.
6. Clique em `Editar com Elementor`.
7. Edite textos, caixas, imagens e carrosseis visualmente.
8. Publique/atualize a pagina.

Quando essa pagina tiver conteudo visual, o tema passa a mostrar essa versao editavel em vez do template fixo.

## Observacao Importante

O WordPress nao transforma automaticamente o template PHP atual em blocos arrastaveis. O botao `Gerar landing editavel no Elementor` cria uma primeira versao visual na pagina inicial existente, usando secoes, textos, imagens, botoes e carrosseis editaveis.

O template PHP atual continua servindo como referencia e fallback.
