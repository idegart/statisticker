# Statisticker

## Задача

Написать код на PHP, реализующий REST API, предназначенный для учёта посещений сайта с разбиением по странам.

Сервис должен предоставлять два метода:

Обновление статистики, принимает один аргумент – код страны (ru, us, it...).
Предполагаемая нагрузка: 1 000 запросов в секунду.

Получение собранной статистики по всем странам, возвращает JSON-объект вида:
{ код страны: количество, cy: 123, us: 456, ... }.
Предполагаемая нагрузка: 1 000 запросов в секунду.

Хранилище данных: Redis.
Допустимо использование готовых библиотек, фреймворков и т.п..

На оценку влияет готовность к высоким нагрузкам, читаемость кода, обработка ошибок, тестирование, документация для запуска проекта
Время выполнения: от 2 до 4 часов.

## Системные требования
- Make
- Curl
- Docker

## Запуск приложения

### Developer mode
- `make build` - устанавливаем зависимости для приложения
- `make up` - запуск приложения в dev режиме (доступ по http://localhost:8000)
- `curl -d "code=ru" -X POST http://localhost:8000` - добавиление статистики по стране
- `curl http://localhost:8000` - получение статистики по странам
- `make down` - остановка приложения

### Production mode
- `make build` - устанавливаем зависимости для приложения
- `make up.prod` - запуск приложения в dev режиме (доступ по http://localhost:8000)
- `curl -d "code=ru" -X POST http://localhost` - добавиление статистики по стране
- `curl http://localhost` - получение статистики по странам
- `make prod.performance.hit` - выполнить нагрузочное тестирование на добавиление статистики по стране
- `make prod.performance.list` - выполнить нагрузочное тестирование на получение статистики по странам
- `make down.prod` - остановка приложения

## TODO
- [x] документация для запуска проекта
- [x] готовность к высоким нагрузкам (сделал что успел)
- [x] читаемость кода
- [x] обработка ошибок
- [ ] логирование
- [ ] тестирование
- [ ] линтер