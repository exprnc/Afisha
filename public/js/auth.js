document.querySelector('.header-auth-btn').addEventListener('click', openLoginForm);
document.querySelector('.auth-close').addEventListener('click', closeLoginForm);

document.querySelector('.auth-to-reg-btn').addEventListener('click', openRegForm);
document.querySelector('.reg-to-auth-btn').addEventListener('click', openLoginForm);
document.querySelector('.reg-close').addEventListener('click', closeRegForm);


function openLoginForm() {
  document.getElementById('overlay').style.display = 'block';
  document.querySelector('.auth-sec').style.display = 'block';
  document.querySelector('.reg-sec').style.display = 'none';
  document.body.style.overflow = 'hidden'; // Запретить скроллинг страницы
}

function closeLoginForm() {
  document.getElementById('overlay').style.display = 'none';
  document.querySelector('.auth-sec').style.display = 'none';
  document.body.style.overflow = 'auto'; // Разрешить скроллинг страницы
}

function openRegForm() {
  document.getElementById('overlay').style.display = 'block';
  document.querySelector('.reg-sec').style.display = 'block';
  document.querySelector('.auth-sec').style.display = 'none';
  document.body.style.overflow = 'hidden'; // Запретить скроллинг страницы
}

function closeRegForm() {
  document.getElementById('overlay').style.display = 'none';
  document.querySelector('.reg-sec').style.display = 'none';
  document.body.style.overflow = 'auto'; // Разрешить скроллинг страницы
}