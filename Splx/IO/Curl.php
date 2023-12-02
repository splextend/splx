<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

class Curl extends AbstractResource
{
    protected $resource;
    protected static $prefix;
    protected static $functions = [];
    protected static $staticFunctions = [];
    protected static $watchFalseFunctions = [];

    protected static $selfReturnMethods = [];

    protected static $selfInstanceMethod = [];
}
/*
curl_close — Завершает сеанс cURL
curl_copy_handle — Копирует дескриптор cURL вместе со всеми его настройками
curl_errno — Возвращает код последней ошибки
curl_error — Возвращает строку с описанием последней ошибки текущего сеанса
curl_escape — Кодирует заданную строку как URL
curl_exec — Выполняет запрос cURL
curl_getinfo — Возвращает информацию об определённой операции
curl_init — Инициализирует сеанс cURL
curl_multi_add_handle — Добавляет обычный cURL-дескриптор к набору cURL-дескрипторов
curl_multi_close — Закрывает набор cURL-дескрипторов
curl_multi_errno — Возвращает код последней ошибки множественного curl
curl_multi_exec — Запускает подсоединения текущего дескриптора cURL
curl_multi_getcontent — Возвращает результат операции, если была установлена опция CURLOPT_RETURNTRANSFER
curl_multi_info_read — Возвращает информацию о текущих операциях
curl_multi_init — Создаёт набор cURL-дескрипторов
curl_multi_remove_handle — Удаляет cURL дескриптор из набора cURL дескрипторов
curl_multi_select — Ждёт активности на любом curl_multi соединении
curl_multi_setopt — Устанавливает опции множественного дескриптора cURL
curl_multi_strerror — Возвращает строку, описывающую ошибку
curl_pause — Приостановить и возобновить соединение
curl_reset — Сбросить все настройки обработчика сессии libcurl
curl_setopt_array — Устанавливает несколько параметров для сеанса cURL
curl_setopt — Устанавливает параметр для сеанса CURL
curl_share_close — Закрыть разделяемый обработчик cURL
curl_share_errno — Возвращает код последней ошибки разделяемого обработчика curl
curl_share_init — Инициализация разделяемого обработчика cURL
curl_share_setopt — Установить опции разделяемого обработчика cURL
curl_share_strerror — Возвращает описание для заданного кода ошибки
curl_strerror — Получить текстовое описание для кода ошибки
curl_unescape — Декодирует закодированную URL-строку
curl_upkeep — Выполняет любые проверки работоспособности соединений
curl_version —
*/
