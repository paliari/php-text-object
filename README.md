
# Converte arquivos de texto delimitado

Faz o parse do arquivo já tratando os dados, validando e convertendo para types PHP.

Muito fácil de usar, com apenas algumas linha de código consegue extrair dados do arquivos.

**Exemplo de uso:
**

        $result = FileFacade::create($file_name)
        ->addColumn('id', 0, 2, new FInt(true))
        ->addColumn('c1', 2, 3, new FDouble())
        ->addColumn('c2', 5, 10, new FNumberString())
        ->addColumn('c3', 15, 5, new FString())
        ->addColumn('c4', 20, 10, new FEmail())
        ->addColumn('c5', 30, 19, new FDate())
        ->exec()
    ;


**Install Composer:**
    
    {"require": {"paliari/php-text-object": "0.3.*"}}