<?php

require "../src/BrerpWsc.php";


//Lendo dados do arquivo json no diretorio documents
$request_content = file_get_contents("../documents/test_create_business_partner.json");
$json_request = json_decode($request_content, true);

//Atribuindo valor aleatório para a chave de busca do parceiro
$json_request["call"]["values"]["Value"] = random_int(1000000, 10000000);

//Instanciando o web service connector
$brerp_wsc = new BrerpWsc();

//Construindo requisição através do json
$brerp_wsc->build_request($json_request);
echo "\n". $brerp_wsc->get_json_request();

echo "\n\n". $brerp_wsc->get_xml_request();


$xml = '
<soapenv:Envelope xmlns:_0="http://idempiere.org/ADInterface/1_0" 
    xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
    <soapenv:Header/>
    <soapenv:Body>
        <_0:createData>
            <_0:ModelCRUDRequest>
                <_0:ModelCRUD>
                    <_0:serviceType>CreateBPartnerTest</_0:serviceType>
                    <_0:DataRow>
                        <_0:field column="Name">
                            <_0:val>Business Partner Test chicão</_0:val>
                        </_0:field>
                        <_0:field column="Value">
                            <_0:val>1765532</_0:val>
                        </_0:field>
                        <_0:field column="TaxID">
                            <_0:val>987654321</_0:val>
                        </_0:field>
                    </_0:DataRow>
                </_0:ModelCRUD>
                <_0:ADLoginRequest>
                    <_0:user>superuser @ brerp.com.br</_0:user>
                    <_0:pass>pp_brerp</_0:pass>
                    <_0:lang>en_US</_0:lang>
                    <_0:ClientID>1000000</_0:ClientID>
                    <_0:RoleID>1000000</_0:RoleID>
                    <_0:OrgID>5000003</_0:OrgID>
                    <_0:WarehouseID>5000007</_0:WarehouseID>
                </_0:ADLoginRequest>
            </_0:ModelCRUDRequest>
        </_0:createData>
    </soapenv:Body>
</soapenv:Envelope>';

$brerp_wsc->set_xml_request($xml);

echo "\n\n\n\n\n" . $brerp_wsc->get_xml_request();

//Executando requisição e exibindo resposta
$brerp_wsc->make_request();
//echo "\n\n" . $brerp_wsc->get_xml_response();

?>