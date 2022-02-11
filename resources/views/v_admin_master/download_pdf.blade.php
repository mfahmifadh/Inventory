<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table .header-confirm img {
          margin: auto;
        }

        table .header-confirm {
          border-bottom: solid;
        }

        table .header-confirm td {
          border-bottom: solid;
        }

        table .header-confirm .header-text-confirm {
          margin-left: 10vh;
        }

        table .confirm-txt-tanggal {
          text-align: right;
        }
    </style>

</head>
<body>
    @foreach($order as $data)
    <table class="table table-borderless">
      	<thead style="border-bottom:2px solid;">
             <tr>
                <td style="width:10vh;"><center><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKzZQs3D4Vt5POv9EQ_KFwAeWaqINj-EMDavuBvppwuSBrGCg02erpMjOTRB_0GTLeXJ4&usqp=CAU" width="100" height="120"></center></td>
                <td class="header-text-confirm">
                    <center>
                        <font size="3"><b><br>KEMENTRIAN KESEHATAN REPUBLIK INDONESIA</b></font><br>
                        <font size="2">BIRO UMUM RUMAH TANGGA SEKRETARIAT JENDRAL</font><br>
                        <font size="1"><i>Jl. H.R. Rasuna Said Blok X.5 Kav. 4-9, Blok A, 2nd Floor, Jakarta 12950<br>Telp.: (62-21) 5201587, 5201591 Fax. (62-21) 5201591</i></font>
                    </center>
                </td>
                <td style="width:10vh;"><center><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRrCbZvrdscA0Q6W3-_ulxUQhC2EK2zCSDfs8gYvq_lJQ0pYMy3dsbdd7ikXz-PPr_sQk&usqp=CAU" width="100" height="110"></center></td>
            </tr>
        </thead>
        <hr style="">
        <tbody>
              <tr style="font-size:15px;">
                <td class="confirm-txt-tanggal" colspan="3">{{ date('d F Y', strtotime($data->order_dt)) }}</td>
              </tr> 
              <tr style="font-size:15px;">
                <td>Nomor</td>
                <td colspan="2"> : {{ $data->letter_num }} </td>
              </tr>
              <tr style="font-size:15px;">
                <td>Perihal</td>
                <td colspan="2"> : {{ $data->order_category }} Barang</td>
              </tr>
              <tr style="font-size:12px;">
                <td style="padding-top:5vh;" colspan="3">
                  Bersama dengan surat ini, Satuan Kerja <b>{{ $data->workunit_name }}</b> telah melakukan <b> {{ $data->order_category }} Barang</b>, dengan data barang sebagai berikut : <br><br>
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th>No</th>
                      <th>Kategori Barang</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>ID Pallet</th>
                      <th>Gudang</th>
                    </tr>
                    <?php $no=1;?>
                    @foreach($dataitem as $row)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $row->itemcategory_name }}</td>
                      <td>{{ $row->item_name }}</td>
                      <td>{{ $row->item_qty }}</td>
                      <td>{{ $row->slot_id }}</td>
                      <td>{{ $row->warehouse_name }}</td>
                    @endforeach
                    </tr>
                  </table>
                </td>
              </tr>
              <tr style="font-size:15px;">
                <td colspan="3">Jakarta, {{ date('d F Y', strtotime($data->order_dt)) }}</td>
              </tr>
              <tr style="font-size:12px;">
                <td><b>PETUGAS</b><br><br><br></td>
                <td style="padding-left: 10vh;"><b>SATUAN KERJA</b><br><br><br></td>
              </tr>
              <tr style="font-size:12px;">
                <td style="padding-top:10vh;text-transform: uppercase;">
                  <!-- <p style="border-bottom: solid;"></p> -->
                  <b>{{ $data->full_name }}</b>
                </td>
                <td style="padding-left: 10vh;padding-top:10vh;">
                  <!-- <p style="width:15vh;border-top: solid;"></p> -->
                  <b style="margin-top:10vh;">{{ $data->workunit_name }}</b>
                </td>
              </tr>
            </tbody>
    </table>
    @endforeach


</body>
</html>