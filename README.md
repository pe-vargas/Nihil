# NIHIL

Loja virtual de moda gótica/sombria (*"Nothing Is Worn Louder"*), inspirada em Elden Ring. Feita com PHP, HTML e CSS, **sem banco de dados**.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white)

## Screenshots

| Home | Quiz |
|---|---|
| ![Home](screenshots/home.png) | ![Quiz](screenshots/quiz.png) |

| Coleção | Carrinho |
|---|---|
| ![Coleção](screenshots/colecao.png) | ![Carrinho](screenshots/carrinho.png) |

## Funcionalidades

- **Vitrine de produtos** em páginas separadas: drop atual, feminino e masculino
- **Carrinho com sessões PHP**: adicionar, remover, limpar e total em R$
- **Contador de itens** no menu
- **Menu dinâmico** que destaca a página atual
- **Formulário de contato** com validação no servidor
- **Quiz de estilo** com 3 perfis de resultado e recomendação de produtos

## Como rodar

Requer **PHP 8+**.

```bash
git clone https://github.com/pe-vargas/nihil.git
cd nihil
php -S localhost:8000
```

Abra http://localhost:8000

## Estrutura

```
index.php     home e drop atual
f.php         coleção feminina
m.php         coleção masculina
quiz.php      quiz de estilo
carrinho.php  carrinho (sessões PHP)
contato.php   formulário de contato
css/          estilos por página
img/          imagens
screenshots/  prints para este README
```

Cada pasta tem seu próprio README: [css](css/README.md) · [img](img/README.md) · [screenshots](screenshots/README.md)

## Aprendizados

- Sessões PHP para manter o estado do carrinho sem banco de dados
- Lógica de quiz com contagem de respostas
- Validação de formulário no servidor
- Escape de saída com `htmlspecialchars` contra XSS

## Limitações

- Os produtos ficam em arrays dentro dos arquivos `.php`, não em banco de dados
- O formulário de contato valida os campos, mas **não envia e-mail**
- Não há checkout nem pagamento: é um projeto acadêmico

## Autor

**Pedro Dambiski de Vargas**, estudante de Análise e Desenvolvimento de Sistemas (UTP)
Projeto da disciplina de Programação Web.

[GitHub](https://github.com/pe-vargas)
