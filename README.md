![PHP CI](https://github.com/lev0607/php-project-lvl2/workflows/PHP%20CI/badge.svg)
[![Build Status](https://travis-ci.com/lev0607/php-project-lvl2.svg?branch=master)](https://travis-ci.com/lev0607/php-project-lvl2)
[![Code Climate](https://codeclimate.com/github/lev0607/php-project-lvl2/badges/gpa.svg)](https://codeclimate.com/github/lev0607/php-project-lvl2)
[![Issue Count](https://codeclimate.com/github/lev0607/php-project-lvl2/badges/issue_count.svg)](https://codeclimate.com/github/lev0607/php-project-lvl2)
[![Test Coverage](https://codeclimate.com/github/lev0607/php-project-lvl2/badges/coverage.svg)](https://codeclimate.com/github/lev0607/php-project-lvl2/coverage)

# Difference Calculator
Утилита для поиска отличий в конфигурационных файлах.

Возможности утилиты:
* Поддержка разных форматов
* Генерация отчета в виде plain text, pretty и json

```
$ gendiff -h         
Generate diff                                                                   
Usage:                                                                          
  gendiff (-h|--help)                                                           
  gendiff (-v|--version)                                                        
  gendiff [--format <fmt>] <firstFile> <secondFile>                             
Options:                                                                        
  -h --help                     Show this screen                                
  -v --version                  Show version                                    
  --format <fmt>                Report format [default: pretty]
```
В видео сравниваются фаилы находящиеся в tests/fixtures/
## Сравнение плоских файлов (JSON, YML)
[![asciicast](https://asciinema.org/a/o3UAAuQz6EPNn68DSo6mLe3y9.svg)](https://asciinema.org/a/o3UAAuQz6EPNn68DSo6mLe3y9)

## Рекурсивное сравнение для вложенных структур (JSON, YML)
[![asciicast](https://asciinema.org/a/rjTU7pZel9smwPPxBTtRUApgb.svg)](https://asciinema.org/a/rjTU7pZel9smwPPxBTtRUApgb)

## Плоский формат вывод результата
[![asciicast](https://asciinema.org/a/933IUFhBpxqvkg3uQaAWpUTsA.svg)](https://asciinema.org/a/933IUFhBpxqvkg3uQaAWpUTsA)

## Вывод в json
[![asciicast](https://asciinema.org/a/2WKDW1ENvTbLxIKySRONSv7q2.svg)](https://asciinema.org/a/2WKDW1ENvTbLxIKySRONSv7q2)

### Также в проекте используется
* Тестирование с PHPUnit.
* Непрерывная интеграция (CI) c Github Actions (запуск линтера, тестов).