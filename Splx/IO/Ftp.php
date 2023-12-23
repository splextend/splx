<?php

namespace Spx\IO;

use Splx\Resource\AbstractResource;

class Ftp extends AbstractResource
{
    /**
     *  FTP\Connection
     * ftp_alloc — Резервирует место на диске для закачиваемого файла
    ftp_append — Добавляет содержимое файла в конец другого файла на FTP-сервере
    ftp_cdup — Переходит в родительскую директорию
    ftp_chdir — Изменяет текущую директорию на FTP-сервере
    ftp_chmod — Устанавливает права доступа к файлу
    ftp_close — Закрывает соединение с FTP-сервером
    ftp_connect — Устанавливает соединение с FTP-сервером
    ftp_delete — Удаляет файл на FTP-сервере
    ftp_exec — Запрашивает выполнение команды на FTP-сервере
    ftp_fget — Скачивает файл с FTP-сервера и сохраняет его в предварительно открытом файле
    ftp_fput — Загружает предварительно открытый файл на FTP-сервер
    ftp_get_option — Получает текущие параметры FTP-соединения
    ftp_get — Скачивает файл с FTP-сервера
    ftp_login — Выполняет вход на FTP-сервер
    ftp_mdtm — Возвращает время последней модификации файла
    ftp_mkdir — Создаёт директорию
    ftp_mlsd — Возвращает список файлов в заданной директории
    ftp_nb_continue — Продолжает асинхронную операцию
    ftp_nb_fget — Скачивает файл с FTP-сервера в асинхронном режиме и сохраняет его в предварительно открытом файле
    ftp_nb_fput — Загружает предварительно открытый файл на FTP-сервер в асинхронном режиме
    ftp_nb_get — Скачивает файл с FTP-сервера в асинхронном режиме и сохраняет его в локальный файл
    ftp_nb_put — Загружает файл на FTP-сервер в асинхронном режиме
    ftp_nlist — Возвращает список файлов в заданной директории
    ftp_pasv — Включает или выключает пассивный режим
    ftp_put — Загружает файл на FTP-сервер
    ftp_pwd — Возвращает имя текущей директории
    ftp_quit — Псевдоним ftp_close
    ftp_raw — Отправляет произвольную команду FTP-серверу
    ftp_rawlist — Возвращает подробный список файлов в заданной директории
    ftp_rename — Переименовывает файл или директорию на FTP-сервере
    ftp_rmdir — Удаляет директорию
    ftp_set_option — Устанавливает параметры соединения с FTP-сервером
    ftp_site — Отправляет серверу команду SITE
    ftp_size — Возвращает размер указанного файла
    ftp_ssl_connect — Устанавливает соединение с FTP-сервером через SSL
    ftp_systype
     */

    public function __construct($hostname, $isSsl = true, $port = 21, $timeout = 90)
    {
        $resource = self::__callStatic(
            $isSsl ? 'ftp_ssl_connect' : 'ftp_connect',
            [$hostname, $port, $timeout]
        );

        $this->setResource($resource, ['resource', 'FTP\Connection']);
    }

    public function __destruct()
    {
        $this->close();
    }
}