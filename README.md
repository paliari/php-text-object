
# Converte arquivos de texto delimitado

Faz o parse do arquivo já tratando os dados, validando e convertendo para types PHP.

Muito fácil de usar, com apenas algumas linha de código consegue extrair dados do arquivos.

**Exemplo de uso:
**

        $result = FileFacade::create()
            ->addColumn('id', 0, 2, Types::INT, true)
            ->addColumn('c1', 2, 3, Types::DOUBLE)
    		->addColumn('c2', 5, 10, Types::NUMBER_STRING)
    		->addColumn('c3', 15, 5, Types::STRING)
    		->addColumn('c4', 20, 10, Types::EMAIL)
    		->addColumn('c5', 30, 19, Types::DATE_TIME, array('format' => 'Y-m-d H:i:s', 'required' => true))
    		->exec($file_name)
    ;


**Install Composer:**
    
    {"require": {"paliari/php-text-object": "dev-master"}}
