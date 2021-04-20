<html>

<head>
    <title>Faktur Pembayaran</title>
    <style>
        #tabel {
            font-size: 20px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }

        @page {
            size: auto;
            margin: 0mm;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:12pt; margin-top:20pt'>
    <center>
        <table style='width:700px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>

            <td width='70%' align='left' style='padding-right:80px; vertical-align:top;'>
                <!-- <img src="<?php echo base_url() . 'assets/kop_insan.png' ?>" alt="" height=80 width=360></img> -->
                <b><span style='font-size:20pt'>PT NMS SAHABAT SOFTWARE</span></b>
                <!-- <span style='font-size:20pt'><b>INSAN DIGITAL PRINTING</I></b></span> -->
                </br>
                Jl. Raya Bobotari Karanganyar Km 1 - Purbalingga </br>
                Telp : (Admin)0852 9078 2792 - 0813 1393 7345</br>
                Email : Insanoffset7@gmail.com</br>
                Facebook : Insan Offsett
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:20pt'>SURAT JALAN</span></b></br>
                Nomor : <?= $keluar['out_id'] ?></br>
                Petugas : <?= $keluar['user_nama'] ?></br>
                Tanggal : <?= $tgl_sj ?>
            </td>
        </table>
        <table style='width:700px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>

            </td>
            <td style='vertical-align:top' width='30%' align='left'>

            </td>
        </table>
        <table cellspacing='0' style='width:700px; font-size:12pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border="0">

            <tr align='center' style="border: 1px solid black;">
                <td width='5%' style="border: 1px solid black;">No</td>
                <td width='45%' style="border: 1px solid black;">Nama Barang</td>
                <td width='20%' style="border: 1px solid black;">Kode Barang</td>
                <td width='10%' style="border: 1px solid black;">Jumlah</td>
                <td width='20%' style="border: 1px solid black;">Satuan</td>
            </tr>

            <?php
            $no = 1;
            foreach ($det_keluar as $dk) { ?>
                <tr style="border: 1px solid black;">
                    <td style='text-align:left;border: 1px solid black;'><?= $no ?></td>
                    <td style='text-align:left;border: 1px solid black;'><?= $dk['dtout_br_nama']  ?></td>
                    <td style='text-align:center;border: 1px solid black;'><?= $dk['dtout_br_id'] ?></td>
                    <td style='text-align:center;border: 1px solid black;'><?= $dk['dtout_qty']  ?></td>
                    <td style='text-align:right;border: 1px solid black;'><?= $dk['sat_barang_nama']  ?></td>
                </tr>
            <?php $no = $no + 1;
            } ?>







        </table>
        <!-- Tabel untuk keterangan jabatan petugas -->
        <table cellspacing='0' style='width:700px; font-size:12pt; font-family:calibri;  border-collapse: collapse; margin-top:10pt' border="0">
            <tr align='center'>
                <td width='5%'></td>
                <td width='45%'></td>
                <td width='20%'>Petugas</td>
                <td width='10%'></td>
                <td width='20%'>Mengetahui</td>
            </tr>
        </table>

        <!-- tabel untuk tempat tanda tangan petugas  -->
        <table cellspacing='0' style='width:700px; font-size:12pt; font-family:calibri;  border-collapse: collapse; margin-top:50pt' border="0">

            <tr align='center'>
                <td width='5%'></td>
                <td width='45%'></td>
                <td width='20%'>(........................)</td>
                <td width='10%'></td>
                <td width='20%'>(........................)</td>
            </tr>
        </table>






    </center>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>