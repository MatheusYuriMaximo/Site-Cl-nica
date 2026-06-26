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

## Passos

1. Instale e ative o plugin `Elementor`.
2. Abra `Paginas`.
3. Edite a pagina definida como pagina inicial.
4. Clique em `Editar com Elementor`.
5. Recrie ou importe a landing visualmente.
6. Publique/atualize a pagina.

Quando essa pagina tiver conteudo visual, o tema passa a mostrar essa versao editavel em vez do template fixo.

## Observacao Importante

O WordPress nao transforma automaticamente o template PHP atual em blocos arrastaveis. Para editar a pagina como no construtor visual, a landing precisa ser recriada no Elementor usando secoes, containers, textos, imagens, botoes e widgets de carrossel.

O template PHP atual continua servindo como referencia e fallback.
