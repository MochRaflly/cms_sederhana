    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
<!-- Custom JS -->
<script src="assets/js/custom.js"></script>

<!-- User Settings Modal -->
<div class="modal fade" id="userSettingsModal" tabindex="-1" role="dialog" aria-labelledby="userSettingsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userSettingsModalLabel">Pengaturan Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userSettingsForm">
          <div class="form-group">
            <label for="userName">Nama</label>
            <input type="text" class="form-control" id="userName" placeholder="Nama Anda" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="userEmail">Email</label>
            <input type="email" class="form-control" id="userEmail" placeholder="Email Anda" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
          </div>
          <div class="form-group">
            <label for="userPassword">Password Baru</label>
            <input type="password" class="form-control" id="userPassword" placeholder="Password Baru">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Profil User -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="<?php echo isset($_SESSION['user_avatar']) ? $_SESSION['user_avatar'] : 'assets/img/default-avatar.png'; ?>" class="img-circle elevation-2 mb-3" alt="User Image" style="width:80px;height:80px;object-fit:cover;">
        <h5><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User'; ?></h5>
        <p class="mb-1 text-muted"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '-'; ?></p>
        <span class="badge badge-info">Role: <?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'user'; ?></span>
        <hr>
        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#userSettingsModal" data-dismiss="modal">Edit Profil</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ubah Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="changePasswordForm">
          <div class="form-group">
            <label for="currentPassword">Password Lama</label>
            <input type="password" class="form-control" id="currentPassword" required>
          </div>
          <div class="form-group">
            <label for="newPassword">Password Baru</label>
            <input type="password" class="form-control" id="newPassword" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="confirmPassword" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
</body>
</html> 