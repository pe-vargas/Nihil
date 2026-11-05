# Pasta `css/`

**NIHIL | Universidade Tuiuti do Paraná | 2026**

## Sobre a pasta

Reúne as folhas de estilo do projeto, separadas por página.

## Conteúdo

| Arquivo | Utilizado em | Função |
|---|---|---|
| `style.css` | Todas as páginas | Estilos globais: ticker, menu, hero, vitrine, cards de produto, banner e rodapé |
| `carrinho.css` | `carrinho.php` | Lista de itens, resumo e total do carrinho |
| `contato.css` | `contato.php` | Formulário e mensagens de sucesso e erro |
| `quiz.css` | `quiz.php` | Perguntas, opções e caixa de resultado |

## Funcionamento

Todas as páginas carregam o `style.css`. As páginas de carrinho, contato e quiz carregam também o arquivo próprio, que complementa os estilos globais.

```html
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/quiz.css">
```

---

**Observação:** Ao criar uma nova página com estilo próprio, adicionar o arquivo nesta pasta e registrá-lo na tabela acima.
