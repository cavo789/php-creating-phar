# Creating a PHAR

![Banner](./banner.svg)

1. Download this repo,
2. Get `box.phar` from here: [https://github.com/box-project/box/releases/latest](https://github.com/box-project/box/releases/latest)
3. In a DOS Session Prompt, type `composer update` followed by `composer dump-autoload --optimize`,
4. type `php box.phar compile`

Once compiled, you can run the file like this: `php bin/test.phar`.

## IMPORTANT

Don't add `KevinGH\\Box\\Compactor\\PhpScoper,` to the list of compactors in the `box.json` file otherwise the `.phar` won't work.

If you have that line, you'll get such error:

```txt
PHP Fatal error:  Uncaught Error: Class '_HumbugBox...\xxx' not found in phar://xxx/bin/test.phar/index.php:7
Stack trace:
#0 C:\xxx\bin\test.phar(12): require()
#1 {main}
  thrown in phar://C:/xxx/bin/test.phar/index.php on line 7
```

So, in `box.json`, here are the correct lines:

```json
"compression": "GZ",
"compactors": [
    "KevinGH\\Box\\Compactor\\Php",
    "KevinGH\\Box\\Compactor\\Json"
],
```

Read more: [issue 518](https://github.com/box-project/box/issues/518)
