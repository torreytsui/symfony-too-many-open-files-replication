# Symfony too many open files issue

A simple application to replicate the [#26146](https://github.com/symfony/symfony/issues/26146) issue.

## Replicate the issue

```bash
$ ulimit -n 800; vendor/bin/simple-phpunit --filter='testTooManyOpenFiles' -vvv

PHPUnit 8.2.5 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.2.19 with Xdebug 2.7.2
Configuration: ./phpunit.xml.dist

Testing Project Test Suite
...........................................................    59 / 10000 (  0%)
...........................................................   118 / 10000 (  1%)
...........................................................   177 / 10000 (  1%)
...........................................................   236 / 10000 (  2%)
...........................................................   295 / 10000 (  2%)
...........................................................   354 / 10000 (  3%)
...........................................................   413 / 10000 (  4%)
...........................................................   472 / 10000 (  4%)
...........................................................   531 / 10000 (  5%)
...........................................................   590 / 10000 (  5%)
...........................................................   649 / 10000 (  6%)
...........................................................   708 / 10000 (  7%)
...........................................................   767 / 10000 (  7%)
...........................PHP Warning:  Uncaught require(./vendor/symfony/finder/Exception/AccessDeniedException.php): failed to open stream: Too many open files
```

Using the `ulimit -n` to limit the number of open files allowed. If it fails to
replicate, try lowering the number.

In the test env, it is noticed that the resource closes automatically when it
exceeds a number (e.g., `>8xx`). It may be triggered by PHP garbage collection
destroy event. 

The number of open files can be examined by:

```bash
$ lsof -p <PID> | wc -l
```

By lowing the ulimit to a reasonable number, we can simulate a situation where
the resources are dangling however have not been garbage collected.
