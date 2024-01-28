 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?=base_url('kategori_buku/create')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Judul Kategori</th>
                           <th>Deskripsi Kategori</th>
                           <th style="min-width: 100px">Action</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                         ?>
                         <tr>
                           <td><?= $no++ ?></td>
                           <td><?php echo $riz->nama_kategori ?></td>

                           <td>
                             <?php if ($riz->deskripsi_kategori !== null): ?>
                               <?= $riz->deskripsi_kategori ?>
                            <?php else: ?>
                               -
                            <?php endif; ?>
                         </td>

                       <td>
                        <a href="<?php echo base_url('kategori_buku/edit/'. $riz->id_kategori)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>

                        <a href="<?php echo base_url('kategori_buku/delete/'. $riz->id_kategori)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
              <!--  <tfoot>
                  <tr>
                     <th>No.</th>
                     <th>Foto</th>
                     <th>Username</th>
                     <th>Level</th>
                     <th style="min-width: 100px">Action</th>
                  </tr>
               </tfoot> -->

            </table>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<!-- <script>
   $(document).ready(function() {
      $('#table2').DataTable({
      });
   });
</script> -->