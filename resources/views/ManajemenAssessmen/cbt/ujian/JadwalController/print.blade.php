<html>
<style>
body {
    position: relative;
    width: 20cm;
    height: 29.7cm;
    margin-right: 30px;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 12px;
    font-family: SourceSansPro;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 40px !important;
}
td, th {
    border: 1px solid;
    text-align: left;
    padding: 8px;
}
header:before, header:after {
    content: " ";
    display: table;
}
header:after {
    clear: both;
}
.date {
    font-size: 15px;
    margin-left: 0px;
}
.title {
    margin-right: 20px;
}
.logo {
    float: left;
}
</style>

<title>Daftar Peserta Ujian</title>
<body>

<header>
    <div class="logo">
        <img width="150px" height="100px" src="{{ public_path().'/assets/theme/global/img/logo-ticmi.png' }}">
    </div>
    
    <div class="title">
	    <h1>Daftar Peserta Ujian</h1>
	</div>
</header>

<hr>
<br />

<p><strong>Pengawas </strong>: {{ $pengawas ?? '' }}</p>
<p><strong>Tanggal </strong> &nbsp;&nbsp;: {{ $tgl_perdana }}</p>
<p><strong>Hari </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $hari ?? '' }}</p>
<p><strong>Jam </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $jam ?? '' }}</p>

<br />
<table> 
    <tr>
        <th width="200" height="10"><center>Peserta</center></th>
        <th width="200" height="10"><center>Tanda Tangan</center></th>
    </tr>
        @if(count($pesertas))
            @foreach($pesertas as $peserta)
            <tr>
                <td>{{ $peserta->name }}</td>
                <td></td>
            </tr>  
            @endforeach
        @else
            <tr>
                <td colspan="2"><center>Tidak ada Peserta</center></td>
            </tr>

        @endif
</table>
</html>