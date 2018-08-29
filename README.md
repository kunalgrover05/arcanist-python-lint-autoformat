# arcanist-python-autolint
Automatically lint your Python files using arc lint.

Arcanist already supports a lot of Python linters such as pep8, flake8 etc.

This repository contains tools for linting using Automatic formatters. The idea of autoformatters is that linting is non-invasive and does what is needed instead of telling what the problems are. This supports 3 major Autoformatters in Python:
- [autopep8](https://github.com/hhatto/autopep8)
- [yapf](https://github.com/google/yapf)
- [black](https://github.com/ambv/black)

### How to install?
* Simply clone this repository inside your project and include it in your .arcconfig file:
```
{
  // Other configuration
  "load": ["arcanist-python-autolint"]
}
```

* Install the tool of your choice: ```autopep8``` / ```yapf``` / ```black```
* Add the lint configuration in .arclint
```
{
  "linters": {
    "default": {
      "type": "black",
      "include": "(\\.py$)",
      "flags": [] // Any additional flags here
    }
  }
}
```

### Usage
```arc lint```
```arc lint file.py```

![Usage](https://github.com/kunalgrover05/arcanist-python-autolint/blob/master/usage.png)

