// Loading Animation
document.addEventListener('DOMContentLoaded', function() {
    // Show loading animation
    const loading = document.createElement('div');
    loading.className = 'loading';
    document.body.appendChild(loading);

    // Hide loading animation when page is loaded
    window.addEventListener('load', function() {
        loading.style.display = 'none';
    });
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Card Hover Effect
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// Form Input Animation
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Table Row Animation
document.querySelectorAll('.table tbody tr').forEach(row => {
    row.addEventListener('mouseenter', function() {
        this.style.backgroundColor = 'rgba(78, 115, 223, 0.1)';
    });
    
    row.addEventListener('mouseleave', function() {
        this.style.backgroundColor = '';
    });
});

// Button Click Animation
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        this.appendChild(ripple);
        
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${e.clientX - rect.left - size/2}px`;
        ripple.style.top = `${e.clientY - rect.top - size/2}px`;
        
        ripple.classList.add('active');
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add ripple effect CSS
const style = document.createElement('style');
style.textContent = `
    .btn {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Toast Notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-header">
            <strong class="mr-auto">Notification</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                <span>&times;</span>
            </button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;
    
    document.body.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast, {
        animation: true,
        autohide: true,
        delay: 3000
    });
    
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', function() {
        toast.remove();
    });
}

// Add toast CSS
const toastStyle = document.createElement('style');
toastStyle.textContent = `
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 250px;
        background: white;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        animation: slideIn 0.5s ease-out;
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .toast-success {
        border-left: 4px solid #28a745;
    }
    
    .toast-error {
        border-left: 4px solid #dc3545;
    }
    
    .toast-warning {
        border-left: 4px solid #ffc107;
    }
    
    .toast-info {
        border-left: 4px solid #17a2b8;
    }
`;
document.head.appendChild(toastStyle);

// Sidebar Mini Toggle
$(function() {
    // Aktifkan tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Toggle sidebar mini
    $('#sidebarToggle').on('click', function() {
        $('.main-sidebar').toggleClass('sidebar-mini');
        // Ganti icon arah
        $(this).find('i').toggleClass('fa-angle-double-left fa-angle-double-right');
    });

    // Highlight menu aktif otomatis
    var path = window.location.pathname.split('/').pop();
    $('.nav-sidebar .nav-link').each(function() {
        var href = $(this).attr('href');
        if (href === path) {
            $(this).addClass('active');
        }
    });
});

// DARK MODE TOGGLE
$(function() {
    // Set mode dari localStorage
    if (localStorage.getItem('darkMode') === 'true') {
        $('body').addClass('dark-mode');
        $('#darkModeToggle i').removeClass('fa-moon').addClass('fa-sun');
    }
    // Toggle dark mode
    $('#darkModeToggle').on('click', function() {
        $('body').toggleClass('dark-mode');
        const isDark = $('body').hasClass('dark-mode');
        localStorage.setItem('darkMode', isDark);
        // Ganti icon
        if (isDark) {
            $('#darkModeToggle i').removeClass('fa-moon').addClass('fa-sun');
        } else {
            $('#darkModeToggle i').removeClass('fa-sun').addClass('fa-moon');
        }
    });

    // Handler AJAX untuk form pengaturan pengguna
    $('#userSettingsForm').on('submit', function(e) {
        e.preventDefault();
        var name = $('#userName').val();
        var email = $('#userEmail').val();
        var password = $('#userPassword').val();
        $.post('user_settings_update.php', {
            name: name,
            email: email,
            password: password
        }, function(res) {
            if (res.success) {
                showToast(res.message, 'success');
                $('#userSettingsModal').modal('hide');
                // Update nama/email di session jika perlu (reload page)
                setTimeout(function(){ location.reload(); }, 1000);
            } else {
                showToast(res.message, 'error');
            }
        }, 'json').fail(function() {
            showToast('Gagal terhubung ke server.', 'error');
        });
    });
});

// SMART SEARCH BAR
$(function() {
    var $input = $('#smartSearchInput');
    var $dropdown = $('#smartSearchDropdown');
    var typingTimer;
    $input.on('input', function() {
        clearTimeout(typingTimer);
        var q = $input.val().trim();
        if (q.length < 2) {
            $dropdown.removeClass('show').empty();
            return;
        }
        typingTimer = setTimeout(function() {
            $.get('search_suggestions.php', {q: q}, function(res) {
                if (res.success && res.results.length > 0) {
                    var html = '';
                    res.results.forEach(function(item) {
                        var icon = item.type === 'post' ? 'fa-file-alt' : (item.type === 'category' ? 'fa-list' : 'fa-user');
                        var color = item.type === 'post' ? 'text-primary' : (item.type === 'category' ? 'text-success' : 'text-warning');
                        html += '<a href="' + item.url + '" class="dropdown-item d-flex align-items-center">'
                            + '<i class="fas ' + icon + ' mr-2 ' + color + '"></i>'
                            + '<span>' + item.label + '</span>'
                            + '<span class="ml-auto badge badge-light">' + item.type.charAt(0).toUpperCase() + item.type.slice(1) + '</span>'
                            + '</a>';
                    });
                    $dropdown.html(html).addClass('show');
                } else {
                    $dropdown.html('<span class="dropdown-item text-muted">Tidak ditemukan</span>').addClass('show');
                }
            }, 'json');
        }, 250);
    });
    // Hide dropdown on blur
    $input.on('blur', function() { setTimeout(function() { $dropdown.removeClass('show'); }, 200); });
    // Show dropdown on focus if ada hasil
    $input.on('focus', function() { if ($dropdown.children().length) $dropdown.addClass('show'); });
}); 