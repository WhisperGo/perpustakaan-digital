 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <!-- <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Bootstrap Datatables</h4>
               </div>
            </div> -->

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Foto</th>
                           <th>Username</th>
                           <th>Level</th>
                           <!-- <th style="min-width: 100px">Action</th> -->
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                          ?>
                          <tr>
                           <td><?= $no++ ?></td>
                           <td style="width: 100px; height: 100px; overflow: hidden; border-radius: 5px;">
                             <img src="<?= base_url('profile/' . $riz->foto) ?>" style="width: 100%; height: 100%; object-fit: contain;">
                          </td>
                          <td><?php echo $riz->username ?></td>
                          <td><?php echo $riz->nama_level ?></td>
                          <!-- <td>
                           <a href="<?php echo base_url('data_siswa/edit_siswa/'. $b->user)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>

                           <a href="<?php echo base_url('data_siswa/delete_siswa/'. $b->user)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
                        </td> -->
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