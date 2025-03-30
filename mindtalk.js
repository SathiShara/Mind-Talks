const toggleButton = document.querySelector('#toggle-btn');
const body = document.body;

toggleButton.addEventListener('click', function () {
  body.classList.toggle('dark-mode');
});
