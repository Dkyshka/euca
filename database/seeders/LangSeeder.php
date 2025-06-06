<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    public array $langs =  [
        'Главная' => 'Главная',
        'Зарегистрироваться' => 'Зарегистрироваться',
        'Контакты' => 'Контакты',
        'Стать участником' => 'Стать участником',
        'Наши телефоны' => 'Наши телефоны',
        'Наши адреса электронной почты' => 'Наши адреса электронной почты',
        'Введите имя' => 'Введите имя',
        'Укажите роль' => 'Укажите роль',
        'Введите email' => 'Введите email',
        'Такой пользователь уже существует' => 'Такой пользователь уже существует',
        'Введите корректный email' => 'Введите корректный email',
        'Поле логин обязательно для заполнения' => 'Поле логин обязательно для заполнения',
        'Логин должен быть не короче 6 символов' => 'Логин должен быть не короче 6 символов',
        'Логин не должен превышать 256 символов' => 'Логин не должен превышать 256 символов',
        'Такой логин уже используется' => 'Такой логин уже используется',
        'Логин не должен содержать пробелы или символы:' => 'Логин не должен содержать пробелы или символы:',
        'Введите телефон' => 'Введите телефон',
        'Введите пароль' => 'Введите пароль',
        'Пароль должен быть минимум 8 символов' => 'Пароль должен быть минимум 8 символов',
        'Логист' => 'Логист',
        'Экспедитор' => 'Экспедитор',
        'Грузовладелец' => 'Грузовладелец',
        'Перевозчик' => 'Перевозчик',
    ];

    public array $langsUz =  [
        'Главная' => 'Главная',
        'Зарегистрироваться' => 'Ro‘yxatdan o‘tish',
        'Контакты' => 'Контакты',
        'Стать участником' => 'Стать участником',
        'Наши телефоны' => 'Наши телефоны',
        'Наши адреса электронной почты' => 'Наши адреса электронной почты',
        'Введите имя' => 'Введите имя',
        'Укажите роль' => 'Укажите роль',
        'Введите email' => 'Введите email',
        'Такой пользователь уже существует' => 'Такой пользователь уже существует',
        'Введите корректный email' => 'Введите корректный email',
        'Поле логин обязательно для заполнения' => 'Поле логин обязательно для заполнения',
        'Логин должен быть не короче 6 символов' => 'Логин должен быть не короче 6 символов',
        'Логин не должен превышать 256 символов' => 'Логин не должен превышать 256 символов',
        'Такой логин уже используется' => 'Такой логин уже используется',
        'Логин не должен содержать пробелы или символы:' => 'Логин не должен содержать пробелы или символы:',
        'Введите телефон' => 'Введите телефон',
        'Введите пароль' => 'Введите пароль',
        'Пароль должен быть минимум 8 символов' => 'Пароль должен быть минимум 8 символов',
        'Логист' => 'Logist',
        'Экспедитор' => 'Ekspeditor',
        'Грузовладелец' => 'Yuk egasi',
        'Перевозчик' => 'Yuk tashuvchi',
    ];

    public array $langsEn =  [
        'Главная' => 'Главная',
        'Зарегистрироваться' => 'Sign up',
        'Контакты' => 'Контакты',
        'Стать участником' => 'Стать участником',
        'Наши телефоны' => 'Наши телефоны',
        'Наши адреса электронной почты' => 'Наши адреса электронной почты',
        'Введите имя' => 'Введите имя',
        'Укажите роль' => 'Укажите роль',
        'Введите email' => 'Введите email',
        'Такой пользователь уже существует' => 'Такой пользователь уже существует',
        'Введите корректный email' => 'Введите корректный email',
        'Поле логин обязательно для заполнения' => 'Поле логин обязательно для заполнения',
        'Логин должен быть не короче 6 символов' => 'Логин должен быть не короче 6 символов',
        'Логин не должен превышать 256 символов' => 'Логин не должен превышать 256 символов',
        'Такой логин уже используется' => 'Такой логин уже используется',
        'Логин не должен содержать пробелы или символы:' => 'Логин не должен содержать пробелы или символы:',
        'Введите телефон' => 'Введите телефон',
        'Введите пароль' => 'Введите пароль',
        'Пароль должен быть минимум 8 символов' => 'Пароль должен быть минимум 8 символов',
        'Логист' => 'Logistic',
        'Экспедитор' => 'Forwarder',
        'Грузовладелец' => 'Consignor',
        'Перевозчик' => 'Carrier',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->langs as $key => $value) {
            Lang::create([
                'code' => 'ru',
                'key' => $key,
                'value' => $value,
            ]);
        }

        foreach($this->langsUz as $key => $value) {
            Lang::create([
                'code' => 'uz',
                'key' => $key,
                'value' => $value,
            ]);
        }

        foreach($this->langsEn as $key => $value) {
            Lang::create([
                'code' => 'en',
                'key' => $key,
                'value' => $value,
            ]);
        }
    }
}
