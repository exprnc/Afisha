<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <title>Afisha</title>
</head>

<body>
    <header>
        <div class="container" style="display:flex; justify-content:space-between;">
            <div class="logo-container">
                <a href="/"><img src="{{ asset("storage/image/logo.png") }}" alt=""></a>
            </div>
            <div class="search-container">
                <img src="{{ asset('images/ic_search.png') }}" alt="">
                <input type="text" placeholder="События, артисты и места">
            </div>
            <div class="header-ic-container">
                <div class="ic-location-container">
                    <a href="#"><img src="{{ asset('storage/image/ic_location.png') }}" alt=""><span>Москва</span></a>
                </div>
                <div class="ic-ticket-container">
                    @if(Auth::user())
                    <a href="{{ route('ticket.index') }}"><img src="{{ asset('storage/image/ic_ticket.png') }}" alt=""><span>Мои билеты</span></a>
                    @endif
                </div>
            </div>
            <div class="header-ic-container-2">
                @auth
                <div class="ic-avatar-container">
                    <a href="{{ route('me.index') }}"><img src="{{ asset("storage/image/{$user->photo}") }}" alt=""></a>
                </div>
                @endauth
                @guest
                <a class="header-auth-btn" href="#">Войти</a>
                @endguest
            </div>
        </div>
        <div class="container" style="margin-top: 20px;">
            <nav class="header-nav">
                <ul>
                    <li>
                        <a href="/#top" style="display:flex; align-items:center;">
                            <img style="height: 20px;" src="{{ asset('storage/image/ic_crown.png') }}" alt="">
                            <span style="margin-left: 5px;">ТОП-10</span>
                        </a>
                    </li>
                    <li><a href="{{ route('genre.show', 1) }}">Концерты</a></li>
                    <li><a href="{{ route('genre.show', 2) }}">Театр</a></li>
                    <li><a href="{{ route('genre.show', 3) }}">Кино</a></li>
                    <li><a href="{{ route('genre.show', 4) }}">Стендап</a></li>
                    <li><a href="{{ route('genre.show', 5) }}">Спорт</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
        <section id="overlay"></section>
        <section class="auth-sec">
            <a href="#" class="auth-close"><img src="{{ asset('storage/image/ic_cross.png') }}" alt=""></a>
            <div class="auth-h">Вход</div>
            <div class="auth-h-2">
                <span>У вас нету аккаунта?&nbsp</span>
                <a class="auth-to-reg-btn" href="#">Регистрация</a>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="tel" name="logPhone" id="phoneNumber" placeholder="Номер телефона" maxlength="18" oninput="formatPhoneNumber(this)" class="auth-inp">
                @error('logPhone')
                <div>{{$message}}</div>
                @enderror
                <input name="logPassword" class="auth-inp" type="password" placeholder="Пароль">
                @error('logPassword')
                <div>{{$message}}</div>
                @enderror
                <input class="auth-inp-sub" type="submit" value="Войти">
            </form>
        </section>
        <section class="reg-sec">
            <a href="#" class="reg-close"><img src="{{ asset('storage/image/ic_cross.png') }}" alt=""></a>
            <div class="auth-h">Регистрация</div>
            <div class="auth-h-2">
                <span>У вас уже есть аккаунт?&nbsp</span>
                <a class="reg-to-auth-btn" href="#">Войти</a>
            </div>
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="reg-inp-block">
                    <input type="text" name="regName" placeholder="Имя">
                    @error('regName')
                    <div>{{$message}}</div>
                    @enderror
                </div>
                <div class="reg-inp-block-surname">
                    <input class="reg-inp-surname" name="regSurname" type="text" placeholder="Фамилия">
                    <input class="reg-inp-patr" name="regPatronymic" type="text" placeholder="Отчество">
                </div>
                @error('regSurname')
                    <div>{{$message}}</div>
                @enderror
                @error('regPatronymic')
                    <div>{{$message}}</div>
                @enderror
                <div class="reg-inp-block">
                    <input type="email" name="regEmail" placeholder="Эл. Адрес">
                    @error('regEmail')
                    <div>{{$message}}</div>
                    @enderror
                </div>
                <div class="reg-inp-block">
                    <input type="tel" name="regPhone" id="phoneNumber" placeholder="Номер телефона" maxlength="18" minlength="18" oninput="formatPhoneNumber(this)">
                    @error('regPhone')
                    <div>{{$message}}</div>
                    @enderror
                </div>
                <div class="reg-inp-block">
                    <input type="password" name="regPassword" placeholder="Пароль">
                </div>
                <div class="reg-inp-block">
                    <input type="password" name="regPassword_confirmation" placeholder="Повторите пароль">
                    @error('regPassword')
                    <div>{{$message}}</div>
                    @enderror
                </div>
                <div class="reg-inp-block-date-photo">
                    <div class="reg-inp-block-date">
                        <label for="">Дата рождения:</label>
                        <input name="regBirthday" type="date">
                        @error('regBirthday')
                        <div>{{$message}}</div>
                        @enderror
                    </div>
                    <div class="reg-inp-block-photo">
                        <label for="">Фото:</label>
                        <input name="regPhoto" type="file">
                        @error('regPhoto')
                        <div>{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="reg-inp-block-gender">
                    <label for="">Пол:</label>
                    <select name="regGenderId" id="">
                        @foreach($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="reg-inp-block-check">
                    <input required type="checkbox">
                    <label for="">Согласие на обработку персональных данных</label>
                </div>
                <div class="reg-inp-block-check">
                    <input type="checkbox">
                    <label for="">Получать анонсы акций и событий</label>
                </div>
                <input class="auth-inp-sub" type="submit" value="Войти">
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-main-block">
                <div class="footer-main-content">
                    <div class="newsletter-container">
                        <form action="">
                            <div class="newsletter-label">Подпишитесь на акции и анонсы событий</div>
                            <div class="newsletter-inputs">
                                <input class="news-inp-text" type="text" placeholder="Электронная почта">
                                <input class="news-inp-sub" value="Далее" type="submit">
                            </div>
                        </form>
                    </div>
                    <div class="footer-nav-container">
                        <div>
                            <h4>Экспресс Афиша</h4>
                            <ul>
                                <li><a href="#">Пользовательское соглашение</a></li>
                                <li><a href="#">Пользовательское соглашение</a></li>
                                <li><a href="#">Пользовательское соглашение</a></li>
                                <li><a href="#">Пользовательское соглашение</a></li>
                                <li><a href="#">Пользовательское соглашение</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Партнёрам и организаторам</h4>
                            <ul>
                                <li><a href="#">Корпоративным клиентам</a></li>
                                <li><a href="#">Корпоративным клиентам</a></li>
                                <li><a href="#">Корпоративным клиентам</a></li>
                                <li><a href="#">Корпоративным клиентам</a></li>
                                <li><a href="#">Корпоративным клиентам</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-tel-content">
                    <img class="tel-img" src="{{ asset('storage/image/tel.png') }}" alt="">
                    <div>
                        <h2>Скачайте приложение Экспресс Афиши</h2>
                        <a class="g-play-a" href="#"><img class="g-play-img" src="{{ asset('storage/image/google_play.png') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© 2005–2023 ООО «Экспресс Афиша»</span>
                <span>Проект компании Экспресс</span>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/auth.js') }}"></script>
    <script>
        function formatPhoneNumber(input) {
            // Получаем текущее значение ввода
            var phoneNumber = input.value;

            // Удаляем все символы, кроме цифр
            phoneNumber = phoneNumber.replace(/\D/g, '');

            // Проверка наличия номера телефона
            if (phoneNumber.length > 0) {
                // Добавление "+7" в начало номера
                phoneNumber = '+7' + phoneNumber.substring(1);

                // Форматирование номера с пробелами, скобками и тире
                phoneNumber = phoneNumber.replace(/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/, '$1 ($2) $3-$4-$5');
            }

            // Установка отформатированного номера в поле ввода
            input.value = phoneNumber;
        }
    </script>
    @if(session('alert'))
    <script>
        // Display alert based on the type
        var alertType = "{{ session('alert')['type'] }}";
        var alertMessage = "{{ session('alert')['message'] }}";

        if (alertType === 'success') {
            alert(alertMessage);
            // You can customize this part to use a more user-friendly alert library, such as SweetAlert
        } else if (alertType === 'error') {
            alert(alertMessage);
        }
    </script>
    @endif
</body>

</html>