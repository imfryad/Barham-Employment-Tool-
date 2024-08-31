document.getElementById('navbar-title').addEventListener('click', function() {
  // Reload the page to show the default dashboard content
  document.getElementById('main-content').innerHTML = `
      <h2>بەخێربێی بۆ داشبۆردی ئەدمین</h2>    
  `;
  // Remove 'active' class from all links
  document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
});

function loadContent(page, element) {
  // Remove 'active' class from all links
  document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));

  // Add 'active' class to the clicked link
  element.classList.add('active');

  // Load content dynamically
  fetch(page)
      .then(response => response.text())
      .then(data => {
          document.getElementById('main-content').innerHTML = data;
      })
      .catch(error => console.error('Error loading content:', error));
}