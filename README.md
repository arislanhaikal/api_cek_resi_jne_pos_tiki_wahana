# API Cek Resi JNE POS TIKI WAHANA

<p>This is simple api for check resi <b>jne</b>, <b>pos</b>, <b>tiki</b> and <b>wahana</b></p>

<h5>Usage</h5>
<p>You must send two params</p>
<table>
    <tr>
        <td><strong>Params</strong></td>
        <td><strong>Desc</strong></td>
    </tr>
    <tr>
        <td>courier</td>
        <td>courier name (jne, pos, tiki, wahana)</td>
    </tr>
    <tr>
        <td>resi</td>
        <td>your resi number</td>
    </tr>
</table>

<h5>Example</h5>
<pre>http://localhost/cekresi_api/?courier=wahana&resi=AKX23859</pre>

<h5>Response</h5>
<pre>
 {
  "status": 200,
  "courier": "WAHANA",
  "resi": "AKX23859",
  "track": [
    {
      "date": "Aug 04, 2018",
      "time": "09:59 am",
      "status": "intransit",
      "location": "Dalam proses pengiriman ke kota tujuan",
      "country": "Indonesia"
    },
    {
      "date": "Aug 01, 2018",
      "time": "03:08 am",
      "status": "intransit",
      "location": "Dalam proses pengiriman ke kota tujuan",
      "country": "Indonesia"
    },
    {
      "date": "Jul 31, 2018",
      "time": "10:32 pm",
      "status": "intransit",
      "location": "Diterima di fasilitas kota asal",
      "country": "Indonesia"
    },
    {
      "date": "Jul 31, 2018",
      "time": "08:25 pm",
      "status": "intransit",
      "location": "Diterima di sales counter",
      "country": "Indonesia"
    },
    {
      "date": "Jul 31, 2018",
      "time": "08:25 pm",
      "status": "intransit",
      "location": "",
      "country": "Indonesia"
    }
  ]
}
</pre>
