@extends('partials.header-footer')
@section('content')
<section class="my-sec">
    <div class="container">
        <h2 class="my-h">Моя афиша</h2>
        <div class="my-nav-buttons">
            <a class="my-nav-button" href="{{ route('ticket.index') }}">Мои билеты</a>
            <a class="my-nav-button" href="{{ route('favorite.index') }}">Избранное</a>
            <a class="my-nav-button" href="{{ route('watch.index') }}">Я смотрел</a>
            <a class="my-nav-button" href="{{ route('me.index') }}">Мой аккаунт</a>
            <a class="my-nav-button-out" href="{{ route('signout') }}">Выход</a>
        </div>
        <div class="my-acc-main">
            <form action="{{ route('me.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="my-acc-info-block">
                    <span>Имя</span>
                    <input name="editName" type="text" value="{{ $user->name }}">
                </div>
                @error('editName')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block">
                    <span>Фамилия</span>
                    <input name="editSurname" type="text" value="{{ $user->surname }}">
                </div>
                @error('editSurname')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block">
                    <span>Отчество</span>
                    <input name="editPatronymic" type="text" value="{{ $user->patronymic }}">
                </div>
                @error('editPatronymic')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block">
                    <span>Эл. адрес</span>
                    <input name="editEmail" type="email" value="{{ $user->email }}">
                </div>
                @error('editEmail')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block">
                    <span>Номер телефона</span>
                    <input name="editPhone" type="tel" id="phoneNumber" value="{{ $user->phone }}" maxlength="18" minlength="18" oninput="formatPhoneNumber(this)">
                </div>
                @error('editPhone')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block-date">
                    <span>Дата рождения</span>
                    <input name="editBirthday" type="date" value="{{ $user->birthday }}">
                </div>
                @error('editBirthday')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block-img">
                    <span>Фото</span>
                    <img id="selected-image" src="{{ asset("storage/image/{$user->photo}") }}">
                    <input name="editPhoto" type="file" id="image-input">
                </div>
                @error('editPhoto')
                    <div class="err-mess">{{$message}}</div>
                @enderror
                <div class="my-acc-info-block-select">
                    <span>Пол</span>
                    <select name="editGenderId">
                        @foreach($genders as $gender)
                        <option value="{{ $gender->id }}" {{ $gender->id === $user->gender_id ? ' selected ' : ' ' }}>{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-acc-info-block-newsletter">
                    <span class="my-acc-special-span">Подписка на рассылку</span>
                    <div>
                        <input type="checkbox">
                        <span>Получать анонсы акций и событий</span>
                    </div>
                </div>
                <div class="my-acc-sub-buttons">
                    <input class="my-acc-submit" type="submit" value="Редактировать">
                    <a href="{{ route('me.delete') }}"><img src="{{ asset("storage/image/ic_cross.png") }}" alt="">Удалить аккаунт</a>
                </div>
            </form>
        </div>
    </div>
</section>
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
    document.getElementById('image-input').addEventListener('change', function (event) {
      const input = event.target;
      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          document.getElementById('selected-image').src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
      }
    });
</script>
@endsection('content')