document.addEventListener('DOMContentLoaded', function(){
  const hamburger = document.getElementById('hamburger');
  const sidebar = document.getElementById('sidebar');
  const layout = document.querySelector('.layout');
  const main = document.querySelector('.main');

  if(!hamburger || !sidebar || !main) return;

  function openSidebar(){
    sidebar.classList.add('active');
    layout.classList.add('sidebar-open');
  }
  function closeSidebar(){
    sidebar.classList.remove('active');
    layout.classList.remove('sidebar-open');
  }
  function toggleSidebar(){
    sidebar.classList.toggle('active');
    layout.classList.toggle('sidebar-open');
  }

  hamburger.addEventListener('click', function(e){
    e.stopPropagation();
    toggleSidebar();
  });

  // tutup saat klik di luar (hanya untuk layar kecil)
  document.addEventListener('click', function(e){
    if(!sidebar.classList.contains('active')) return;
    if(e.target.closest('#sidebar') || e.target.closest('#hamburger')) return;
    // if viewport narrow, close; on wide screens we keep (optional)
    if(window.innerWidth < 900){
      closeSidebar();
    }
  });

  // tutup dengan ESC
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape') closeSidebar();
  });

  // membuat sidebar push pada resize (simple)
  window.addEventListener('resize', function(){
    if(window.innerWidth >= 900){
      sidebar.classList.add('active'); // desktop: show by default
      layout.classList.add('sidebar-open');
    } else {
      sidebar.classList.remove('active');
      layout.classList.remove('sidebar-open');
    }
  });

  // inisialisasi sesuai lebar
  if(window.innerWidth >= 900){
    sidebar.classList.add('active');
    layout.classList.add('sidebar-open');
  }
});
