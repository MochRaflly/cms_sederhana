<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get counts for dashboard
$stmt = $pdo->query("SELECT COUNT(*) FROM posts");
$postCount = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM categories");
$categoryCount = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$userCount = $stmt->fetchColumn();

include 'includes/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                    <h4 class="text-primary font-weight-bold" style="letter-spacing:1px;">MOCH RAFLI PERMANA</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $postCount; ?></h3>
                            <p>Posts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="posts.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $categoryCount; ?></h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="categories.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $userCount; ?></h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Calendar Widget -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <!-- Notifikasi Sistem -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-bell"></i>
                                Notifikasi Sistem
                            </h3>
                            <button class="btn btn-sm btn-primary" onclick="showToast('Contoh notifikasi sukses!', 'success')">Demo Toast</button>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php
                                // Dummy notifikasi sistem
                                $systemNotifications = [
                                    [
                                        'type' => 'info',
                                        'title' => 'Server Online',
                                        'desc' => 'Semua layanan berjalan normal.',
                                        'time' => 'Baru saja'
                                    ],
                                    [
                                        'type' => 'warning',
                                        'title' => 'Maintenance Terjadwal',
                                        'desc' => 'Akan ada maintenance pada 12 Juni 2024, 22:00 WIB.',
                                        'time' => '1 jam lagi'
                                    ],
                                    [
                                        'type' => 'danger',
                                        'title' => 'Update Aplikasi',
                                        'desc' => 'Versi baru CMS tersedia. Silakan update.',
                                        'time' => 'Kemarin'
                                    ],
                                ];
                                foreach ($systemNotifications as $notif):
                                    $icon = $notif['type'] === 'info' ? 'fa-info-circle' : ($notif['type'] === 'warning' ? 'fa-exclamation-triangle' : 'fa-times-circle');
                                    $badge = $notif['type'] === 'info' ? 'info' : ($notif['type'] === 'warning' ? 'warning' : 'danger');
                                ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <span class="mr-2"><i class="fas <?php echo $icon; ?> text-<?php echo $badge; ?>"></i></span>
                                    <div>
                                        <strong><?php echo $notif['title']; ?></strong><br>
                                        <small class="text-muted"><?php echo $notif['desc']; ?></small>
                                    </div>
                                    <span class="ml-auto badge badge-<?php echo $badge; ?>"><?php echo $notif['time']; ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'includes/footer.php'; ?>

<!-- FullCalendar -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<!-- Modal Detail Tanggal Kalender -->
<div class="modal fade" id="calendarDateModal" tabindex="-1" role="dialog" aria-labelledby="calendarDateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calendarDateModalLabel">Post pada <span id="calendarDateTitle"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="calendarDateContent">
        <div class="text-center text-muted">Memuat...</div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            <?php
            $stmt = $pdo->query("
                SELECT title, created_at as start, status 
                FROM posts 
                WHERE status = 'published' 
                ORDER BY created_at DESC
            ");
            $events = $stmt->fetchAll();
            foreach ($events as $event) {
                echo "{\n                    title: '" . addslashes($event['title']) . "',\n                    start: '" . $event['start'] . "',\n                    color: '#28a745'\n                },";
            }
            ?>
        ],
        dateClick: function(info) {
            // Tampilkan modal dan ambil data post pada tanggal info.dateStr
            $('#calendarDateTitle').text(info.dateStr);
            $('#calendarDateContent').html('<div class="text-center text-muted">Memuat...</div>');
            $('#calendarDateModal').modal('show');
            // AJAX ke get_posts_by_date.php
            $.post('get_posts_by_date.php', {date: info.dateStr}, function(res) {
                if (res.success && res.posts.length > 0) {
                    var html = '<ul class="list-group">';
                    res.posts.forEach(function(post) {
                        var badge = post.status === 'published' ? 'success' : 'secondary';
                        html += '<li class="list-group-item">'
                            + '<strong>' + post.title + '</strong><br>'
                            + '<small>' + post.category + ' | <span class="badge badge-' + badge + '">' + post.status.charAt(0).toUpperCase() + post.status.slice(1) + '</span></small>'
                            + '</li>';
                    });
                    html += '</ul>';
                    $('#calendarDateContent').html(html);
                } else {
                    $('#calendarDateContent').html('<div class="text-center text-muted">Tidak ada post pada tanggal ini.</div>');
                }
            }, 'json').fail(function() {
                $('#calendarDateContent').html('<div class="text-center text-danger">Gagal mengambil data.</div>');
            });
        }
    });
    calendar.render();
});
</script> 