function openModal() {
    document.getElementById('logoutModal').style.display = 'block';
 }

 function closeModal() {
    document.getElementById('logoutModal').style.display = 'none';
 }

 function confirmLogout() {
    window.location.href = '../Functions/logout.php';
 }

 function toggleMenu() {
    const navContainer = document.querySelector('.NavContainer');
    navContainer.classList.toggle('open');
 }

 if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
 }

 window.onclick = function (event) {
    const modal = document.getElementById('logoutModal');
    if (event.target === modal) {
       closeModal();
    }
 }

 window.addEventListener('popstate', function (event) {
    if (document.location.pathname === '/index.html') {
       window.history.pushState(null, '', 'home.php');
    }
 });

 document.addEventListener('DOMContentLoaded', function () {
    if (document.referrer && document.referrer.includes('index.html')) {
       window.history.pushState(null, '', 'home.php');
    }
 });