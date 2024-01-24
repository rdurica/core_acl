# Core

[![PHP](https://img.shields.io/badge/PHP-8.3-blue.svg)](http://php.net)
![GitHub release (with filter)](https://img.shields.io/github/v/release/rdurica/core_acl)
![GitHub](https://img.shields.io/github/license/rdurica/core_acl)
![Packagist Downloads (custom server)](https://img.shields.io/packagist/dt/rdurica/core_acl)


It includes foundational easy-to-use ACL (Access Control List), and a hassle-free
authentication mechanism.

![image](https://github.com/rdurica/core/assets/16089770/b06a0cc6-3534-4bc9-bc7c-29df9b3b23c0)
## Installation

To install latest version use [Composer](https://getcomposer.org).

```shell
composer require rdurica/core_acl
```

Register extension

```neon
extensions:
	rdurica.coreAcl: Rdurica\Core\Extension\Extension
```

## Key Features

#### Base Model and Utility Traits ####

The package comes equipped with a robust base model that streamlines database interactions and enforces standardized
conventions. Additionally, a collection of utility traits enhances various aspects of your application's functionality,
enabling code reusability and maintainability.

#### Access Control List (ACL) for Easy Authorization ####

The Core package includes a flexible ACL system that simplifies authorization management. It provides a structured way
to define user roles, permissions, and access levels, ensuring that sensitive actions and resources are protected.

## Contributing

If you would like to contribute to this project, please fork the repository and create a pull request. We welcome all
contributions, including bug fixes, new features, and documentation improvements.

## License

This project is licensed under the terms of the MIT license.