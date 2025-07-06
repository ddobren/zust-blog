document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileToggle = document.getElementById('mobileToggle');
    const overlay = document.getElementById('overlay');
    const links = document.querySelectorAll('.nav-link[data-hash]');

    function isMobile() {
        return window.innerWidth < 768;
    }

    function toggleSidebar() {
        if (isMobile()) {
            sidebar.classList.toggle('expanded');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('expanded') ? 'hidden' : '';
        } else {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }
    }

    function activateLinkFromHash() {
        const hash = window.location.hash.replace('#', '');
        links.forEach(link => {
            const target = link.getAttribute('data-hash');
            link.classList.toggle('active', target === hash);
        });
    }

    // Init
    if (!window.location.hash) {
        window.location.hash = '#dashboard';
    }
    activateLinkFromHash();

    // Events
    if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
    if (mobileToggle) mobileToggle.addEventListener('click', toggleSidebar);
    if (overlay) overlay.addEventListener('click', function () {
        sidebar.classList.remove('expanded');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    });
    window.addEventListener('resize', function () {
        if (isMobile()) {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
            if (sidebar.classList.contains('expanded')) {
                overlay.classList.add('active');
            }
        } else {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    window.addEventListener('hashchange', activateLinkFromHash);
});
