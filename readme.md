### Helpers para PHP

Execute o comando

```
composer require lucasdev/helpers-php
```

### Usando no PHP

```
use LucasDev\HelpersPhp\MyHelpers;

class TesteController extends Controller
{
    public function index()
	{
        $date = date('Y-m-d');

        $date = MyHelpers::EnDateToBrDate($date);

        dd($date);
    }
}
```

### Modo de Uso

Formatação de data EN para BR.

```
$yourDateInEn = date('Y-m-d');

MyHelpers::EnDateToBrDate($yourDateInEn);
```
```

$yourDateInBr = date('d/m/Y');

MyHelpers::BrDateToEnDate($yourDateInBr);
```
Mascarar string
```
MyHelpers::maskAnyThing('44532165498', '###.###.###-##');
```

Validar CPF (o mesmo para CNPJ, só muda a função)
```
if (MyHelpers::validaCPF($cpfComMascaraOuSemMascara)) {
	echo 'válido';
} else {
	echo 'inválido';
}
```

Verificar se uma data é final de semana
```
if (MyHelpers::isWeekend(date('d/m/Y'))) {
	echo 'final de semana';
} else {
	echo 'semana';
}
```
Upload de imagem (Funciona para o laravel >= 5.6)
```
$dirBase = public_path('images');

MyHelpers::imageUpload($dirBase, $request->file('foto'));
```

Forçar download do arquivo
```
$conteudo = '<table><tr><td>Coluna</td></tr></table>';

MyHelpers::forceDownload('xls', 'arquivo.xls', $conteudo);
```

![Logo Think So!](https://thinkso.com.br/application/views/images/logo_pagseguro.png)