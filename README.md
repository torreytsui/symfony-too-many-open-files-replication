# Symfony too many open files issue

A simple application to replicate the [#26146](https://github.com/symfony/symfony/issues/26146) issue.

# Replicate the issue

```bash
ulimit -n 800; vendor/bin/simple-phpunit --filter='testTooManyOpenFiles' -vvv
```

Using the `ulimit -n` to limit the number of open files allowed. If it fails to
replicate, try lowering the number.

In the test env, it is noticed that the resource closed automatically when it
exceeded a number (e.g., `>8xx`). It may be triggered by PHP garbage collection
destroy event. 

The number of open files can be examined by:

```bash
lsof -p <PID> | wc -l
```

By lowing the ulimit to a reasonable number, we can simulate a situation where
the resource are dangling however hasn't been garbage collected.
