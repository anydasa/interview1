<?php declare(strict_types=1);

namespace Tests\functional\Presentation\Cli\Command\Commission;


use Application\Commission\ValueObject\CurrencyRate;
use Codeception\Example;
use GuzzleHttp\Psr7\Response;
use Tests\FunctionalTester;

class CalculateBatchCommandCest
{
    public function errorWhenFileNotProvided(FunctionalTester $I): void
    {
        $I->expectThrowable(new \Symfony\Component\Console\Exception\RuntimeException('Not enough arguments (missing: "file").'), function () use ($I) {
            $I->runSymfonyConsoleCommand('commission:calculate:batch');
        });
    }

    /**
     * @dataProvider successDataProvider
     */
    public function successSuccessCalculateBatch(FunctionalTester $I, Example $data): void
    {
        $I->mockResponse(...$data[0]);
        $output = $I->runSymfonyConsoleCommand('commission:calculate:batch', ['file' => codecept_data_dir('transactions.txt')]);

        $I->assertSame($data[1], $output);

    }

    private function successDataProvider(): array
    {
        return [
            [
                [
                    new Response(200, [], '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Visa/Dankort","prepaid":false,"country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank","url":"www.jyskebank.dk","phone":"+4589893300","city":"Hjørring"}}'),
                    new Response(200, [], '{"success":true,"timestamp":1695982803,"base":"EUR","date":"2023-09-29","rates":{"AED":3.897439,"AFN":82.701924,"ALL":107.419589,"AMD":414.429268,"ANG":1.907831,"AOA":879.654688,"ARS":371.414615,"AUD":1.63297,"AWG":1.909987,"AZN":1.797056,"BAM":1.964443,"BBD":2.137444,"BDT":116.713517,"BGN":1.955719,"BHD":0.400024,"BIF":3001.019066,"BMD":1.061104,"BND":1.45034,"BOB":7.315185,"BRL":5.341042,"BSD":1.058628,"BTC":3.9283675e-5,"BTN":88.087815,"BWP":14.570528,"BYN":2.671993,"BYR":20797.631617,"BZD":2.133828,"CAD":1.424181,"CDF":2648.514915,"CHF":0.966427,"CLF":0.034818,"CLP":960.707813,"CNY":7.744888,"COP":4321.875182,"CRC":569.989042,"CUC":1.061104,"CUP":28.119247,"CVE":110.753862,"CZK":24.363789,"DJF":188.483965,"DKK":7.456799,"DOP":60.092413,"DZD":145.800632,"EGP":32.789152,"ERN":15.916555,"ETB":58.554373,"EUR":1,"FJD":2.434916,"FKP":0.868331,"GBP":0.865399,"GEL":2.84905,"GGP":0.868331,"GHS":12.254089,"GIP":0.868331,"GMD":68.945226,"GNF":9088.688713,"GTQ":8.320727,"GYD":221.48449,"HKD":8.307858,"HNL":26.102106,"HRK":7.443333,"HTG":142.912728,"HUF":391.036324,"IDR":16411.347442,"ILS":4.053384,"IMP":0.868331,"INR":88.113519,"IQD":1386.406457,"IRR":44831.629549,"ISK":144.90461,"JEP":0.868331,"JMD":163.775953,"JOD":0.752957,"JPY":158.176595,"KES":157.202519,"KGS":94.1304,"KHR":4358.993883,"KMF":495.118144,"KPW":955.035922,"KRW":1426.367217,"KWD":0.327786,"KYD":0.882186,"KZT":502.372711,"LAK":21584.06749,"LBP":15910.829754,"LKR":343.281993,"LRD":197.948624,"LSL":20.251182,"LTL":3.133163,"LVL":0.641851,"LYD":5.174621,"MAD":10.930392,"MDL":19.266861,"MGA":4815.666102,"MKD":61.515646,"MMK":2223.018006,"MNT":3689.015824,"MOP":8.535495,"MRO":378.813822,"MUR":47.187939,"MVR":16.420592,"MWK":1144.397383,"MXN":18.499392,"MYR":4.982204,"MZN":67.114753,"NAD":20.139904,"NGN":825.643468,"NIO":38.729123,"NOK":11.245826,"NPR":140.932098,"NZD":1.756024,"OMR":0.40852,"PAB":1.058658,"PEN":4.015386,"PGK":3.866923,"PHP":60.085525,"PKR":304.323785,"PLN":4.636333,"PYG":7716.733988,"QAR":3.863514,"RON":4.973712,"RSD":117.25938,"RUB":103.481478,"RWF":1298.369753,"SAR":3.979551,"SBD":8.895821,"SCR":14.452369,"SDG":637.044479,"SEK":11.494957,"SGD":1.445398,"SHP":1.291098,"SLE":23.92494,"SLL":20956.797348,"SOS":604.294044,"SSP":638.257944,"SRD":40.555907,"STD":21962.703276,"SYP":13796.394911,"SZL":20.270992,"THB":38.666691,"TJS":11.623797,"TMT":3.713863,"TND":3.369536,"TOP":2.535348,"TRY":29.093023,"TTD":7.185649,"TWD":34.111615,"TZS":2658.064554,"UAH":39.098436,"UGX":3975.491405,"USD":1.061104,"UYU":40.548981,"UZS":12897.808676,"VEF":3629481.576406,"VES":36.351344,"VND":25790.124308,"VUV":130.171303,"WST":2.963468,"XAF":658.834013,"XAG":0.046043,"XAU":0.000567,"XCD":2.867686,"XDR":0.807264,"XOF":658.837131,"XPF":120.382243,"YER":265.64739,"ZAR":19.945305,"ZMK":9551.202367,"ZMW":21.992139,"ZWL":341.674944}}'),
                    new Response(200, [], '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Visa/Dankort","prepaid":false,"country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank","url":"www.jyskebank.dk","phone":"+4589893300","city":"Hjørring"}}'),
                    new Response(200, [], '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Visa/Dankort","prepaid":false,"country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank","url":"www.jyskebank.dk","phone":"+4589893300","city":"Hjørring"}}'),
                    new Response(200, [], '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Visa/Dankort","prepaid":false,"country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank","url":"www.jyskebank.dk","phone":"+4589893300","city":"Hjørring"}}'),
                    new Response(200, [], '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Visa/Dankort","prepaid":false,"country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank","url":"www.jyskebank.dk","phone":"+4589893300","city":"Hjørring"}}'),
                ],
'1
0.530552
15817.6595
1.3794352
17.30798
',
            ],

        ];
    }
}
