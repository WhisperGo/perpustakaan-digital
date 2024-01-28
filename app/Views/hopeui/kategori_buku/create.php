<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('kategori_buku/aksi_create')?>" method="post">
                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Judul Kategori:</label>
                           <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Judul Kategori">
                        </div>
                        <div class="form-group col-md-12 mt-2">
                           <label class="form-label" for="fname">Deskripsi Kategori (Opsional):</label>
                           <textarea class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" placeholder="Masukkan Deskripsi Kategori (Opsional)"></textarea>
                        </div>
                     </div>
                     <a href="javascript:history.back()" class="btn btn-danger mt-4">Cancel</a>
                     <button type="submit" class="btn btn-primary mt-4">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>