# Laravel WidgetEasy
Pacote para criar dashboard baseado em widget com ordenação lateral e visibiildade, 
salvando em banco como preferência de usuário logado.

# Uso
1. Publiquei o vendor
1. Adicione as 

### Dependencias

- [Jquery](https://jquery.com/download/)
- [Jquery UI](https://releases.jquery.com/ui/)
- [font-aewsome 4](https://fontawesome.com/v4.7.0/icons/)

### Instalação

```bash 
composer require gsferro/widget-easy && php artisan vendor:publish --provider="Gsferro\WidgetEasy\Providers\WidgetEasyServiceProvider" --force
```

```bash
@WidgeteasyCSS()
@WidgeteasyJS()
```
### Uso

- Estrutura basica
    ```html
    <x-widget-easy-container>
        <x-slot name="left">
            <!-- items iniciais do lado esquerdo --->
            <x-widget-easy-children id="<id>">
                <!-- seu componente / html --->
                left
            </x-widget-easy-children>
        </x-slot>
    
        <x-slot name="right">
            <!-- items iniciais do lado direito --->
            <x-widget-easy-children id="<id>">
                <!-- seu componente / html --->
                right
            </x-widget-easy-children>
        </x-slot>
    </x-widget-easy-container>
    ```

- Titulo
    ```html
    <x-widget-easy-children id="<id>" title="<title>">
        <!-- seu componente / html --->
    </x-widget-easy-children>
    ```

- Ocultável (Obrigatorio title)
    ```html
    <x-widget-easy-children id="<id>" title="<title>" isRemovible>
        <!-- seu componente / html --->
    </x-widget-easy-children>
    ```