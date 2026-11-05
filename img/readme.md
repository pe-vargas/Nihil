# Pasta `img/`

**NIHIL | Universidade Tuiuti do Paraná | 2026**

## Sobre a pasta

Reúne as imagens utilizadas pelo site: logotipo, fotos de produtos e banner de coleção.

## Conteúdo

| Arquivo(s) | Utilizado em | Descrição |
|---|---|---|
| `logo2.png` | Todas as páginas | Logotipo e favicon da NIHIL |
| `s1.jpg`, `roupa1.jpg`, `r2.png`, `r3.jpg`, `r4.jpg`, `r5.png` | `index.php` | Produtos do drop Unholy SS26 |
| `f1.jpg`, `f2.jpg`, `f3.jpg`, `f4.jpg`, `pitayaq.jpg`, `pitayaq2.png` | `f.php` | Coleção feminina |
| `m1.jpg`, `m2.jpg`, `m3.jpg`, `m4.jpg`, `m5.png`, `oli.jpg` | `m.php` | Coleção masculina |
| `ko.jpg` | Home, feminino e masculino | Prévia da coleção Killing Obsession AW26 |

## Adição de novos produtos

1. Salvar a imagem nesta pasta;
2. Informar apenas o nome do arquivo no array de produtos da página:

```php
['nome' => 'Nome da peça', 'preco' => 100.00, 'estilo' => 'Estilo', 'img' => 'arquivo.jpg']
```

O caminho `img/` é adicionado automaticamente pelo código.

---

**Observação:** Os nomes dos arquivos devem ser idênticos aos usados no PHP, incluindo maiúsculas e minúsculas, pois servidores Linux diferenciam `R2.png` de `r2.png`. Recomenda-se evitar espaços e acentos.
