<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        return view('me.me', compact('genders', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($file = $request->file('editPhoto')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        } else {
            $file_name = $user->photo;
            $request->merge(['editPhoto' => $file_name]);
        }

        $request->validate([
            'editName' => 'required|alpha|max:64',
            'editSurname' => 'required|alpha|max:64',
            'editPatronymic' => 'required|alpha|max:64',
            'editEmail' => 'required|email',
            'editPhone' => 'required',
            'editBirthday' => 'required|date',
        ], [
            'editName.required' => 'Имя обязательно',
            'editName.alpha' => 'Имя должно содержать только буквы',
            'editName.max' => 'Достигнуто максимальное количество символов',
            'editSurname.required' => 'Фамилия обязательна',
            'editSurname.alpha' => 'Фамилия должна содержать только буквы',
            'editSurname.max' => 'Достигнуто максимальное количество символов',
            'editPatronymic.required' => 'Отчество обязательно',
            'editPatronymic.alpha' => 'Отчество должно содержать только буквы',
            'editPatronymic.max' => 'Достигнуто максимальное количество символов',
            'editEmail.required' => 'Электронная почта обязательна',
            'editEmail.email' => 'Введите правильный формат',
            'editPhone.required' => 'Телефонный номер обязателен',
            'editBirthday.required' => 'Дата рождения обязательна',
        ]);

        $updating = $user->update([
            'name' => $request->input('editName'),
            'surname' => $request->input('editSurname'),
            'patronymic' => $request->input('editPatronymic'),
            'email' => $request->input('editEmail'),
            'phone' => $request->input('editPhone'),
            'birthday' => $request->input('editBirthday'),
            'photo' => $file_name,
            'gender_id' => $request->input('editGenderId'),
        ]);

        if ($updating) {
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Успешное редактирование :)']);
        } else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'regName' => 'required|alpha|max:64',
            'regSurname' => 'required|alpha|max:64',
            'regPatronymic' => 'required|alpha|max:64',
            'regEmail' => 'required|email|unique:users,email',
            'regPhone' => 'required|unique:users,phone',
            'regBirthday' => 'required|date',
            'regPhoto' => 'required|image|mimes:jpeg,png,jpg,svg',
            'regPassword' => 'required|confirmed',
        ], [
            'regName.required' => 'Имя обязательно',
            'regName.alpha' => 'Имя должно содержать только буквы',
            'regName.max' => 'Достигнуто максимальное количество символов',
            'regSurname.required' => 'Фамилия обязательна',
            'regSurname.alpha' => 'Фамилия должна содержать только буквы',
            'regSurname.max' => 'Достигнуто максимальное количество символов',
            'regPatronymic.required' => 'Отчество обязательно',
            'regPatronymic.alpha' => 'Отчество должно содержать только буквы',
            'regPatronymic.max' => 'Достигнуто максимальное количество символов',
            'regEmail.required' => 'Электронная почта обязательна',
            'regEmail.email' => 'Введите правильный формат',
            'regEmail.unique' => 'Электронная почта уже занята',
            'regPhone.required' => 'Телефонный номер обязателен',
            'regPhone.unique' => 'Телефонный номер уже занят',
            'regBirthday.required' => 'Дата рождения обязательна',
            'regPhoto.required' => 'Фото обязательно',
            'regPhoto.mimes' => 'Фото должно быть в форматах: jpeg, png, jpg, svg',
            'regPassword.required' => 'пароль обязателен',
            'regPassword.confirmed' => 'Пароли не совпадают',
        ]);

        $hashedPassword = Hash::make($request->regPassword);

        if ($file = $request->file('regPhoto')) {
            $file_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            Storage::putFileAs("public/image", $file, $file_name);
        }

        $user = User::create([
            'name' => $request->input('regName'),
            'surname' => $request->input('regSurname'),
            'patronymic' => $request->input('regPatronymic'),
            'email' => $request->input('regEmail'),
            'phone' => $request->input('regPhone'),
            'birthday' => $request->input('regBirthday'),
            'photo' => $file_name,
            'password' => $hashedPassword,
            'gender_id' => $request->input('regGenderId'),
            'role_id' => 2,
        ]);
        if (!Auth::login($user)) {
            return redirect('/')->with('alert', ['type' => 'success', 'message' => 'Успешная регистрация :)']);
        }
        return redirect('/')->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'logPhone' => 'required',
            'logPassword' => 'required',
        ], [
            'logPhone.required' => 'Телефонный номер обязателен',
            'logPassword.required' => 'Пароль обязателен',
        ]);

        $user = $request->only('logPhone', 'logPassword');
        $auth = Auth::attempt([
            "phone" => $user['logPhone'],
            "password" => $user['logPassword'],
        ]);

        if ($auth) {
            $request->session()->regenerate();

            // Проверка роли пользователя после успешной аутентификации
            $user = Auth::user();

            if ($user->isAdmin()) {
                // Администратор
                return redirect('/admin')->with('alert', ['type' => 'success', 'message' => 'Успешная авторизация :)']);
            } else {
                // Обычный пользователь
                return redirect('/')->with('alert', ['type' => 'success', 'message' => 'Успешная авторизация :)']);
            }
        } else {
            return redirect('/')->with('alert', ['type' => 'error', 'message' => 'Неверный логин или пароль :(']);
        }
    }

    public function delete()
    {
        $user = Auth::user();
        Session::flush();
        if (!Auth::logout()) {
            if ($user->delete()) {
                return redirect('/')->with('alert', ['type' => 'success', 'message' => 'Вы удалили аккаунт :(']);
            }
        }
        return redirect('/')->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
    }

    public function signout()
    {
        Session::flush();
        if (!Auth::logout()) {
            return redirect('/')->with('alert', ['type' => 'success', 'message' => 'Вы вышли из аккаунта :)']);
        }
        return redirect('/')->with('alert', ['type' => 'error', 'message' => 'Что то пошло не так :(']);
    }
}
