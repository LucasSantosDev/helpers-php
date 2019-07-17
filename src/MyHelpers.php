<?php
namespace LucasDev\HelpersPhp;

class MyHelpers
{

    public static function BrDateToEnDate($date)
    {
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
        return $date;
    }

    public static function tirarAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
    }

    public static function BrDateTimeToEnDateTime($date)
    {
        $date = date('Y-m-d H:i', strtotime(str_replace('/', '-', $date)));
        return $date;
    }

    public static function EnDateToBrDate($date)
    {
        $date = date('d/m/Y', strtotime(str_replace('-', '/', $date)));
        return $date;
    }

    public static function EnDateTimeToBrDateTime($date)
    {
        $date = date('d/m/Y H:i', strtotime(str_replace('-', '/', $date)));
        return $date;
    }

    public static function BrValueToEnValue($value)
    {
        $value = str_replace(',', '.', str_replace('.', '', $value));
        return $value;
    }

    public static function clearChr($string) {
        $string = str_replace('&nbsp;', ' ', $string);
        $string = str_replace("chr34", chr(34), $string);
		$string = str_replace("chr37", chr(37), $string);
        $string = str_replace("chr38", chr(38), $string);
        $string = str_replace("chr39", chr(39), $string);
        $string = str_replace("chr60", chr(60), $string);
        $string = str_replace("chr62", chr(62), $string);
        return $string;
    }

    public static function EnValueToBrValue($value)
    {
        $value = number_format($value, 2, ',', '.');
        return $value;
    }

    public static function maskAnyThing($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }

            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }

            }
        }
        return $maskared;
    }

    public static function validaCelular($celular)
    {
        $celular = preg_replace('/[^0-9]/', '', $celular);
        $regexCel = '/[0-9]{2}[0-9]{1}[0-9]{3,4}[0-9]{4}/';
        if (preg_match($regexCel, $celular)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validaTelefone($telefone)
    {
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        $regexTel = '/[0-9]{2}[0-9]{4}[0-9]{4}/';
        if (preg_match($regexTel, $telefone)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validaCPF($cpf = null)
    {
        // Verifica se um número foi informado
        if (empty($cpf)) {
            return false;
        }
        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    public static function validaCNPJ($cnpj = null) {

        // Verifica se um número foi informado
        if(empty($cnpj)) {
            return false;
        }
    
        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
        
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            return false;
        }
        
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' || 
            $cnpj == '11111111111111' || 
            $cnpj == '22222222222222' || 
            $cnpj == '33333333333333' || 
            $cnpj == '44444444444444' || 
            $cnpj == '55555555555555' || 
            $cnpj == '66666666666666' || 
            $cnpj == '77777777777777' || 
            $cnpj == '88888888888888' || 
            $cnpj == '99999999999999') {
            return false;
            
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   
         
            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";
    
            for ($i = 0; $i < 13; $i++) {
    
                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;
    
                $soma2 += ($cnpj{$i} * $k);
    
                if ($i < 12) {
                    $soma1 += ($cnpj{$i} * $j);
                }
    
                $k--;
                $j--;
    
            }
    
            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
    
            return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
         
        }
    }


    public static function diffDates($data1, $data2, $anos, $meses, $dias)
    {
        $data1 = date('Y-m-d', strtotime($data1));
        $data1 = date_create($data1);

        $ano_de_nascimento = date('Y', strtotime($data2));

        $data2 = date('Y-m-d', strtotime($ano_de_nascimento . '-01-01'));
        $data2 = date_create($data2);

        $diferenca = date_diff($data1, $data2);

        if ($anos) {return $diferenca->format("%Y");}
        if ($meses) {return $diferenca->format("%m");}
        if ($dias) {return $diferenca->format("%d");}
    }

    public static function isWeekend($aData)
    {
        $dia = substr($aData, 0, 2);
        $mes = substr($aData, 3, 2);
        $ano = substr($aData, 6, 4);
        $date = date('w', mktime(0, 0, 0, $mes, $dia, $ano));

        if ($date == 6 || $date == 0):
            return true;
        else:
            return false;
        endif;
    }

    public static function calculaFrete(
        $cod_servico, /* codigo do servico desejado */
        $cep_origem, /* cep de origem, apenas numeros */
        $cep_destino, /* cep de destino, apenas numeros */
        $peso, /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
        $altura, /* altura do produto em cm incluindo a embalagem */
        $largura, /* altura do produto em cm incluindo a embalagem */
        $comprimento, /* comprimento do produto incluindo embalagem em cm */
        $valor_declarado = '0' /* indicar 0 caso nao queira o valor declarado */
    ) {
        try {
            $cod_servico = strtoupper($cod_servico);
            if ($cod_servico == 'SEDEX10') {
                $cod_servico = 40215;
            }

            if ($cod_servico == 'SEDEXACOBRAR') {
                $cod_servico = 40045;
            }

            if ($cod_servico == 'SEDEX') {
                $cod_servico = 40010;
            }

            if ($cod_servico == 'PAC') {
                $cod_servico = 41106;
            }

            # ###########################################
            # Código dos Principais Serviços dos Correios
            # 41106 PAC sem contrato
            # 40010 SEDEX sem contrato
            # 40045 SEDEX a Cobrar, sem contrato
            # 40215 SEDEX 10, sem contrato
            # ###########################################

            $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=" . $cep_origem . "&sCepDestino=" . $cep_destino . "&nVlPeso=" . $peso . "&nCdFormato=1&nVlComprimento=" . $comprimento . "&nVlAltura=" . $altura . "&nVlLargura=" . $largura . "&sCdMaoPropria=n&nVlValorDeclarado=" . $valor_declarado . "&sCdAvisoRecebimento=n&nCdServico=" . $cod_servico . "&nVlDiametro=0&StrRetorno=xml";

            try {
                $xml = simplexml_load_file($correios);
            } catch(Exception $dx) {
                return false;
            }

            $_arr_ = array();
            if ($xml->cServico->Erro == '0'):
                $_arr_['codigo'] = $xml->cServico->Codigo;
                $_arr_['valor'] = $xml->cServico->Valor;
                $_arr_['prazo'] = $xml->cServico->PrazoEntrega . ' Dias';
                // return $xml->cServico->Valor;
                return $_arr_;
            else:
                return false;
            endif;
        } catch(Exception $ex) {
            return false;
        }
    }

    public static function ValidaData($dat){
        $data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência
        $d = $data[0];
        $m = $data[1];
        $y = $data[2];
    
        $res = checkdate($m,$d,$y);
        if ($res == 1){
           return true;
        } else {
           return false;
        }
    }

    public static function verifyAndCreateFolder($dir) {
        if(!is_dir($dir))
            mkdir($dir, 0777, true);
    }

    public static function imageUpload($path_add, $request_file) {
        try {
            if($files = $request_file){
                $name = $files->getClientOriginalName();
                $files->move($path_add, $name);
            }

            return $name;
        } catch(Exception $err) {
            echo 'Erro: ' . $err->getMessage();

            return false;
        }
    }

    public static function validaEmail($email){
        //verifica se e-mail esta no formato correto de escrita
        if (!preg_match('/^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})/', $email)){
            return false;
        }
        else{
            //Valida o dominio
            $dominio=explode('@',$email);
            if(!checkdnsrr($dominio[1],'A')){
                return false;
            } else {
                return true; // Retorno true para indicar que o e-mail é valido
            }
        }
    }

    public static function forceDownload($type, $filename, $content) {
        $known_mime_types = array(
            "html" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "jpg" => "image/jpg",
            "php" => "text/plain",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html"=> "text/html",
            "png" => "image/png",
            "jpeg"=> "image/jpg"
        );
        
        header("Content-Type: $known_mime_types[$type]");
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=$filename"); 
        echo $content;
    }

    public static function sanitizeString($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '', $str);
        $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
        return $str;
    }
}
