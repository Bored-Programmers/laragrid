# LaraGrid

This package is in **development** and **is not ready** for use in your projects. If you'd like to contribute, you're welcome
to submit a Pull Request.

## License

This project is licensed under the [MIT license](https://github.com/Bored-Programmers/laragrid/blob/main/LICENSE.md).

### Contribution

Unless you explicitly state otherwise, any contribution intentionally submitted
for inclusion in LaraGrid by you, shall be licensed as MIT, without any additional
terms or conditions.

# Instalation

Install package: ```composer require bored-programmers/laragrid```

Now install flatpickr, which is used for date and datetime fields: ```https://flatpickr.js.org/getting-started/```
- _note: I had a problem with not loading css file, so I had to add it manually to my js file ```import 'flatpickr/dist/flatpickr.css';```_

We also need to install momentjs: ```npm install moment --save```

# Publishable Assets

```php artisan vendor:publish --tag=laragrid-config```

```php artisan vendor:publish --tag=laragrid-lang```

```php artisan vendor:publish --tag=laragrid-views```
