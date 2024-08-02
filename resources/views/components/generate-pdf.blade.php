<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generated PDF</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
</head>
<body>
    @foreach ($livestocks as $livestock)
        
        <table width="100%" style="page-break-after: always">
            <tr>
                <td align="left">
                    <h3 style="font-size: 24px">{{$livestock['livestock_info']['given_name']}}</h3>
                    <h5 style="font-size: 12px; margin: -1rem 0 0 0;">RFID-TAG: {{$livestock['RFID_TAG']}}</h5>
                    <hr>
                    {{-- <pre style="font-size: 16px; margin-top: -1rem;">       
<b>Sire:</b> {{$livestock['livestock_info']['sire'] == NULL ? "Not Available" : $livestock['livestock_info']['sire']}}                 <b>Dam:</b> {{$livestock['livestock_info']['dam'] == NULL ? "Not Available" : $livestock['livestock_info']['dam']}}
                    </pre> --}}

                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; text-transform: uppercase; font-weight: bold" colspan="100">Livestock Information</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="white-space: nowrap;"><b>Sex:</b> {{$livestock['livestock_info']['sex']}}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Breed:</b> {{$livestock['livestock_info']['breed']}}</td>
                            <td style="padding: 0 2rem 0 0; white-space: nowrap;"><b>Farm:</b> {{$livestock['livestock_info']['farm_name']}}</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="padding: 0 2rem 0 0; white-space: nowrap;"><b>Birth Date:</b> {{$livestock['livestock_info']['birth_date']}}</td>
                        </tr>
                        <br>
                        <tr style="margin-top: 2rem;">
                            <td style="font-size: 18px; text-transform: uppercase; font-weight: bold" colspan="100">Parents</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="white-space: nowrap;"><b>Sire:</b> {{$livestock['livestock_info']['sire'] == NULL ? "Not Available" : $livestock['livestock_info']['sire'] }}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Dam:</b> {{$livestock['livestock_info']['dam'] == NULL ? "Not Available" : $livestock['livestock_info']['dam'] }}</td>
                        </tr>
                        <br>
                        <tr style="margin-top: 2rem;">
                            <td style="font-size: 18px; text-transform: uppercase; font-weight: bold" colspan="100">Birth Info</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="white-space: nowrap;"><b>Birth Date:</b> {{$livestock['birth_info']['birth_date']}}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Birth Season:</b> {{$livestock['birth_info']['birth_season']}}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Birth Type:</b> {{$livestock['birth_info']['birth_type']}}</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="white-space: nowrap;"><b>Milk Type:</b> {{$livestock['birth_info']['milk_type']}}</td>
                        </tr>
                        <br>
                        <tr style="margin-top: 2rem;">
                            <td style="font-size: 18px; text-transform: uppercase; font-weight: bold" colspan="100">Characteristic</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="white-space: nowrap;"><b>Jaw Type:</b> {{$livestock['characteristic']['jaw']}}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Ear Type:</b> {{$livestock['characteristic']['ear']}}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Body Color:</b> {{$livestock['characteristic']['body']}}</td>
                        </tr>
                        <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                            <td style="white-space: nowrap;"><b>Teat Type:</b> {{$livestock['characteristic']['teat']}}</td>
                            <td style="padding: 0 2rem; white-space: nowrap;"><b>Horn Type:</b> {{$livestock['characteristic']['horn']}}</td>
                        </tr>

                        <br><br>

                        <tr style="margin-top: 2rem;">
                            <td style="font-size: 18px; text-transform: uppercase; font-weight: bold; border-bottom: 1px solid black;" colspan="100">Weight Progress</td>
                        </tr>
                        <?php $count = 0; ?>
                        @foreach($progress as $item)
                            @if ($livestock['RFID_TAG'] == $item['RFID_TAG'])
                                    @php
                                        $formattedDate = \Carbon\Carbon::parse($item['date'])->format('Y-m-d');
                                        $sec = strtotime($item['date']);

                                        $newdate = date("F d Y", $sec);  
                                    @endphp 
                                <tr style="margin-top: 2rem;">
                                    <td style="font-size: 14px; text-transform: uppercase; font-weight: bold" colspan="100">{{$newdate}}</td>
                                </tr>
                                <tr style="font-size: 16px; padding: 1rem 2rem; margin-top: 1rem;">
                                    <td style="white-space: nowrap;"><b>Body Weight:</b> {{$item['weight']}}</td>
                                    <td style="padding: 0 2rem; white-space: nowrap;"><b>Body Length:</b> {{$item['length']}}</td>
                                    <td style="padding: 0 2rem; white-space: nowrap;"><b>Wither Height:</b> {{$item['wither']}}</td>
                                </tr>
                                <br>
                            @endif
                        @endforeach
                    </table>
                </td>
            </tr>

        </table>

    @endforeach
  

</body>
</html>