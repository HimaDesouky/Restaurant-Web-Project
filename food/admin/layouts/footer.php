</div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  
  <script>
    // Initialize DataTable
    $(document).ready(function() {
      $('#studentTable').DataTable({
        "pageLength": 10,
        "language": {
          "search": "Search:",
          "lengthMenu": "Show _MENU_ entries",
          "info": "Showing _START_ to _END_ of _TOTAL_ entries",
          "paginate": {
            "previous": "Previous",
            "next": "Next"
          }
        }
      });
    });

    // Sidebar toggle functionality
    document.getElementById('sidebarToggle').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('content');
      const toggleIcon = this.querySelector('i');
      
      sidebar.classList.toggle('collapsed');
      content.classList.toggle('expanded');
      
      if (sidebar.classList.contains('collapsed')) {
        toggleIcon.classList.remove('fa-chevron-left');
        toggleIcon.classList.add('fa-chevron-right');
      } else {
        toggleIcon.classList.remove('fa-chevron-right');
        toggleIcon.classList.add('fa-chevron-left');
      }
    });

    // Mobile sidebar toggle
    document.getElementById('mobileToggle').addEventListener('click', function() {
      document.getElementById('sidebar').classList.toggle('mobile-open');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
      const sidebar = document.getElementById('sidebar');
      const mobileToggle = document.getElementById('mobileToggle');
      
      if (window.innerWidth <= 768 && 
          !sidebar.contains(event.target) && 
          !mobileToggle.contains(event.target) && 
          sidebar.classList.contains('mobile-open')) {
        sidebar.classList.remove('mobile-open');
      }
    });

    // Auto-hide sidebar on small screens
    function handleResize() {
      const sidebar = document.getElementById('sidebar');
      
      if (window.innerWidth <= 768) {
        sidebar.classList.remove('collapsed');
        document.getElementById('content').classList.remove('expanded');
      }
    }
    
    // Initial check
    handleResize();
    
    // Listen for resize events
    window.addEventListener('resize', handleResize);
  </script>
</body>
</html>