<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<head>
    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>

<div class="col-sm-12">
    <div class="page-content-wrapper ">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-tittle text-center">Data Transaksi</h4>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <button type="button" class="btn btn-info m-b-10 m-l-10 waves-effect waves-light" data-target="#addModal" data-toggle="modal">
                                <i class="fa fa-plus-circle m-r-5"></i>Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapengurus">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Meter Bulan Ini</th>
                                                <th>Meter Bulan Lalu</th>
                                                <th>Tarif</th>
                                                <th>Jumlah Pemakaian</th>
                                                <th>Biaya Sampah</th>
                                                <th>Total Biaya</th> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $no = 0;
                                            $jumlahpakai = 0;
                                            $mbi = 0;
                                            $mbl = 0;
                                            $biayasampah = 0;
                                            $totalbiaya = 0;
                                            foreach ($transaksi as $val) {
                                                $no++;
                                                $mbi += $val['meterblnini'];
                                                $mbl += $val['meterblnlalu'];
                                                $jumlahpakai = $mbi - $mbl;
                                                if ($val['klass'] == 'Ekonomi') {
                                                    $biayasampah = 10000;
                                                } else {
                                                    $biayasampah = 0;
                                                }


                                            ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['id'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['tglbayar'] ?></td>
                                                    <td><?= $val['meterblnini'] ?></td>
                                                    <td><?= $val['meterblnlalu'] ?></td>
                                                    <td><?= $val['tarif'] ?></td>
                                                    <td><?= $jumlahpakai ?>
                                                    </td>
                                                    <td>
                                                        <?= $biayasampah ?>
                                                    </td>
                                                    <td>
                                                        <?= ($val['tarif'] * $jumlahpakai) + $biayasampah; ?>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div> <!--end row-->
    </div>
</div>

<!-- TAMBAH DATA -->
<form action="/transaksi/save" method="post">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4> Periksa Entrian Form Anda<h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" id="addModal" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
    <?php endif; ?>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaksi</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_pelanggan" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>&nbsp; &nbsp;
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="idpelanggan" readonly id="idpelanggan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <input type="text" readonly name="nama" id="nama" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tarif</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_tarif" class="btn btn-xs btn-primary">Tarif</button>
                                </div>
                            </div>&nbsp; &nbsp;
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="idagenda" readonly id="idagenda" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Klass</label>
                                    <input type="text" readonly name="klass" id="klass" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Meter Bulan Ini</label>
                        <input type="number" class="form-control " name="meterbulanini">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Meter Bulan Lalu</label>
                        <input type="number" class="form-control " name="meterbulanlalu">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Tanggal Bayar</label>
                        <input type="date" class="form-control " name="tanggal" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="modal_pelanggan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data_pelanggan as $d) :
                            $no++; ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?= $d->id ?></td>
                                <td><?= $d->nama ?></td>
                                <td><?= $d->nohp ?></td>
                                <td><?= $d->alamat ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="return pilih_pelanggan('<?= $d->id ?>','<?= $d->nama ?>')">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tarif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Tarif</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Klass</th>
                            <th>Tarif</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data_tarif as $d) :
                            $no++; ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?= $d->idtarif ?></td>
                                <td><?= $d->klass ?></td>
                                <td><?= $d->tarif ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="return pilih_tarif('<?= $d->idtarif ?>','<?= $d->klass ?>')">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function pilih_pelanggan(id, nama) {
        $('#idpelanggan').val(id);
        $('#nama').val(nama);
        $('.idpelanggan').val(id);
        $('.nama').val(nama);
        $('#modal_pelanggan').modal().hide();
    }

    function pilih_tarif(id, nama) {
        $('#idagenda').val(id);
        $('#klass').val(nama);
        $('.idagenda').val(id);
        $('.klass').val(nama);
        $('#modal_tarif').modal().hide();
    }
</script>
<?= $this->endSection('') ?>