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

## How to load vendor/autoload.php

```bash
$ ./myFile.phar
PHP Warning:  require_once(./vendor/autoload.php): failed to open stream: No such file or directory in phar://C:/Christophe/xxx/myFile.phar/src/Run.php on line 5
PHP Fatal error:  require_once(): Failed opening required './vendor/autoload.php' (include_path='.;C:\php\pear') in phar://C:/Christophe/xxx/myFile.phar/src/Run.php on line 5
```

If you see that error, you've incorrectly included your `autoload.php` in the mentioned script (`src/Run.php` in the example).

Don't include the file with a fixed path like `require_once './vendor/autoload.php` even if it's still correct and your PHP script works. Don't use the dot notation but a relative path.

The correct way to include the `autoload.php` file is, f.i., `require_once dirname(__DIR__) . '/vendor/autoload.php'`

## See content of the .phar

Type `php box.phar info -l bin/test.phar` on the command line to get infos about what is included in the archive:

```txt
API Version: 1.1.0

Compression: GZ

Signature: SHA-1
Signature Hash: 8D9E63A650C4E858F3D551722A3A750AB29553C8

Metadata: None

Contents: 24 files (18.65KB)
index.php [GZ] - 109.00B
src/
  Classes/
    Glob.php [GZ] - 176.00B
vendor/
  autoload.php [GZ] - 143.00B
  beberlei/
    assert/
      LICENSE [GZ] - 270.00B
      composer.json [GZ] - 601.00B
      lib/
        Assert/
          Assert.php [GZ] - 329.00B
          Assertion.php [GZ] - 6.33KB
          AssertionChain.php [GZ] - 682.00B
          AssertionFailedException.php [GZ] - 138.00B
          InvalidArgumentException.php [GZ] - 270.00B
          LazyAssertion.php [GZ] - 574.00B
          LazyAssertionException.php [GZ] - 349.00B
          functions.php [GZ] - 176.00B
  composer/
    ClassLoader.php [GZ] - 2.89KB
    InstalledVersions.php [GZ] - 733.00B
    LICENSE [GZ] - 626.00B
    autoload_classmap.php [GZ] - 287.00B
    autoload_files.php [GZ] - 179.00B
    autoload_namespaces.php [GZ] - 117.00B
    autoload_psr4.php [GZ] - 181.00B
    autoload_real.php [GZ] - 693.00B
    autoload_static.php [GZ] - 577.00B
    installed.php [GZ] - 212.00B
    platform_check.php [GZ] - 427.00B
```

Between brackets, you'll get the used compression; here it's: `[GZ]` (as defined in the `box.json` file).

## Extra

### Self-updater

Not tested: [https://github.com/webmozart/phar-updater](https://github.com/webmozart/phar-updater)

Seems to be an easy solution to provide a self-update feature to the phar.
