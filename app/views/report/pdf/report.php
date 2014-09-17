<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title></title>
    <meta name="generator" content="">
    <meta name="author" content="Malte Goldenbaum">

    <style type="text/css">
        <!--
        @page { margin: 2cm }
        p { margin-bottom: 0.21cm }
        td p { margin-bottom: 0cm }
        a:link { so-language: zxx }

        .td_header {
            font-size:11px;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.1cm; padding-bottom: 0.1cm; padding-left: 0.1cm; padding-right: 0cm;
        }

        .td_day {
            font-size:8px;text-align:center;border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0cm; padding-bottom: 0.1cm; padding-left: 0.1cm; padding-right: 0cm;
        }

        .td_text_container {
            font-size:11px;border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0cm; padding-bottom: 0.1cm; padding-left: 0.1cm; padding-right: 0cm;
        }

        .td_einzel{
            font-size:11px;border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0cm; padding-bottom: 0.1cm; padding-left: 0.1cm; padding-right: 0cm;
        }

        .td_gesamt {
            font-size:13px;vertical-align:bottom;text-align:center;border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-top: 0cm; padding-bottom: 0.1cm; padding-left: 0.1cm; padding-right: 0.1cm;
        }
        -->
    </style>
</head>
<body lang="de-DE" dir="ltr">

<table width="100%" cellpadding="4" cellspacing="0">
    <col width="128*">
    <col width="128*">
    <tr valign="top">
        <td width="45%" style="border: none; padding: 0cm">
            <p>Ausbildungsnachweis Nr. [%NR%]</p>
        </td>
        <td width="55%" style="border: none; padding: 0cm">
            <p>Ausbildungsabteilung: [%COMPANY%] - [%ABTEILUNG%]</p>
            <p style="font-size: 11px;">
                Ausbildungswoche vom: [%WEEK START%] bis [%WEEK ENDE%]
                <br />
                Ausbildungsjahr: [%JAHR%]
                <br />
                <br />
            </p>
        </td>
    </tr>
</table>


<table width="570" cellpadding="4" cellspacing="0">
    <col width="18">
    <col width="400">
    <col width="26">
    <col width="26">
    <tr valign="top">
        <td width="18" height="3" class="td_header">
            <p><font size="1" style="font-size: 8pt">Tag</font></p>
        </td>
        <td width="400" class="td_header">
            <p><font size="1" style="font-size: 8pt">Ausgeführte Arbeiten,
                    Unterricht, usw...</font></p>
        </td>
        <td width="26" class="td_header">
            <p><font size="1" style="font-size: 6pt">Einzel</font></p>
        </td>
        <td width="26" style="border: 1px solid #000000; padding: 0.1cm">
            <p><font size="1" style="font-size: 6pt">Gesamt</font></p>
        </td>
    </tr>
    <tr valign="top">
        <td width="18" height="89" class="td_day">
            <br />
            <br />
            M<br />
            O<br />
            N<br />
            T<br />
            A<br />
            G<br />
            <br />
            <br />
        </td>
        <td width="400" class="td_text_container">
            [%MO_TEXT%]
        </td>
        <td width="26" class="td_einzel">
            [%MO_EINZEL%]
        </td>
        <td width="26" class="td_gesamt">
            [%MO_GESAMT%]
        </td>
    </tr>
    <tr valign="top">
        <td width="18" class="td_day">
            <br />
            D<br />
            I<br />
            E<br />
            N<br />
            S<br />
            T<br />
            A<br />
            G<br />
            <br />
        </td>
        <td width="400" class="td_text_container">
            [%DI_TEXT%]
        </td>
        <td width="26" class="td_einzel">
            [%DI_EINZEL%]
        </td>
        <td width="26" class="td_gesamt">
            [%DI_GESAMT%]
        </td>
    </tr>
    <tr valign="top">
        <td width="18"  class="td_day">
            <br />
            M<br />
            I<br />
            T<br />
            T<br />
            W<br />
            O<br />
            C<br />
            H<br />
            <br />
        </td>
        <td width="400" class="td_text_container">
            [%MI_TEXT%]
        </td>
        <td width="26" class="td_einzel">
            [%MI_EINZEL%]
        </td>
        <td width="26" class="td_gesamt">
            [%MI_GESAMT%]
        </td>
    </tr>
    <tr valign="top">
        <td width="18" class="td_day">
            D<br />
            O<br />
            N<br />
            N<br />
            E<br />
            R<br />
            S<br />
            T<br />
            A<br />
            G
        </td>
        <td width="400" class="td_text_container">
            [%DO_TEXT%]
        </td>
        <td width="26" class="td_einzel">
            [%DO_EINZEL%]
        </td>
        <td width="26" class="td_gesamt">
            [%DO_GESAMT%]
        </td>
    </tr>
    <tr valign="top">
        <td width="18" class="td_day">
            <br />
            F<br />
            R<br />
            E<br />
            I<br />
            T<br />
            A<br />
            G<br />
            <br />
        </td>
        <td width="400" class="td_text_container">
            [%FR_TEXT%]
        </td>
        <td width="26" class="td_einzel">
            [%FR_EINZEL%]
        </td>
        <td width="26" class="td_gesamt">
            [%FR_GESAMT%]
        </td>
    </tr>
</table>


<table width="570" cellpadding="4" cellspacing="0">
    <col width="580">
    <col width="38">
    <tr valign="top">
        <td width="605" height="6" style="border-left: 1px solid #000000;border-bottom: 1px solid #000000; padding: 0.1cm">
            <p align="right">
                <span style="font-size: 10pt">Wochenstunden:</span>
            </p>
        </td>
        <td width="38" style="border-left: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000; padding: 0.1cm">
            [%WOCHE_GESAMT%]
        </td>
    </tr>
</table>


<br /><br />


<table width="570" cellpadding="4" cellspacing="0">
    <col width="235">
    <col width="235">
    <tr valign="top">
        <td width="240" style="max-height:80px;border: 1px solid #000000; padding: 0.1cm;">
            <p><br>
            </p>
            <p><br>
            </p>
            <p><br>
            </p>
            <p><?=date('d.m.Y')?></p>
        </td>
        <td width="240" style="border: 1px solid #000000; border-left:0px; padding: 0.1cm;">
            <p><br>
            </p>
            <p><br>
            </p>
            <p><br>
            </p>
            <p><?=date('d.m.Y')?></p>
        </td>
    </tr>
    <tr valign="top">
        <td width="306" class="td_einzel">
            <p align="center"><span style="font-size: 10pt;">Auszubildender</span></p>
            <p align="center"><span style="font-size: 6pt">Unterschriftund Datum</span></p>
        </td>
        <td width="320" class="td_gesamt">
            <p align="center"><span style="font-size: 10pt;">Ausbildender</span></p>
            <p align="center"><span style="font-size: 6pt">Unterschrift und Datum</span></p>
        </td>
    </tr>
</table>
<p><br>
</p>
</body>
</html>